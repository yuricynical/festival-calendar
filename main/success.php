<?php
    require_once "../utils/db/routes.php";
    $routes = new Routes();

    // deny direct access
    $routes->check_session();
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
                <a href="./log-in.php"><button class="btn">Go Back to Login </button></a>
            </div>
        </div>  
    </body>
</html>