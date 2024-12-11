<?php
    require_once "../utils/db/crud.php";
    $crud = new Crud();
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

                    <h1>Login</h1>

                    <div class="input-box">
                        <input type="email" placeholder="Email" id="email-box" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Password" id="password-box" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox" id="rem-checkbox">Remember me</label>
                            <a href="#">Forgot Password?</a>
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

        if (localStorage.checkbox && localSTorage.checkbox !== ""){
            rmCheck.setAttribute("checked","checked");
            passInput.value = localStorage.password;
            emailInput.value = localStorage.email;
        } else {
            
        }

    </script>   
</html>




<?php
 
    
   
?>