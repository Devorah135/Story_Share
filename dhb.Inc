<?php

$serverName="localhost";
$dBUsername="root";
$dBPassword="";
$dBName="stories";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}





