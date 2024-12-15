<?php
    ob_start();
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/db/encryption.php";
    require_once "../utils/db/mailer.php";
    require_once "../utils/forms/scripts.php";
    require_once "../utils/db/routes.php";

    $usr_C = new UserConstants();
    $encrypt = new Encryption();
    $mailer = new Mailer();
    $crud = new Crud();
    $scripts = new Scripts();
    $routes = new Routes();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Register</title>
    </head>
    <body>
        <?php include "../components/navbar.php"?>
        
        <div class="bg-wrapper">
            <div class="login-wrapper">
                <form action="<?php echo $crud->getCurrentPage()?>" method="post">

                    <h1>Register</h1>

                    <div class="input-box">
                        <input type="text" placeholder="Username" name="username" required>
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div class="existing" name="existing-name" hidden>
                        <p>Existing Username</p>
                    </div>
      
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="existing" name="existing-email" hidden>
                        <p>This email is already registered</p>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password" required>
                        <i class="fa-solid fa-lock"></i>
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
        $emailVal = $crud->sanitize("email");
        $usernameVal = $crud->sanitize("username");
        $auth = $encrypt->generateAuthCode();
        $token = $encrypt->generateToken();
        $passwordVal = $encrypt->encryptPassword($crud->sanitize("password"));
    
        $get_email = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getEmail(), $emailVal);
        $get_usernames = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getUsername(), $usernameVal);
        
        $subject_text = "Your verification code for festival calendar: <b>" . $auth . "</b>";
        
        $insertMode = True;
        $valid = True;

        $data = [
            $usr_C->getEmail() => $emailVal,
            $usr_C->getUsername() => $usernameVal,
            $usr_C->getPassword() => $passwordVal,
            $usr_C->getAuthCode() => $auth
        ];

        // HANDLE EXISTING EMAIL

        if (count($get_email) > 0 && $get_email[0][$usr_C->getIsAuth()]) {
            $insertMode = false;
            $valid = false;
            $scripts->removeAttrName("existing-email", "hidden");
        }

        // HANDLE EXISTING EMAIL BUT NOT VERIFIED

        if (count($get_email) > 0) {
            $crud->updateRecord($usr_C->getTableName(), $usr_C->getEmail(), $emailVal, $data);
            $insertMode = False;
        }

        // HANDLE EXISTING USERNAME

        if (count($get_usernames) > 0 && $get_usernames[0]['username'] != $usernameVal) {
            $scripts->removeAttrName('existing-name', 'hidden');
            $insertMode = False;
            $valid = False;
        }   

        // INSERT IF THERE IS NOT EXISTING EMAIL / USERNMAE

        if ($insertMode) {
            if ($crud->insertRecord($usr_C->getTableName(), $data)){
                // do something after insertion
            }  
        }

        // HANDLE VERIFICATION CODE / SESSION TOKEN

        if ($valid) {
            if (!$mailer->sendMail($emailVal, "no-reply", $subject_text)) {
                $scripts->removeAttrName('unable-send', 'hidden');
            };

            $routes->init_session($get_email[0][$usr_C->getUserId()],$usr_C->getRegisterToken(), $token); // init register session
            header("Location: ./verify.php");
            exit;
        }
    }

    ob_end_flush();
?>