<?php 
require '../dbfile.php';
if(isset($_SESSION["authenticated"]))
    {
        global $dbh;
        $result = pg_query($dbh, "SELECT username, sessionid, password FROM credentials");
        $result = pg_fetch_all($result, 1);
        foreach ($result as $row){
            if ($row["sessionid"] == session_id()){
                $_SESSION["username"] = $row["username"];
                header("Location: ./profile.php?profile=" . $row['username']);
                break;
            }
        }
    }
    require './login/login.html';

if (isset($_POST['username']) && isset($_POST['password'])){
    $result = pg_query($dbh, "SELECT username, sessionid, password FROM credentials");
    $result = pg_fetch_all($result, 1);
    foreach($result as $row){
        if ($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]){
            $stmt2 = pg_prepare($dbh,'hi', "UPDATE credentials SET sessionid = $1 WHERE username =  $2 AND password = $3"); 
            $stmt2 = pg_execute($dbh,'hi', array(session_id(), 'jasonho', '123456'));
            $_SESSION['success'] = $stmt2;
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
