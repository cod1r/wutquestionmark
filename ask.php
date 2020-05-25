<?php
    require './mysql.php';
    require './ask/ask.html';

    if(isset($_POST["ask"]) && isset($_SESSION["authenticated"]) && strlen($_POST['ask']) > 0){
        $stmt = $dbh->prepare("INSERT INTO questionsasked (username, question) VALUES (?, ?)");
        $stmt->execute(array($_SESSION["username"], $_POST["ask"]));
        header("Location: ./questionpage.php?question=" . $_POST['ask']);
    }
    elseif (isset($_POST["ask"]) && !isset($_SESSION["authenticated"]) && strlen($_POST['ask']) > 0) {
        $stmt = $dbh->prepare("INSERT INTO questionsasked (question) VALUES(?)");
        $stmt->execute(array($_POST["ask"]));
        header("Location: ./questionpage.php?question=" . $_POST['ask']);
    }
?>