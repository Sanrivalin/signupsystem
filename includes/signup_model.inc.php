<?php

//This file only interact whit the database querying, getting, submmiting, updating, or deliting data from the database. Only controller file is going to interact whi this file.

declare(strict_types=1);

// The PDO conection is being passed by parameter like "$pdo"

//Function to check if the user is already taken
function get_username(object $pdo,string $username){
    $query = "SELECT username FROM users WHERE username=:username;";
    $stmt = $pdo->prepare($query);//To prevent SQL injection
    $stmt->bindParam(':username',$username);
    $stmt->execute();
    //To check if we did actually grab a raw data when we search a username that the user typed inside the input
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
//Function to check if the email is already registered
function get_email(object $pdo,string $email){
    $query = "SELECT username FROM users WHERE email=:email;";
    $stmt = $pdo->prepare($query);//To prevent SQL injection
    $stmt->bindParam(':email',$email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo,string $pwd, string $username,string $email ){
    $query = "INSERT INTO users (username,pwd,email) VALUES (:username,:pwd,:email);";
    $stmt = $pdo->prepare($query);
    //Hashing parameter
    $options = [
        'cost'=>12
    ];
    $hashedPwd = password_hash($pwd,PASSWORD_BCRYPT,$options);

    $stmt->bindParam(":username",$username);
    $stmt->bindParam(":pwd",$hashedPwd);
    $stmt->bindParam(":email",$email);
    $stmt->execute();
}