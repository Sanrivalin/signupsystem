<?php

//Configure our session in this folder

// This init_set's are mandatori when you works with sessions
ini_set('session.use_only_cookies',1);
ini_set('session.use_strict_mode',1);

//session_set_cookie_params is a PHP function that allows you to set the parameters for session cookies. This function must be called before session_start() to modify the default behavior of session cookie settings.
session_set_cookie_params([
    'lifetime'=>1800,
    'domain'=>'localhost',
    'path'=>'/',
    'secure'=>true,
    'httponly'=>true
]);

// Start the session
session_start();

//"if" condition wich every 30 minutes is goint in take our cookie and regenerate our id for that cookie.

// Check if the 'last_regeneration' session variable is not set
if(!isset($_SESSION['last_regeneration'])){
    // If it's not set, initialize it with the current timestamp(marca de tiempo)
    regenerate_session_id();
}else {
    $interval = 60 * 30;
    // If it's set, check the time elapsed since the last regeneration
     // Check if more than 30 minutes have passed since the last regeneration then will be updated
    if(time() - $_SESSION['last_regeneration']>= $interval){
        regenerate_session_id();
    }
}

function regenerate_session_id (){
    //is used to regenerate the session ID
    session_regenerate_id();
    //to keep track of when the session ID was last regenerated
    $_SESSION["last_regeneration"]=time();//"Time" gets the current time inside the server
}