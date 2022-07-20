<?php

$dbservername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="auction1";

if(!$conn= mysqli_connect($dbservername,$dbUsername,$dbPassword,$dbName))
{
    die("Failed to connect!");
}
?>