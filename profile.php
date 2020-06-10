<?php require 'mysql.php';

if (isset($_GET["signout"]) && isset($_SESSION['username'])){
    session_destroy();
    echo $_GET['profile'];
    header("Location: ./login.php");
}


function display_name(){
    GLOBAL $dbh;
    foreach($dbh->query("SELECT username, sessionID FROM credentials") as $row){
        if ($row["username"] == $_GET['profile']){
            echo $row["username"];
            return True;
        }
    }
        header("Location: ./NotFound.php");
}
function list_questions(){
    $questions = array();
    GLOBAL $dbh;
    foreach(($dbh->query("SELECT questionsasked.question, questionsasked.username FROM questionsasked LEFT JOIN credentials ON questionsasked.username = credentials.username")) as $row){
        if ($row["username"] == $_GET["profile"]){
            $questions[] = $row['question'];
        }
    }
    foreach($questions as $key => $value){
        echo "<li class='list-group-item'><a href='/questionpage.php?question=" . urlencode($value) . "'>" . htmlspecialchars(($value)) . "</a></li>";
    }
}

function list_answers(){
    $questions = array();
    GLOBAL $dbh;
    $stmt = $dbh->prepare("SELECT * FROM questionsanswered WHERE username=?");
    $stmt->execute(array($_GET['profile']));
    foreach($stmt->fetchAll() as $row){
        if ($row["username"] == $_GET["profile"] && !in_array($row['question'], $questions)){
            $questions[] = $row['question'];
        }
    }
    foreach($questions as $key => $value){
        echo "<li class='list-group-item'><a href='/questionpage.php?question=" . urlencode($value) . "'>" . htmlspecialchars(($value)) . "</a></li>";
    }
}

function is_user(){
    if ($_SESSION['username'] == $_GET['profile']){
        echo '<form action="/profile.php" method="GET"><input name="profile" type="hidden" value="' . $_SESSION['username'] . '"/><button name="signout">Sign out</button></form>';
    }
}

require './profile/profile.html';
?>