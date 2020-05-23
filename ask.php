<?php
    require './mysql.php';
    require './ask/ask.html';

    if(isset($_POST["ask"]) && isset($_SESSION["authenticated"])){
        $stmt = $dbh->prepare("INSERT INTO questionsasked (username, question) VALUES (?, ?)");
        $stmt->execute(array($_SESSION["username"], $_POST["ask"]));
    }
    elseif (isset($_POST["ask"]) && !isset($_SESSION["authenticated"])) {
        $stmt = $dbh->prepare("INSERT INTO questionsasked (question) VALUES(?)");
        $stmt->execute(array($_POST["ask"]));
    }
?>