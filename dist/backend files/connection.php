<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "hospital-portal";


// checks if database connection is successful
if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("failed to connect!");
}
?>
