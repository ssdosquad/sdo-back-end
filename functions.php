<?php
// Получаем текущий аккаунт, если есть сессия
function getUser($session){
    $req = dbquery("SELECT accounts.* FROM accounts, sessions WHERE accounts.id = sessions.aid AND sessions.skey = '{$session}' LIMIT 1");
    if(count($req) > 0){
        if($req[0] != null) return $req[0];
    }
    sendAnswer(false, ["Сессия управляющего аккаунта недействительна"]);
}
// Отправляем ответ
function sendAnswer($t, $data = []){
    $type = ($t) ? "success" : "error";
    exit(json_encode(["type" => $type, "data" => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}