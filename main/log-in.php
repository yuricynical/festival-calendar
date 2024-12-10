<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login.css">
    <title>Log-in</title>
</head>
<body>
    <div class="wrapper">
        <form action="">

            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Email" required>
                <i class="fa-solid fa-user"></i>
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
                <p>Don't have an account?<a href="#">Register</a></p>
            </div>

        </form>
    </div>
</body>
</html>