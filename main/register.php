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
                <form action="">

                    <h1>Register</h1>

                    <div class="input-box">
                        <input type="text" placeholder="Username" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    
                    <div class="input-box">
                        <input type="text" placeholder="Email" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="remember-forgot">
                        <label>
                            <input type="checkbox">Remember me</label>
                            <a href="#">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn">Login</button>

                    <div class="register-link"> 
                        <p>Already have an account?<a href="./log-in.php">Log-in</a></p>
                    </div>
                    
                </form>
            </div>
        </div>  
    </body>
</html>

<?php
    include "../utils/db/crud.php"
    

?>