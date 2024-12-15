<?php 
    ob_start();
    session_start();

    require_once "../constants/users.php";
    require_once "../utils/db/crud.php";

    $usr_C = new UserConstants();
    $crud = new Crud();
    $getUser = Null;
    $valid_session = False;
    $username = "Guest";

    if (isset($_SESSION[$usr_C->getSessionToken()])) {
        try {
            $getUser = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getSessionToken(), $_SESSION[$usr_C->getSessionToken()]);
            $valid_session = count($getUser) > 0;
            $username = $getUser[0][$usr_C->getUsername()];
        } catch (Exception $ex) { 
            $valid_session = False;
        }
    }
?>

<nav class="navbar">
    <img height="50" src="../assets/images/CNlogo.png" class="logo" alt="">
    <ul class="links-container">
        <li class="link-item"><a href="./home.php" class="link">home</a></li>
        <li class="link-item"><a href="#blogs" class="link">Festival</a></li>
        <li class="link-item"><a href="./newsfeed.php" class="link">Post</a></li>
    </ul>

    <form method="post" class="navbar-logged">
        <p><?php echo $username ?></p>
        <a href="../main/log-in.php">
            <button class="btn-login" name="btn-log"> 
                <?php if (!$valid_session): ?>
                    Log in
                <?php else: ?>
                    Logout
                <?php endif; ?>
            </button>
        </a>   
    </form>
</nav>

<?php
    if (isset($_POST['btn-log'])) {
        if (!$valid_session) {
            header("Location: ./log-in.php");    
        }else {
            // logout
            session_unset();
            session_destroy();
            header("Refresh: 0");
            exit();
        }
    }

    ob_end_flush();
?>

<style>
    .navbar {
        width: 100%;
        height: 60px;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 5vw;
        background: #fff;
        z-index: 9;
        color:black;
    }
    .links-container {
        display: flex;
        list-style: none;
    }

    .link {
        padding: 10px;
        margin-left: 10px;
        text-decoration: none;
        text-transform: capitalize;
        color: #000;
    }

    .btn-login {
        margin-left: 1rem;
        padding: 0.4rem 1rem;
        background-color: black;
        color: white;
        border-radius: 4px;
        border: 1px solid black;
    }

    .btn-login:hover {
        background-color: white;
        color: black;
        cursor: pointer;
    }

    .navbar-logged {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .navbar-logged i{
        margin-right: 1rem;
    }   
</style>
