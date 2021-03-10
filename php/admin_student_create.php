<?php
// Берём переменные
$students = $options['students'];
$gid = $options['gid'];
// Проверяем данные и записываем в базу
for($i = 0; $i < count($students); $i++){
    $errors = [];
    if(strlen($students[$i]['firstname']) > 255 || strlen($students[$i]['firstname']) < 2) $errors[] = "Firstname[{$i}] > 255 symbols or < 2";
    if(strlen($students[$i]['lastname']) > 255 || strlen($students[$i]['lastname']) < 2) $errors[] = "Lastname[{$i}] > 255 symbols or < 2";
    if(strlen($students[$i]['middlename']) > 255) $errors[] = "Middlename[{$i}] > 255 symbols";
    // Если ошибки есть - выкидываем нас.
    if(count($errors) > 0) sendAnswer(false, $errors);
    // Записываем новосозданного мученика
    if( dbexecute("INSERT INTO students (firstname, lastname, middlename, gid) VALUES ('{$students[$i]['firstname']}','{$students[$i]['lastname']}','{$students[$i]['middlename']}','{$gid}')") ){
        sendAnswer(true, ['id' => dbid()]);
    }
}
sendAnswer(false, ["Неизвестная ошибка базы данных"]);