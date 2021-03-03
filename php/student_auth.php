<?php
$type = $options['type'];
if($type == "group") {
    // Получаем список групп
    $groups = dbquery("SELECT * FROM student_group");
    sendAnswer(true, ["groups" => $groups]);
} else if ($type == "student") {
    // Определяем id группы студентов
    $gid = $options['gid'];
    // Получаем список студентов
    $students = dbquery("SELECT * FROM students WHERE gid = '{$gid}'");
    sendAnswer(true, ["students" => $students]);
}
sendAnswer(false, ["Неверный тип у запроса"]);