<?php
    ob_start();

    require_once "../utils/db/crud.php";
    require_once "../constants/users.php";
    require_once "../utils/db/encryption.php";
    require_once "../utils/forms/scripts.php";
    require_once "../utils/db/routes.php";

    $crud = new Crud();
    $usr_C = new UserConstants();
    $scripts = new Scripts();
    $encrypt = new Encryption();
    $routes = new Routes();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../styles/login.css">
        <title>Log-in</title>
    </head>
    <body>
        <?php require "../components/navbar.php"?>

        <div class="bg-wrapper">
            <div class="login-wrapper">

               <form action="<?php echo $crud->getCurrentPage() ?>" method="post" onsubmit="rememberMe()">

                    <h1>Login</h1>

                    <div name="wrong-input" align="center" hidden>
                        <p>Wrong email or Password</p>
                    </div> 

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
    <script>
        const rmCheck = document.getElementById("rem-checkbox");
        const pwd = document.getElementById("password-box");
        const email = document.getElementById("email-box");

        // Populate fields on page load
        if (localStorage.checkbox && localStorage.checkbox === "true") {
            rmCheck.setAttribute("checked", "checked");
            pwd.value = localStorage.password || ""; // Ensure no `undefined` values
            email.value = localStorage.email || "";
        } else {
            rmCheck.removeAttribute("checked");
            pwd.value = "";
            email.value = "";
        }

        // Add data to local storage
        function rememberMe() {
            if (rmCheck.checked && email.value !== "" && pwd.value !== "") {
                localStorage.email = email.value;
                localStorage.password = pwd.value;
                localStorage.checkbox = "true";
            } else {
                localStorage.removeItem("email");
                localStorage.removeItem("password");
                localStorage.removeItem("checkbox");
            }
        }
    </script> 
</html>

<?php

    if ($crud->checkMethod()) {
        $email_val  = $crud->sanitize("email-input");
        $password_val = $crud->sanitize("password-input");

        $get_user = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getEmail(), $email_val);
        $decrypted_pass = $get_user[0][$usr_C->getPassword()];
        $result = strcmp(strval($decrypted_pass), $encrypt->encryptPassword($password_val));
        $newToken = $encrypt->generateToken();
 
        if (count($get_user) > 0 && $result == 0 && $get_user[0][$usr_C->getIsAuth()]) {
            $year = 31536000;
            $routes->init_session($get_user[0][$usr_C->getUserId()], $usr_C->getSessionToken(), $newToken);
            header("Location: ./newsfeed.php");
            exit;
        } else{
            $scripts->removeAttrName("wrong-input", "hidden");
        }

    };

    ob_end_flush();
?>