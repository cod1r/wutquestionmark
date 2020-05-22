<?php require 'index.php';require 'mysql.php';
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
            echo "<li class='list-group-item'>" . $row["question"] . "</li>";
        }
    }
}
require './profile/profile.html';

?>