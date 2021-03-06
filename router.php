<?php
/* 
    Роуты:
    url: <ссылка>, method: <метод загрузки>, requiredOptions: <обязательные параметры(;)>, mainframe: <мэйнфрейм>
*/
$routes = dbquery("SELECT * FROM routes");
// Получение текущего роута
function getRoute(){
    global $routes;
    $url = explode("?", str_replace("slt/", "", trim($_SERVER['REQUEST_URI'], "/")))[0];
    foreach($routes as $route){
        if( ($route['url'] == $url ) && $_SERVER['REQUEST_METHOD'] == $route['method'] ){
            $route['error'] = false;
            return $route;
        }
    }
    return ['request_url' => $url, 'error' => true];
}
// Загрузка мэйнфрейма
function loadFrame($route){
    // Выделяем параметры для дальнейшей обработки
    $options = prepareOptions( (($route['method'] == "GET") ? $_GET : $_POST), $route['requiredOptions']);
    //Получаем пользователя, если есть сессия
    if(isset($options['session'])) $options['account'] = getUser($options['session']);
    // Подключаем мэйнфрейм
    require_once $route['mainframe'];
}
// Подготовка параметров
function prepareOptions($options, $requiredOptions){
    $result = [];
    $requiredOptions = explode(";", $requiredOptions);
    // Если у нас есть обязательные параметры
    if(count($requiredOptions) > 0){
        $notExists = [];
        foreach($requiredOptions as $opt){
            // Если обязательный параметр отсутствует, выключаем шайтан-машину
            if(empty($options[$opt])) $notExists[] = "Required option [{$opt}] is missing!";
        }
        // Если одного или нескольких параметров не достаёт - офф
        if(count($notExists)) sendAnswer(false, $notExists);
    }
    foreach($options as $k => $v){
        // Записываем обработанный параметр
        // TODO: добавить более сложный алгоритм. обрабртки
        $result[$k] = htmlspecialchars(trim($v));
    }
    return $result;
}