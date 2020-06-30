<?php
    require '../dbfile.php';
    require '../ask/ask.html';

    if(isset($_POST["ask"]) && isset($_SESSION["authenticated"]) && strlen($_POST['ask']) > 0){
        $stmt = pg_prepare($dbh,'query', "INSERT INTO questionsasked (username, question) VALUES ($1, $2)");
        $stmt = pg_execute($dbh,'query', array($_SESSION["username"], $_POST["ask"]));
        header("Location: ./questionpage.php?question=" . $_POST['ask']);
    }
    elseif (isset($_POST["ask"]) && !isset($_SESSION["authenticated"]) && strlen($_POST['ask']) > 0) {
        $stmt = pg_prepare($dbh,'query', "INSERT INTO questionsasked (question) VALUES($1)");
        $stmt = pg_execute($dbh,'query', array($_POST["ask"]));
        header("Location: ./questionpage.php?question=" . $_POST['ask']);
    }
?>