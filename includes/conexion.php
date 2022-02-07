<?php

    /*$dbhost = "localhost";
    $dbuser = "u131637185_cardinal";
    $dbpass = "159Admin";
    $db = "u131637185_depositosdb";*/

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "depositoslocal";


    $con = new mysqli($dbhost,$dbuser,$dbpass,$db);
    $con->set_charset("utf8");
?>

