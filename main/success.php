<?php
    require_once "../utils/db/routes.php";
    require_once "../constants/users.php";
    $routes = new Routes();
    $usr_C = new UserConstants();

    // deny direct access
    if(!$routes->check_session($usr_C->getRegisterToken())) {
        $routes->deny_direct_access();
    };
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Success</title>
    </head>
    <body>
        <div class="bg-wrapper">
            <div class="login-wrapper">
                <h1>Sucessfully Registered</h1>
                <a href="./log-in.php"><button class="btn">Go Back to Login </button></a>
            </div>
        </div>  
    </body>
</html> 