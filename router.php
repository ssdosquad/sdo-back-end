<?php
/* 
    Роуты:
    <ссылка>, <метод загрузки>, <обязательные параметры(;)>, <мэйнфрейм>
*/
$routes = [
    ["url" => "auth", "method" => "GET", "requiredOptions" => "login;password", "mainframe" => "php/auth.php"],
    ["url" => "studentChoice", "method" => "GET", "requiredOptions" => "type", "mainframe" => "php/student_auth.php"]
];
// Получение текущего роута
function getRoute(){
    global $routes;
    $url = explode("?", str_replace("sdo/", "", trim($_SERVER['REQUEST_URI'], "/")))[0];
    foreach($routes as $route){
        if( ($route['url'] == $url ) && $_SERVER['REQUEST_METHOD'] == $route['method'] ){
            return $route;
        }
    }
    return null;
}
// Загрузка мэйнфрейма
function loadFrame($route){
    // Выделяем параметры для дальнейшей обработки
    $options = prepareOptions( (($route['method'] == "GET") ? $_GET : $_POST), $route['requiredOptions']);
    // Подключаем мэйнфрейм
    require_once $route['mainframe'];
}
// Подготовка параметров
function prepareOptions($options, $requiredOptions){
    $result = [];
    $requiredOptions = explode(";", $requiredOptions);
    // Если у нас есть обязательные параметры
    if(count($requiredOptions) > 0){
        foreach($requiredOptions as $opt){
            // Если обязательный параметр отсутствует, выключаем шайтан-машину
            if(empty($options[$opt])) exit("Required option [{$opt}] is missing!");
        }
    }
    foreach($options as $k => $v){
        // Записываем обработанный параметр
        // TODO: добавить более сложный алгоритм. обрабртки
        $result[$k] = htmlspecialchars(trim($v));
    }
    return $result;
}