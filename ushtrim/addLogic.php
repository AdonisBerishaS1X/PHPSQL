<?php
include_once('config.php');

if(isset($_POST['submit'])){

    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="INSERT into user(name,username,email,password) VALUES (;name,username,email,password)";
    $sqlQuery=$conn->prepare($sql);

    $sqlQuery->bindParam(':name',$name);
    $sqlQuery->bindParam(':email',$email);
    $sqlQuery->bindParam(':username',$username);
    $sqlQuery->bindParam(':password',$password);

    $sqlQuery->execute();
    echo "The user was added successfully!";
    header("refresh:2;url=dashboard.php");

}