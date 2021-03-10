<?php
// Берём переменные
$firstname = $options['firstname'];
$lastname = $options['lastname'];
$middlename = $options['middlename'];
$gid = $options['gid'];
// Проверяем данные
$errors = [];
if(strlen($firstname) > 255 || strlen($firstname) < 2) $errors[] = "Firstname > 255 symbols or < 2";
if(strlen($lastname) > 255 || strlen($lastname) < 2) $errors[] = "Lastname > 255 symbols or < 2";
if(strlen($middlename) > 255 || strlen($middlename) < 2) $errors[] = "Middlename > 255 symbols or < 2";
// Если ошибки есть - выкидываем нас.
if(count($errors) > 0) sendAnswer(false, $errors);
// Если ошибок нет, просто записываем новосозданного мученика в базу
if( dbexecute("INSERT INTO students (firstname, lastname, middlename, gid) VALUES ('{$firstname}','{$lastname}','{$middlename}','{$gid}')") ){
    sendAnswer(true, ['id' => dbid()]);
    
}
sendAnswer(false, ["Неизвестная ошибка базы данных"]);