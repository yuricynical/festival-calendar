<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/forms/scripts.php";
    require_once "../utils/db/routes.php";
    require_once "../utils/db/encryption.php";
    require_once "../utils/db/mailer.php";
    require_once "../utils/db/files.php";
  
    $usr_C = new UserConstants();
    $conn = new Conn();
    $crud = new Crud();
    $scripts = new Scripts();
    $routes = new Routes();
    $encrypt = new Encryption();
    $mailer= new Mailer();
    $files = new Files();
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Forgot Password</title>
    </head>
    <body>
        <?php include "../components/navbar.php"?>

        <div class="bg-wrapper">
            <div class="login-wrapper">
                <form action="<?php $crud->getCurrentPage() ?>" method="post">

                    <h1>Forgot Password</h1>
                    
                    <div class="input-box"> 
                        <input type="text" placeholder="Enter your email" name="input-email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                
                    <div name="wrong-email" hidden align="center">
                        <p>Wrong email please try again</p>
                    </div>

                    <input type="submit" class="btn" value="Proceed">
                    
                    <div name="failed-send" hidden align="center">
                        <p>Failed to send email</p>
                    </div>

                    <div name="success-send" hidden align="center">
                        <p>Successfully sent to your email. This transaction will expire in 5 mins</p>
                    </div>
                </form>
            </div>
        </div>  
    </body>
</html>

<?php
    if ($crud->checkMethod()) {

       $email_val = $crud->sanitize("input-email");
       $token_val = $encrypt->generateToken();
       $get_user = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getEmail(), $email_val);

       $env = $files->getEnvVar();
       $servername = $env['SERVER_NAME'];
       $resetUrl = $servername . "/main/reset-password.php?" . $usr_C->getForgotToken() . "=" .  $token_val;
        
       $subject_val = "Proceed here to change your password: <a href='" . $resetUrl . "'>Click here</a>";

       if (count($get_user) > 0) {
            if ($mailer->sendMail($email_val, "no-subject", $subject_val)) {
                $routes->init_session($get_user[0][$usr_C->getUserId()], $usr_C->getForgotToken(), $token_val);
                $scripts->removeAttrName("success-send", "hidden");
            }else{
                $scripts->removeAttrName("failed-send", "hidden");
            }
       }else {
            $scripts->removeAttrName("wrong-email", "hidden");
       }
    }
?>