<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/db/routes.php";
    require_once "../utils/forms/scripts.php";
    require_once "../utils/db/encryption.php";

    $crud = new Crud();
    $usr_C = new UserConstants();
    $routes = new Routes();
    $encrypt = new Encryption();
    $scripts = new Scripts();

    $getForgotToken = $_GET[$usr_C->getForgotToken()];
    $getuser = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getForgotToken(), $getForgotToken);
 
    $valid_session = $routes->check_session($usr_C->getForgotToken());
    if (!$valid_session) {
        $routes->deny_direct_access();
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Log-in</title>
    </head>
    <body>
        <div class="bg-wrapper">
            <div class="login-wrapper">

                <form action="<?php $crud->getCurrentPage() ?>" method="post">

                    <h1>Reset Password</h1>

                    <div class="input-box">
                        <input type="password" placeholder="Password" id="password-box" name="password-input" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <button type="submit" class="btn" name="change-btn">Change</button>  

                    <div class="existing" name="success-changed" hidden>
                        <p>Successfully Changed! Redirecting after 3 seconds</p>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>

<?php
    if ($crud->checkMethod()) {
   
        $password_val = $crud->sanitize("password-input");
     
        $updated_value = [
            $usr_C->getPassword() => $encrypt->encryptPassword($password_val)
        ];
   
        try {
         
            if ($valid_session) { 
                $crud->updateRecord($usr_C->getTableName(), $usr_C->getForgotToken(), $getForgotToken,  $updated_value);
                $scripts->removeAttrName("success-changed", "hidden");   
                session_destroy();
                header( "refresh:3;url=./log-in.php" );
                exit;
            }else {
                session_destroy();
                $routes->deny_direct_access();
            };
        }catch(Exception $ex) {
            session_destroy();
            $routes->deny_direct_access();
        }
    };
?>