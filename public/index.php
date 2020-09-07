<?php 
require '../dbfile.php';
require '../homepage/home.html'; 

function count_questions(){
    $questions = array();
    GLOBAL $dbh;
    $result = pg_query($dbh, "SELECT question FROM questionsasked");
    $result = pg_fetch_all($result, 1);
    echo count($result);
}
?>