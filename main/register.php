<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/db/encryption.php";
    require_once "../utils/db/mailer.php";

    $usr_C = new UserConstants();
    $encrypt = new Encryption();
    $mailer = new Mailer();
    $crud = new Crud();
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
        $auth = $encrypt->generateAuthCode();

        $data = [
            $usr_C->getUsername() => $crud->sanitize("username"),
            $usr_C->getEmail() => $emailVal,
            $usr_C->getPassword()=> $encrypt->encryptPassword($crud->sanitize("password")),
            $usr_C->getAuthCode()=>$auth
        ];
        
        $subject_text = "Your verification code for festival calendar: <b>" . $auth . "</b>";

        // check if the email is existing
        

        if ($crud->insertRecord($usr_C->getTableName(), $data)){
            if($mailer->sendMail($emailVal, "no-reply", $subject_text)) {
               // do something succssfully registered
            }
        };
    }
?>