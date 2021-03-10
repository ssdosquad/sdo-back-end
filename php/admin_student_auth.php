<?php
// Определяем тип
$type = $options['type'];
// Исходим из типа
switch($type){
    case "get":
        // Получаем сессии из базы
        $sessions = dbquery("SELECT 
        student_auth.skey, 
        students.firstname, 
        students.lastname, 
        students.middlename,
        student_group.name
        FROM 
        student_auth, 
        students,
        student_group
        WHERE 
        closed = '0' AND
        students.id = student_auth.sid AND
        student_group.id = students.gid");
        sendAnswer(true, ['sessions' => $sessions]);
        break;
    case "kick":
        $skey = $options['studkey'];
        // Если сессия есть
        if( ($query = dbquery("SELECT * FROM student_auth WHERE skey = '{$skey}' AND closed = '0' LIMIT 1")) != null ){
            // Тогда закрываем сессию
            if( dbexecute("UPDATE student_auth SET closed = '1' WHERE skey = '{$skey}' LIMIT 1") ){
                sendAnswer(true, []);
            }
            sendAnswer(false, ["Неизвестная ошибка базы"]);
        }
        sendAnswer(false, ["Активная сессия по ключу отсутствует"]);
        break;
    case "kickall":
        // Если есть активыне сессии
        if( ($query = dbquery("SELECT * FROM student_auth WHERE closed = '0' LIMIT 1")) != null ){
            // Закрываем их
            if( dbexecute("UPDATE student_auth SET closed = '1' WHERE closed = '0'") ){
                sendAnswer(true, []);
            }
            sendAnswer(false, ["Неизвестная ошибка базы данных"]);
        }
        sendAnswer(false, ["Активные сессии отсутствуют"]); 
        break;
}