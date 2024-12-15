<?php
    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/db/encryption.php";

    $crud = new Crud();
    $usr_C = new UserConstants();
    $encrypt = new Encryption();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Log-in</title>
    </head>
    <body>
        <?php include "../components/navbar.php"?>

        <div class="bg-wrapper">
            <div class="login-wrapper">

                <form action="<?php $crud->getCurrentPage() ?>" method="post">

                    <h1>Login</h1>

                    <div class="input-box">
                        <input type="email" placeholder="Email" id="email-box" name="email-input" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Password" id="password-box" name="password-input" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" id="rem-checkbox">Remember me
                        </label>
                            <a href="./forgot.php">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn">Login</button>

                    <div class="register-link"> 
                        <p>Don't have an account?<a href="./register.php">Register</a></p>
                    </div>
                    
                </form>
            </div>
        </div>  
    </body>
    <script type="text/javascript">

        // remember me function
        
        const rmCheck = document.getElementById("rem-checkbox");
        const pwd = document.getElementById("password-box");
        const email = document.getElementById("email-box");

        // read

        if (localStorage.checkbox && localStorage.checkbox !== ""){
            rmCheck.setAttribute("checked","checked");
            pwd.Value = localStorage.password;
            email.Value = localStorage.email;
        } else {
            rmCheck.removeAttribute("checked");
            pwd.Value = "";
            email.Value = "";
        }

        // add data to local storage

        function rememberMe() {
            if (rmCheck.checked && email.value !== "" && pwd.value !== "") {
                localStorage.email = email.value;
                localStorage.password = pwd.value;
                localStorage.checkbox = rmCheck.Value;
            }else {
                localStorage.email = "";
                localStorage.password = "";
                localStorage.checkbox = "";
            }
        }
    </script>   
</html>

<?php

    if ($crud->checkMethod()) {
        $password_val = $crud->sanitize("email-input");
        $email_val = $crud->sanitize("password-input");

        $get_user = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getEmail(), $email_val);

        // login (sa wakas)
        if (count($get_user) > 0 && $encrypt->decryptPassword($get_user[0][$usr_C->getPassword()]) === $password_val) {

        }


    };

?>