<?php

include_once 'config.php';

if(isset($_POST['register'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $tempPass=$_POST['password'];
    
    $confirm_password=$_POST['confirm_password'];

    if($password === $confirm_password){
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if($stmt->execute()){
            echo "Registration successful!";
        } else {
            echo "Error during registration.";
        }
    } else {
        echo "Passwords do not match.";
    }
}