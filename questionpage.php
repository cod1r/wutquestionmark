<?php
require './mysql.php';
require './questionpage/questionpage.html';

// need to write function that loads question
function load_question($bool=FALSE){
    if ($bool){
        echo htmlspecialchars($_GET['question']);
    }
    else{
        header("Location ./NotFound.php");
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
    load_question(False);
    return False;
}

function load_answers($bool=FALSE){
    GLOBAL $dbh;
    if($bool){
        $stmt = $dbh->prepare("SELECT * FROM questionsanswered WHERE question=?");
        $stmt->execute(array($_GET['question']));
        foreach($stmt->fetchAll() as $row){
            echo '<div id="answer" style="border: 1px solid grey;border-radius: 5px; ">
                        <h5 style="text-align: left; border-bottom: 1px solid grey; background-color: #5bc0de; padding: 5px">'. $row['username'] .'</h5>
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