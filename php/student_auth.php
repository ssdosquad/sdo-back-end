<?php
// Получаем тип авторизации
$type = $options['type'];
// Производим операцию исходя из типа
switch($type){
    case "group":
        // Получаем список групп
        $groups = dbquery("SELECT * FROM student_group");
        sendAnswer(true, ["groups" => $groups]);
        break;
    case "student":
        // Определяем id группы студентов
        $gid = $options['gid'];
        // Получаем список студентов
        $students = dbquery("SELECT * FROM students WHERE gid = '{$gid}'");
        sendAnswer(true, ["students" => $students]);
        break;
    case "signin":
        // Определяем какие параметры отсутствуют
        if(empty($options['sid'])) sendAnswer(false, ["Argument [sid] is missing!"]);
        // Определяем переменные
        $sid = $options['sid'];
        // Если не находим авторизацию этого пользователя в базе
        if( ($query = dbquery("SELECT * FROM student_auth WHERE sid = '{$sid}' AND closed = '0' LIMIT 1")) == null ){
            // Создаём ключ сессии студента и записываем всё это в базу
            $skey = hash("sha256", time().$sid);
            if( dbexecute("INSERT INTO student_auth (sid, skey) VALUES ('{$sid}', '{$skey}')") ){
                sendAnswer(true, ["session" => $skey]);
            }
        }
        sendAnswer(false, ["Этот студент уже авторизован на другом устройстве"]);
        break;
}
sendAnswer(false, ["Неверный тип у запроса"]);