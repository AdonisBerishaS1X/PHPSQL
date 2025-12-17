<?php
include_once("config.php");

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    
    $sql="INSERT INTO users (name,username,email) values (:name,:username,:email)";
    $sqlQuery=$conn->prepare($sql);

    $sqlQuery->bindParem(":name",$name);
    $sqlQuery->bindParem(":username",$username);
    $sqlQuery->bindParem(":email",$email);
    $sqlQuery->execute();

    echo "Data saved successfully";
    header("dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="username" placeholder="Userame">
        <input type="text" name="email" placeholder="email">
        <button type="submit" name="submit">Add</button>
    </form>
    </body>
</html>