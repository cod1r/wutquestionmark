<?php 
    $cred = include('config.php');
    $dbh = new PDO("mysql: host=localhost;dbname=quora2", $cred['user'], $cred['pass'], array(
        PDO::ATTR_PERSISTENT => true
    ));
    
?>