<?php require '../dbfile.php';

if (isset($_GET["signout"]) && isset($_SESSION['username'])){
    session_destroy();
    echo $_GET['profile'];
    header("Location: ./login.php");
}


function display_name(){
    GLOBAL $dbh;
    $result = pg_query($dbh, "SELECT username, sessionID FROM credentials");
    $result = pg_fetch_all($result, 1);
    foreach($result as $row){
        if ($row["username"] == $_GET['profile']){
            echo htmlspecialchars($row["username"]);
            return True;
        }
    }
        header("Location: ./NotFound.php");
}
function list_questions(){
    $questions = array();
    GLOBAL $dbh;
    $result = pg_query($dbh, "SELECT questionsasked.question, questionsasked.username FROM questionsasked LEFT JOIN credentials ON questionsasked.username = credentials.username");
    $result = pg_fetch_all($result, 1);
    if ($result){
    foreach($result as $row){
        if ($row["username"] == $_GET["profile"]){
            $questions[] = $row['question'];
        }
    }
    foreach($questions as $key => $value){
        echo "<li class='list-group-item'><a href='/questionpage.php?question=" . urlencode(pg_unescape_bytea($value)) . "'>" . htmlspecialchars(pg_unescape_bytea($value)) . "</a></li>";
    }
}
}

function list_answers(){
    $answers = array();
    GLOBAL $dbh;
    $result = pg_prepare($dbh,'query', "SELECT * FROM questionsanswered WHERE username=$1");
    $result = pg_execute($dbh,'query', array($_GET['profile']));
    $result = pg_fetch_all($result, 1);
    if ($result){
    foreach($result as $row){
        if ($row["username"] == $_GET["profile"] && !in_array($row['question'], $answers)){
            $answers[] = $row['question'];
        }
    }
    foreach($answers as $key => $value){
        echo "<li class='list-group-item'><a href='/questionpage.php?question=" . urlencode(pg_unescape_bytea($value)) . "'>" . htmlspecialchars(pg_unescape_bytea($value)) . "</a></li>";
    }
}
}

function is_user(){
    if ($_SESSION['username'] == $_GET['profile']){
        echo '<form action="/profile.php" method="GET"><input name="profile" type="hidden" value="' . $_SESSION['username'] . '"/><button name="signout">Sign out</button></form>';
    }
}

require '../profile/profile.html';
?>