<?php
require './mysql.php';
require './questionpage/questionpage.html';

// need to write function that loads question
function load_question($bool=FALSE){
    if ($bool){
        echo htmlspecialchars($_GET['question']);
    }
}

function verifyquestion(){
    if (isset($_GET['question'])){
        GLOBAL $dbh;
    foreach($dbh->query("SELECT question FROM questionsasked") as $row){
        if ($row['question'] == $_GET['question']){
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
        $stmt = $dbh->prepare("SELECT * FROM questionsanswered WHERE question=?");
        $stmt->execute(array($_GET['question']));
        foreach($stmt->fetchAll() as $row){
            echo '<div id="answer">
                        <h5>
                        <a style="text-decoration: none; color: black;" href="/profile.php?profile=' . urlencode($row['username']) .'">'. $row['username'] .'</a></h5>
                            <p style="text-align: left; padding: 0px 5px 0px 5px;">'
                                . $row['answer'] .
                             '</p>
                 </div>';
        }
    }
}
if(isset($_POST['answerToQ'])){
    $stmt = $dbh->prepare("INSERT INTO questionsanswered (answer, question, username) VALUES (?, ?, ?)");
    $stmt->execute(array($_POST['answerToQ'], $_GET['question'], $_SESSION['username']));
}

?>