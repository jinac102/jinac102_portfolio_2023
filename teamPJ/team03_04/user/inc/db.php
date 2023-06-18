<?php
    $hostname = 'localhost';
    $dbuserid = 'jinac102';
    $dbpasswd = 'jina3172!';
    $dbname = 'jinac102';

    $mysqli = new mysqli($hostname,$dbuserid, $dbpasswd,$dbname);
    if($mysqli -> connect_errno){
        die('Connect Error:'.$mysqli->connect_error);
    } 
?>