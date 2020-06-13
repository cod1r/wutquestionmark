<?php 
    require 'session.php';
    $cred = include('config.php');
    $dbh = pg_connect(getenv("postgres://obnjdfzxjjusbv:fc93a005d1f42cfe3122227357d5065871fcab7ab7bd2dfcde1c5136c5b249c0@ec2-52-70-15-120.compute-1.amazonaws.com:5432/dah1ti7pp5cvhp")) or die("COULD NOT CONNECT: " . pg_last_error());
    // $stat = pg_connection_status($dbh);
    // if ($stat === PGSQL_CONNECTION_OK) {
    //     echo 'Connection status ok';
    // } else {
    //     echo 'Connection status bad';
    // }    
?>