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
    if (!$valid_session = $routes->check_session($usr_C->getRegisterToken())){
        $routes->deny_direct_access();
    };
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
                    
                    <div class="expire" align="center">
                        <p>This form will expire in 5 mins</p>
                    </div>

                    <div class="input-box"> 
                        <input type="text" placeholder="Verification Code" name="input-code" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div name="wrong-code" hidden align="center">
                        <p>Wrong code please try again</p>
                    </div>

                    <input type="submit" class="btn" value="Proceed">

                    <div class="register-link"> 
                        <p>Already have an account?<a href="./login.php">Log in</a></p>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>

<?php
    if ($crud->checkMethod()) {
        $verif_val = $crud->sanitize('input-code');
        $get_user_data = $crud->getRowByValue($usr_C->getTableName(),  $usr_C->getAuthCode(), $verif_val);
        try {   
            if (count($get_user_data) > 0 && $valid_session) {
                // sucess
                $update_data = [
                    $usr_C->getIsAuth() => 1
                ];
             
                if ($crud->updateRecord($usr_C->getTableName(), $usr_C->getAuthCode(), $verif_val, $update_data)){             
                    header("Location: ./success.php");
                    exit;
                }
            } else{
                // failed
                $scripts->removeAttrName("wrong-code", "hidden");
            }   
        } catch (Exception $ex) {
            $scripts->removeAttrName("wrong-code", "hidden");
        } 
    }
?>