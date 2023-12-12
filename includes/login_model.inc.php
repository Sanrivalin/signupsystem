<?php

declare(strict_types=1);

//Query the data base using the username provided by the user to see if the user
//exists insede the data base. 

function get_user(object $pdo,string $username){
    $query = "SELECT * FROM users WHERE username=:username;";
    $stmt = $pdo->prepare($query);//To prevent SQL injection.
    $stmt->bindParam(':username',$username);
    $stmt->execute();
    //To check if we did actually grab a raw data when we search a username that the user typed inside the input.
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}