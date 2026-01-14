<?php 

$user="root";
$pass="";
$server="localhost";
$dbname="mms";

try{
    $conn=new PDoO("mysql:host=$server;dbname=$dbname",$user,$pass);

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}