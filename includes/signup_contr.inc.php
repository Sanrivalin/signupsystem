<?php
//This folder takes care of handling input from the user, take some user data and do somthing with it

declare(strict_types=1);


//To check if one of the params were submited
function is_input_empty(string $username,string $pwd,string $email) {
    if(empty($username)|| empty($pwd)|| empty($email)){
        return true;
    }else {
        return false;
    }
    
}
// Validation if it is a not valid email
function is_email_invalid(string $email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else {
        return false;
    }    
}
//This function connect to data base in signup_model file, it is necesary to pass in our PDO conection as a parameter "$pdo"
function is_username_taken(object $pdo,string $username) {
    //"get_username" come from signup_model folder
    if(get_username($pdo,$username)){
        return true;
    }else {
        return false;
    }    
}

function is_email_registered(object $pdo,string $email) {
    if(get_email($pdo,$email)){
        return true;
    }else {
        return false;
    }    
}
// This function came from signup_model
function create_user(object $pdo,string $pwd, string $username,string $email ) {
    set_user($pdo, $pwd, $username, $email);
 
}


