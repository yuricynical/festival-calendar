<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/db/encryption.php";
    require_once "../utils/db/mailer.php";
    require_once "../utils/forms/scripts.php";

    $usr_C = new UserConstants();
    $encrypt = new Encryption();
    $mailer = new Mailer();
    $crud = new Crud();
    $scripts = new Scripts();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Register</title>
    </head>
    <body>
        <div class="bg-wrapper">
            <div class="login-wrapper">
                <form action="<?php $crud->getCurrentPage() ?>" method="post">

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

                    <div class="input-box">
                        <input type="password" placeholder="Password" name="password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <input type="submit" class="btn" value="Register">

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

        $emailVal = $crud->sanitize("email");
        $usernameVal = $crud->sanitize("username");
        $auth = $encrypt->generateAuthCode();
        $token = $encrypt->generateToken();

        $data = [
            $usr_C->getUsername() => $usernameVal,
            $usr_C->getEmail() => $emailVal,
            $usr_C->getPassword() => $encrypt->encryptPassword($crud->sanitize("password")),
            $usr_C->getAuthCode() => $auth,
            $usr_C->getSessionToken() => $token
        ];
        
        $subject_text = "Your verification code for festival calendar: <b>" . $auth . "</b>";

        $get_emails = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getEmail(), $emailVal);
        $get_usernames = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getUsername(), $usernameVal);
        
        $insertMode = True;

        // HANDLE EXISITING EMAIL -> GO TO VERIFY PAGE INSTEAD

        if (count($get_emails) > 0) {

            $updateData = [
                $usr_C->getUsername() => $usernameVal,
                $usr_C->getAuthCode() => $auth,
                $usr_C->getSessionToken() => $token
            ];

            $crud->updateRecord($usr_C->getTableName(), $usr_C->getEmail(), $emailVal, $updateData);
            $insertMode = False;
        }

        // HANDLE EXISTING USERNAME

        if (count($get_usernames) > 0) {
            $scripts->removeAttrName('existing-name', 'hidden');
            $insertMode = False;
        }

        // INSERT IF THERE IS NOT EXISTING EMAIL / USERNMAE

        if ($insertMode) {
            if($mailer->sendMail($emailVal, "no-reply", $subject_text)) {
                if ($crud->insertRecord($usr_C->getTableName(), $data)){
                    // do something after insertion
                };
            }  
        }

        setcookie("user_token", $token, time() + (86400 * 2), "/");
        header("Location: ./verify.php/" . $token);
    }
?>