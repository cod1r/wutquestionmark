<?php 
require '../dbfile.php';
require '../search/search.html';
if (!isset($_GET['query'])){
    header("Location: ./NotFound.php");
}
function list_questions(){
    $string = $_GET['query'];
    $questions = array();
    $words = explode(' ', $string);
    GLOBAL $dbh;
    $result = pg_query($dbh, "SELECT question FROM questionsasked");
    $result = pg_fetch_all($result, 1);
    foreach($result as $q){
        foreach($words as $word){
            for ($x = 0; $x < strlen(pg_unescape_bytea($q['question']))-strlen($word); $x++){
                if (substr(strtolower(pg_unescape_bytea($q['question'])), $x, strlen($word)) == $word){
                    $questions[] = pg_unescape_bytea($q['question']);
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