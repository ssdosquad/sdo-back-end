<?php
// Раскладываем параметры по переменным
header("Access-Control-Allow-Origin: *");
$login = $options['login'];
$password = $options['password'];
$stime = 3600;
// Пытаемся получить подруг из базы
if( ($query = dbquery("SELECT id, password, atype FROM accounts WHERE login = '{$login}'")) != null ){
    // Если пароль подходит, генерируем сессию
    if(password_verify($password, $query[0]['password'])){
        $id = $query[0]['id'];
        $skey = hash("sha256", $id.time());
        $ip = $_SERVER["REMOTE_ADDR"];
        // Если смог добавиться в базу, значит даём добро
        if( dbexecute("INSERT INTO sessions (ip, aid, skey, stime) VALUES ('{$ip}', '{$id}', '{$skey}', '{$stime})") ){
            sendAnswer(true, ["session" => $skey, "atype" => $query['atype']]);
        }
    }
    sendAnswer(false, ["Неверный пароль"]);
} 
sendAnswer(false, ["Аккаунт с указанным логином не найден"]);