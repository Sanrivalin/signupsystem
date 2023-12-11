<?php
//Checking for server request method
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Grabbing the date from the user
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

         // ERROR HANDLERS
         $errors=[];
        
         if(is_input_empty($username,$pwd)){
             //Associative array (key=value)
             $errors["empty_input"]="Fill in all fields!"; 
         }

         //Grabbing the data
         //To check if username(user) is equal to username(database)
         $result = get_user($pdo,$username);


         //Checking if we have or not results from the database
         // If username match...
         if(is_username_wrong($result)){
            //Associative array (key=value)
            $errors["login_incorret"]="Incorret login info!"; 
        }
        //If password match...
        if(!is_username_wrong($result) && is_password_wrong($pwd,$result["pwd"])){
            //Associative array (key=value)
            $errors["login_incorret"]="Incorret login info!"; 
        }
 
         //"config_session has a session started then we requered it"
         require_once "config_session.inc.php";
         //If we have $errors
         if($errors){
             $_SESSION["errors_login"]=$errors;               
             header("Location: ../index.php");
             die();
         }
         //Create new session id
         $newSessionId= session_create_id();
         //append
         $sessionId=$newSessionId . "_" . $result["id"];
         //Get and/or set the current session id
         session_id($sessionId);

         //At this point we do actually have a user that tried to sign up with a username that exists inside the database
         //and also a password that matches with the password inside the database, then what we can do we can actually sign up
         //the user inside the web site.
         $_SESSION["user_id"]=$result["id"];
         $_SESSION["user_name"]=htmlspecialchars($result["username"]);

         $_SESSION["last_regeneration"]=time();

         header("Location: ../index.php?login=success");
         $pdo=null;
         $statement=null;

         die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}else {
    header("Location: ../index.php");
    die();

}