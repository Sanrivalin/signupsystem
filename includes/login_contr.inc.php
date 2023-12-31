<?php

declare(strict_types=1);

function is_input_empty(string $username, string $pwd){
    if(empty($username) || empty($pwd)){
        return true;
    }else {
        return false;
    }    
}
//If the username exist it going to return an array , 
//but it is not, it is goin to return a boolen(false).
function is_username_wrong(bool|array $result){
    if(!$result){
        return true;
    }else {
        return false;
    }    
}
// $pwd is the password submmited by the user, $hashedPwd 
//is from inside our database.
function is_password_wrong(string $pwd, string $hashedPwd){
    //password_verify Checks if the given hash matches the given options.
    if(!password_verify($pwd,$hashedPwd)){
        return true;
    }else {
        return false;
    }    
}

