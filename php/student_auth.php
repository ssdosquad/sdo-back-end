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
        // Время сессии (3 часа)
        $stime = time()+10800; 
        // Если не находим авторизацию этого пользователя в базе
        if( ($query = dbquery("SELECT * FROM student_auth WHERE sid = '{$sid}' AND closed = '0' LIMIT 1")) == null ){
            // Создаём ключ сессии студента и записываем всё это в базу
            $skey = hash("sha256", time().$sid);
            if( dbexecute("INSERT INTO student_auth (sid, skey, stime) VALUES ('{$sid}', '{$skey}', '{$stime}')") ){
                sendAnswer(true, ["session" => $skey, "stime" => ($stime - time())]);
            }
        }
        sendAnswer(false, ["Этот студент уже авторизован на другом устройстве"]);
        break;
    case "signout":
        // Определяем ключ авторизации студента
        $studkey = $options['studkey'];
        // Отключаем сессию, если есть активная
        if( ($query = dbquery("SELECT * FROM student_auth WHERE closed = '0' AND skey = '{$skey}' LIMIT 1")) != null ){
            if( dbexecute("UPDATE student_auth SET closed = '1' WHERE skey = '{$skey}' LIMIT 1") ){
                sendAnswer(true, []);
            }
        }
        sendAnswer(false, ["Нет активной сессии с этим ключом"]);
        break;
}
sendAnswer(false, ["Неверный тип у запроса"]);