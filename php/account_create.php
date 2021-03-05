<?php
// Если мы админ
if($options['account']['atype'] === "admin"){
    // Собираем нужные нам данные
    $firstname = $options['firstname'];
    $lastname = $options['lastname'];
    $middlename = $options['middlename'];
    $login = $options['login'];
    $password = $options['password'];
    // Собираем ошибки
    $errors = [];
    if(strlen($firstname) > 255 || strlen($firstname) < 2) $errors[] = "Firstname > 255 symbols or < 2";
    if(strlen($lastname) > 255 || strlen($lastname) < 2) $errors[] = "Lastname > 255 symbols or < 2";
    if(strlen($middlename) > 255 || strlen($middlename) < 2) $errors[] = "Middlename > 255 symbols or < 2";
    if(strlen($login) > 120 || strlen($login) < 4) $errors[] = "Login > 120 symbols or < 4";
    if(strlen($password) < 6) $errors[] = "Password < 6 symbols";
    // Если ошибки есть - выкидываем нас.
    if(count($errors) > 0) sendAnswer(false, $errors);
    // Если ошибок нет, продолжаем разговор
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Записываем нового черта в базу
    if( dbexecute("INSERT INTO accounts (firstname, lastname, middlename, login, password) VALUES ('{$firstname}', '{$lastname}', '{$middlename}', '{$login}', '{$password}')") ){
        sendAnswer(true, ['id' => dbid()]);
    }
}