<?php
// Раскладываем параметры по переменным
header("Access-Control-Allow-Origin: *");
$login = $options['login'];
$password = $options['password'];
// Пытаемся получить подруг из базы
if( ($query = dbquery("SELECT id, password FROM accounts WHERE login = '{$login}'")) != null ){
    // Если пароль подходит, генерируем сессию
    if(password_verify($password, $query[0]['password'])){
        $id = $query[0]['id'];
        $skey = hash("sha256", $id.time());
        $ip = $_SERVER["REMOTE_ADDR"];
        // Если смог добавиться в базу, значит даём добро
        if( dbexecute("INSERT INTO sessions (ip, aid, skey) VALUES ('{$ip}', '{$id}', '{$skey}')") ){
            sendAnswer(true, ["session" => $skey]);
        }
    }
    sendAnswer(false, ["Неверный пароль"]);
} 
sendAnswer(false, ["Аккаунт с указанным логином не найден"]);