<?php
require './mysql.php';
require './questionpage/questionpage.html';

// need to write function that loads question
function load_question($bool=FALSE){
    if ($bool){
        echo htmlspecialchars($_GET['question']);
    }
    else{
        http_response_code(404);
        header('HTTP/1.1 404 Not Found');
        echo "404<br><h2 style='text-align: center;'>Wut?</h2>";
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
?>