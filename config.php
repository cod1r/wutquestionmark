<?php
session_start();
setcookie("sessid", session_id());
return [
    'host' => 'localhost',
    'name' => 'quora2',
    'user' => 'root',
    'pass' => 'root'
];
?>