<?php
require '../dbfile.php';
require '../questionpage/questionpage.html';
// $result = pg_prepare($dbh,'q', "INSERT INTO questionsanswered (answer, question, username) VALUES ($1, $2, $3)");
// $result = pg_execute($dbh,'q', array('a', $_GET['question'], $_SESSION['username']));
// need to write function that loads question
function load_question($bool=FALSE){
    if ($bool){
        echo htmlspecialchars($_GET['question']);
    }
}

function verifyquestion(){
    if (isset($_GET['question'])){
        GLOBAL $dbh;
        $result = pg_query("SELECT question FROM questionsasked");
        $result = pg_fetch_all($result, 1);
    foreach($result as $row){
        if (pg_unescape_bytea($row['question']) == $_GET['question']){
            load_question(TRUE);
            return True;
        }
    }
}
    header("Location: ./NotFound.php");
}

function load_answers($bool=FALSE){
    GLOBAL $dbh;
    if($bool){
        $result = pg_prepare($dbh,'query', "SELECT * FROM questionsanswered WHERE question=$1");
        $result = pg_execute($dbh,'query', array($_GET['question']));
        $result = pg_fetch_all($result, 1);
        if ($result)
        {
            foreach($result as $row)
            {
            echo '<div id="answer">
                        <h5>
                        <a style="text-decoration: none; color: black;" href="/profile.php?profile=' . urlencode($row['username']) .'">'. $row['username'] .'</a></h5>
                            <p style="text-align: left; padding: 0px 5px 0px 5px;">'
                                . pg_unescape_bytea($row['answer']) .
                             '</p>
                 </div>';
            }
        }
    }
}


if(isset($_POST['answerToQ'])){
    $result = pg_prepare($dbh,'answer', "INSERT INTO questionsanswered (answer, question, username) VALUES ($1, $2, $3)");
    $result = pg_execute($dbh,'answer', array($_POST['answerToQ'], $_GET['question'], $_SESSION['username']));
    echo 'hi';
}

?>