<nav class="navbar">
    <img height="50" src="../assets/images/CNlogo.png" class="logo" alt="">
    <ul class="links-container">
        <li class="link-item"><a href="./home.php" class="link">home</a></li>
        <li class="link-item"><a href="#blogs" class="link">Festival</a></li>
        <li class="link-item"><a href="./newsfeed.php" class="link">Post</a></li>
    </ul>
    <div class="navbar-logged">
        <p>Guest</p>
        <a href="../main/log-in.php">
            <button class="btn-login">  
                Log in 
            </button>
        </a>   
    </div>
</nav>

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
</style>