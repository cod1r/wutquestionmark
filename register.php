<?php
require 'mysql.php';
require './register/register.html';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST["email"])){
    $stmt = $dbh->prepare("INSERT INTO credentials (username, password, sessionID , email) VALUES (?, ?, ?, ?)");
    $stmt->execute(array($_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), session_id(), $_POST['email']));
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["authenticated"] = true;
    ob_clean();
    header("Location: ./profile.php?profile=" . $_POST['username']);
}
?>