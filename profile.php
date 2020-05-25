<?php require 'mysql.php';
function display_name(){
    GLOBAL $dbh;
    foreach($dbh->query("SELECT username, sessionID FROM credentials") as $row){
        if ($row["sessionID"] == session_id()){
            echo $row["username"];
            break;
        }
    }
}
function list_questions(){
    GLOBAL $dbh;
    foreach(($dbh->query("SELECT questionsasked.question, questionsasked.username FROM questionsasked LEFT JOIN credentials ON questionsasked.username = credentials.username")) as $row){
        if ($row["username"] == $_SESSION["username"]){
            echo "<li class='list-group-item'><a href='/questionpage.php?question=" . urlencode($row['question']) . "'>" . $row["question"] . "</a><form style='float:right;' method='POST'><button class='btn btn-primary' name='delete' value='" . $row['question'] . "'>Delete?</button></form></li>";
        }
    }
}

if (isset($_POST['delete'])){
    $stmt = $dbh->prepare("DELETE FROM questionsasked WHERE username = ? and question = ?");
    $stmt->execute(array($_SESSION["username"], $_POST['delete']));
}

if (isset($_GET["signout"])){
    session_destroy();
    header("Location: ./login.php");
}
require './profile/profile.html';
?>