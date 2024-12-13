<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/forms/scripts.php";
    require_once "../utils/db/routes.php";

    $usr_C = new UserConstants();
    $crud = new Crud();
    $scripts = new Scripts();
    $routes = new Routes();

    // deny direct access
    $routes->check_session();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Verify</title>
    </head>
    <body>
        <div class="bg-wrapper">
            <div class="login-wrapper">
                <form action="<?php $crud->getCurrentPage() ?>" method="post">

                    <h1>Verify</h1>

                    <div class="input-box">
                        <input type="text" placeholder="Verification Code" name="input-code" required>
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div class="existing" name="wrong-code" hidden>
                        <p>Wrong code please try again</p>
                    </div>

                    <input type="submit" class="btn" value="Register">

                    <div class="register-link"> 
                        <p>Already have an account?<a href="./login.php">Log in</a></p>
                    </div>
                        
                    <div name="unable-send" align="center" hidden>
                        <p>Unable to send email</p>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>

<?php
    if ($crud->checkMethod()) {

        
    }
?>