<?php

//This file run the code for sign us up and locking us in.


//"if" condition to check if the user actually accessed this page legitimately


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Grabbing the date from the user
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $email = $_POST['email'];

    try{
        //Connecting to database and other folders to implement MVC model(Model,View,Control)
        require_once "dbh.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        // ERROR HANDLERS
        $errors=[];

        // These classes come from "signuo_contr", these clasees check if these ones are returning true o false
        if(is_input_empty($username,$pwd,$email)){
            //Associative array (key=value)
            $errors["empty_input"]="Fill in all fields!";

        }if(is_email_invalid($email)){
            $errors["empty_email"]="Invalid email used!";

        }if(is_username_taken($pdo,$username)){
            $errors["username_taken"]="Username already taken!";

        }if(is_email_registered($pdo,$email)){
            $errors["email_used"]="Email already registered!";
        }

        //"config_session has a session started"
        require_once "config_session.inc.php";
        //If we have $errors
        if($errors){
            //Assigning _SESSIONS variable to a value ($errors), and have that stored inside our session.
            $_SESSION["errors_signup"]=$errors;
            //This array contain all the data submitted by the user to send it back to our index page.
            $signupData = [
                "username" => $username, 
                "email" => $email
            ];
            //Assigning it inside a session variable.
            $_SESSION["signup_data"]=$signupData;
            
            header("Location: ../index.php");
            die();
        }

        //At this momeent everything was well, then is time to create our new user "create_user". This function came from signup_contr.
        create_user($pdo, $pwd, $username, $email);

        //After running this function we just signidup the user inside our website.

        //Is time to stop the rest of the scrip from running.
        header("Location: ../index.php?signup=success");// including success message.

        //Closing off my connection and my stament.
        $pdo= null;
        $stmt= null;

        die();

    }catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}else {
    header("Location: ../index.php");
    die();

}