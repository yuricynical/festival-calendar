<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <link rel="stylesheet" href="../../styles/comments.css">
    <title>Pinyasan Festival</title>
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

    <img src="../../assets/images/Pinyasan.jpg" class="blog-image" alt="">
    <div class="content">
        <h1 class="title">Pinyasan Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
            The Pinyasan Festival in Daet, Camarines Norte, is a vibrant annual celebration held every June 15-24 to showcase the town’s pride in its unique and sweet Formosa pineapples, 
            often called the “Queen Pineapple of the Philippines.” The festival coincides with the feast day of Saint John the Baptist, the town’s patron saint, blending cultural, religious, 
            and agricultural elements. It features lively events such as street dancing, a float parade, a beauty pageant, pineapple-themed contests, and a unique tradition of giving away free 
            pineapples and pineapple-based treats like ice cream​.
            <br>
            This festival originated in 1993 through the efforts of then-town councilor Tito S. Sarion, who sought to celebrate the Formosa pineapple's importance to local livelihoods. The name 
            "Pinyasan," introduced in 2003, adds a distinct local touch. The celebration also honors the indigenous Kabihug tribe, who are among the pineapple farmers. The region's unique soil 
            composition and farming techniques contribute to the fruit's exceptional sweetness​.
            <br>
            Over the years, the Pinyasan Festival has grown from a simple town event into a provincial attraction, significantly boosting tourism. Highlights include a Guinness World Record attempt 
            for the longest pineapple chain and other community-centered activities like art exhibits, fun runs, and beach events at Bagasbas Beach. The festival not only celebrates the pineapple industry
             but also showcases the culture, creativity, and hospitality of Daet​.
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
            let timer_ = 1750723200
            let flipdown = new FlipDown(timer_)
                .start()
                .ifEnded(() => {
                    document.querySelector(".flipdown").innerHTML = `<h2>Timer is ended</h2>`;
                })
        })
    </script>
</body>
</html>


<!---Tanggalin na lang if walang kwenta--->
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
