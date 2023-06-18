<?php
    $hostname = 'localhost';
    $dbuserid = 'jinac102';
    $dbpasswd = 'claude158!';
    $dbname = 'jinac102';

    $mysqli = new mysqli($hostname,$dbuserid, $dbpasswd,$dbname);
    if($mysqli -> connect_errno){
        die('Connect Error:'.$mysqli->connect_error);
    } 
?>