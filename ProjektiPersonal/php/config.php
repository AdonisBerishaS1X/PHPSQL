<?php

$user="root";
$pass="";
$server="localhost";
$dbname="wikilogin";

$conn = mysqli_connect($server, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
