<?php

function sendAnswer($t, $data = []){
    $type = ($t) ? "success" : "error";
    exit(json_encode(["type" => $type, "data" => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}