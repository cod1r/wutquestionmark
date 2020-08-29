<?php 
require './mysql.php';
    foreach ($dbh->query("SELECT username, sessionID FROM credentials") as $row){
        if ($row["sessionID"] == session_id() && isset($_SESSION["authenticated"])){
            $_SESSION["username"] = $row["username"];
            header("Location: ./profile.php?profile=" . $row['username']);
            break;
        }
    }
    require './login/login.html';

if (isset($_POST['username']) && isset($_POST['password'])){
    foreach(($dbh->query("SELECT username, password FROM credentials")) as $row){
        if ($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){
            $stmt2 = $dbh->prepare("UPDATE credentials SET sessionID = ? WHERE username =  ? AND password = ?"); 
            $stmt2->execute(array(session_id(), $row["username"], $row["password"]));
            $_SESSION["username"] = $row["username"];
            $_SESSION["authenticated"] = true;
            header("Location: ./profile.php?profile=" . $row['username']);
            break;
        }
    }
}
// if username exists already
// <div class="alert alert-primary" role="alert">
//   A simple primary alert—check it out!
// </div>
?>
