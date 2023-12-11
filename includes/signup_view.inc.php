<?php
// This file outpoting something using PHP

declare(strict_types=1);
//This function has conditions that are goint to check if we have this data being sent back to a signup form because of an error message and if that is the case, then I  want to include that data inside my inputs, instead of having just the regular inputs with no data.
function signup_inputs (){
    if(isset($_SESSION["signup_data"]["username"])&& !isset($_SESSION["errors_signup"]["username_taken"])){
        echo '<input type="text" name="username" placeholder="User Name" value="' . $_SESSION["signup_data"]["username"] . '">';
    }else {
        echo '<input type="text" name="username" placeholder="User Name">';
    }
    echo '<input type="password" name="pwd" placeholder="Password">';
    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"])&& !isset($_SESSION["errors_signup"]["invalid_email"])){
        echo '<input type="text" name="email" placeholder="Email" value="' . $_SESSION["signup_data"]["email"] . '">';
    }else {
        echo '<input type="text" name="email" placeholder="Email">';
    }
}

function check_signup_errors (){
    //To check if we have these errors stored inside the session, "errors_signup" came from signup folder.
    if(isset($_SESSION['errors_signup'])){
        $errors = $_SESSION['errors_signup'];
        echo "<br>";
        
        foreach($errors as $error){
            echo '<p class="form-error">'. $error . '</p>';            
        }
        //Unsetting our session variable
        unset($_SESSION['errors_signup']);

        //If connection was success
        //Isset function BELLOW check if we have certain GET method inside the URL, GET capture anysort of data displayed inside the URL example: "signup=success".
    }else if (isset($_GET["signup"]) && $_GET["signup"]=== "success"){
        echo '<br>';
        echo '<p class="form-success">Signup Success!</p>';
    }
}