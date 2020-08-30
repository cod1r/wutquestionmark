<?php
require '../dbfile.php';
require '../register/register.html';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST["email"])){
    $result = pg_prepare($dbh,'query', "INSERT INTO credentials (username, password, sessionID , email) VALUES ($1, $2, $3, $4)");
    $result = pg_execute($dbh,'query', array($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), session_id(), $_POST['email']));
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["authenticated"] = true;
    ob_clean();
    header("Location: ./profile.php?profile=" . $_POST['username']);
}
?>