<?php 
    require_once "../utils/db/routes.php";
    require_once "../constants/users.php";
    require_once "../utils/db/crud.php";

    $routes = new routes();
    $usr_C = new UserConstants();
    $crud = new Crud();

    $getUser = Null;
    $valid_session = $routes->check_session($usr_C->getSessionToken());
 
    if($valid_session) {
        $getUser = $crud->getRowByValue($usr_C->getTableName(), $usr_C->getSessionToken(), $_SESSION[$usr_C->getSessionToken()]);
        if (count($getUser) < 0) {
            $valid_session = false;
        }
    };
?>

<nav class="navbar">

    <img height="50" src="../assets/images/CNlogo.png" class="logo" alt="">

    <ul class="links-container">
        <li class="link-item"><a href="./home.php" class="link">home</a></li>
        <li class="link-item"><a href="#blogs" class="link">Festival</a></li>
        <li class="link-item"><a href="./newsfeed.php" class="link">Post</a></li>
    </ul>

    <form action="<?php $crud->getCurrentPage() ?>" method="post" class="navbar-logged">
        <?php if ($valid_session): ?>
            <p><?php echo $getUser[0][$usr_C->getUsername()] ?></p>
        <?php else: ?>
            <i class="fa-solid fa-user"></i>
            <p>Guest</p>
        <?php endif; ?>

        <a href="../main/log-in.php">
            <button type="submit" class="btn-login" name="btn-log"> 
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
    if ($crud->checkMethod()) {
        if (!$valid_session) {
            // login
            header("Location: ./log-in.php");
            
        }else {
            // logout
            session_unset();
            session_destroy();
        }
    }
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