<?php
//Requered folders.
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    
<div class="container">
<h3>
        <?php
        output_username();
        ?>
    </h3>

    <?php
     if(!isset($_SESSION["user_id"])){?>
     
     <!-- Login -->
    
        <h3>Login</h3>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name='username' placeholder='User Name'>
            <input type="text" name='pwd' placeholder='Password'>
            <button>Login</button>
        </form>
    <?php }

    ?> 
           
    <?php
    check_login_errors();
    ?>

    <!-- Signup -->

        <h3>Sign Up</h3>
        <form action="includes/signup.inc.php" method="post">
            <?php
            //all the inputs were replaces with a piece of PHP, that is goin to check if we did actually have some data sent back to this form, to shows differents version of these inputs
            signup_inputs ();
            ?>            
            <button>Sign Up</button>
        </form>
        <?php
    check_signup_errors();
    ?>    
    <!-- Logout -->
    
    <h3>Logout</h3>
        <form action="includes/logout.inc.php" method="post">
            <button>Logout</button>
        </form>
    </div>  
    
</body>
</html>