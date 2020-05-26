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
    $questions = array();
    GLOBAL $dbh;
    foreach(($dbh->query("SELECT questionsasked.question, questionsasked.username FROM questionsasked LEFT JOIN credentials ON questionsasked.username = credentials.username")) as $row){
        if ($row["username"] == $_SESSION["username"]){
            $questions[] = $row['question'];
        }
    }
    foreach($questions as $key => $value){
        echo "<li class='list-group-item'><a href='/questionpage.php?question=" . urlencode($value) . "'>" . htmlspecialchars(substr($value, 0, 40)) . "</a><form style='float:right;' method='POST'><button class='btn btn-primary' name='delete' value='" . urlencode($value) . "'>Delete?</button></form></li>";
    }
}

if (isset($_POST['delete'])){
    $stmt = $dbh->prepare("DELETE FROM questionsasked WHERE username = ? and question = ?");
    $stmt->execute(array($_SESSION["username"], urldecode($_POST['delete'])));
    header("Location: ./profile.php");
}

if (isset($_GET["signout"])){
    session_destroy();
    header("Location: ./login.php");
}
require './profile/profile.html';
?>