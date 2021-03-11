<?php
// Получаем переменную
$sid = $options['sid'];
if( ($query = dbquery("SELECT * FROM students WHERE id = '{$sid}' LIMIT 1")) != null ){
    sendAnswer(true, ["data" => $query]);
}
sendAnswer(false, ["Student with [sid:{$sid}] is missing"]);