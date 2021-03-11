<?php
// Берём переменные
$sid = $options['sid'];
$firstname = $options['firstname'];
$lastname = $options['lastname'];
$middlename = $options['middlename'];
$gid = $options['gid'];
// Проверяем данные
$errors = [];
if( dbquery("SELECT * FROM students WHERE id = '{$sid}'") == null ) $errors[] = "Student is missing";
if(strlen($firstname) > 255 || strlen($firstname) < 2) $errors[] = "Firstname > 255 symbols or < 2";
if(strlen($lastname) > 255 || strlen($lastname) < 2) $errors[] = "Lastname > 255 symbols or < 2";
if(strlen($middlename) > 255 || strlen($middlename) < 2) $errors[] = "Middlename > 255 symbols or < 2";
// Если ошибки есть - выкидываем нас.
if(count($errors) > 0) sendAnswer(false, $errors);
// Если ошибок нет, просто записываем новосозданного мученика в базу
if( dbexecute("UPDATE students SET firstname = '{$firstname}', lastname = '{$lastname}', middlename = '{$middlename}', gid = '{$gid}' WHERE id = '{$sid}' LIMIT 1") ){
    sendAnswer(true, []);    
}
sendAnswer(false, ["Неизвестная ошибка базы данных"]);