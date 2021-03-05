<?php
// Добавляем любой Origin в whitelist
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // кэшируем на день
}
// Задаём нужные заголовки исходя из метода
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}
// Инициализируем основные ресурсы
require_once "init.php";
// Подключаем router
require_once "router.php";
// Определяем текущий роут
$route = getRoute();
// Загружаем
if( $route['error'] === false ) loadFrame($route);
else sendAnswer(false, ["Request frame [{$route['request_url']}] is missing!"]);