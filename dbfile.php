<?php 
    require 'session.php';
    $cred = include('config.php');
    $dbh = pg_connect(getenv("DATABASE_URL")) or die("COULD NOT CONNECT: " . pg_last_error());
    // $stat = pg_connection_status($dbh);
    // if ($stat === PGSQL_CONNECTION_OK) {
    //     echo 'Connection status ok';
    // } else {
    //     echo 'Connection status bad';
    // }    
?>