<?php 
require './mysql.php';
require './search/search.html';
function list_questions(){
    $string = $_GET['query'];
    $questions = array();
    $words = explode(' ', $string);
    GLOBAL $dbh;
    foreach(($dbh->query("SELECT question FROM questionsasked")) as $q){
        foreach($words as $word){
            for ($x = 0; $x < strlen($q['question'])-strlen($word); $x++){
                if (substr(strtolower($q['question']), $x, strlen($word)) == $word){
                    $questions[] = $q['question'];
                    break;
                }
            };
        }
    }
    foreach($questions as $key => $value){
        echo "<li class='search-result'><a href='/questionpage.php?question=" . urlencode($value) . "'>" . htmlspecialchars(($value)) . "</a></li>";
    }
}
?>