<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <link rel="stylesheet" href="../../styles/comments.css">
    <title>Busig-on Festival</title>
</head>
<body>
<nav class="navbar">
        <img height="50" src="../../assets/images/CNlogo.png" class="logo" alt="">
        <ul class="links-container">
            <li class="link-item"><a href="/" class="link">home</a></li>
            <li class="link-item"><a href="/" class="link">Festival</a></li>
            <li class="link-item"><a href="/" class="link">Post</a></li>
        </ul>
    </nav>

    <img src="../../assets/images/Busig-on.jpg" class="blog-image" alt="">
    <div class="content">
        
        <h1 class="title">Busig-on Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
                The Busig-On Festival is an annual celebration held every September 7-8 in Labo, Camarines Norte. It is rooted in the epic tale of Busig-On, a legendary hero from Bicol who embodies the values of 
            courage, heroism, and resilience. This festival aims to preserve and promote the rich cultural heritage of the region while highlighting the unique identity of Labo.
            <br>
            The festival features a variety of activities, including competitions in talent and skills, which showcase the creativity and cultural pride of the community.
            These events are designed to reflect the town's historical sentiments and values. It also serves as a platform for locals to promote their town's natural attractions and cultural significance.
            <br>
            Historically, the Busig-On Festival celebrates the moral lessons and historical importance of the epic that inspired it.
            The story of Busig-On symbolizes the perseverance and bravery of the people of Labo, making it a meaningful event for the community. Through colorful parades, dance performances, and exhibitions, the 
            festival keeps this local legend alive and fosters a sense of unity among the residents.
        </div>
    </div>

    <br>
    <div class="comment-form-container">
        <h2>Leave a Comment</h2>
        <form action="" method="post">
            <label for="comment">Comment:</label>
            <textarea name="Comment" id="comment" required></textarea>
            <input type="submit" name="Submit" value="Submit">
        </form>
    </div>
    <br>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let timer_ = 1757289600
            let flipdown = new FlipDown(timer_)
                .start()
                .ifEnded(() => {
                    document.querySelector(".flipdown").innerHTML = `<h2>Timer is ended</h2>`;
                })
        })
    </script>
</body>
</html>
<?php

    if(isset($_POST["Submit"])){
    $Comment = $_POST["Comment"];

    $Old = fopen("comments.txt", "r+t");
    $Old_Comments = fread($Old, 1024);

    $Write = fopen("comments.txt", "w+");

    $string =
        "<div class='comment'><span>".$Comment."</span><br>
        <span>".date("Y/m/d")."|".date("h:i A")."\n".$Old_Comments;
    
    fwrite($Write, $string);
    fclose($Write);
    fclose($Old);
    }
    $Read = fopen("comments.txt", "r+t");
    echo "<h1>Comments:</h1><hr>".fread($Read, 1024);
    fclose($Read);
?>