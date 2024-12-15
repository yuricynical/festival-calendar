<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/comments.css">
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <title>Kadagatan Festival</title>
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

    <img src="../../assets/images/Kadagatan.jpg" class="blog-image" alt="">
    <div class="content">
        
        <h1 class="title">KadagatanFestival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
            The Kadagatan Festival, celebrated annually in Mercedes, Camarines Norte, is a vibrant tribute to the town's rich marine resources and its residents' 
            gratitude for the blessings of the sea. Held every August, the festival's name, derived from the Filipino word "dagat" (meaning sea), reflects its deep 
            connection to the maritime lifestyle of the local community. It is both a thanksgiving and a prayer for continued abundance, highlighting the importance 
            of marine conservation and sustainable practices​.
            <br>
            The festival originated as a way for Mercedes' residents, whose livelihoods are heavily tied to fishing, to honor the sea's bounty.
            Through activities like boat races, fishing competitions, and sea-themed street dances, the event showcases their dependence on and respect for marine resources. 
            A grand parade, featuring floats adorned with large fish sculptures and oceanic motifs, serves as the centerpiece, celebrating the sea's beauty and its significance to the town​.
            <br>
            In addition to the festivities, the Kadagatan Festival promotes awareness about environmental stewardship. Educational programs and initiatives during the event emphasize the responsible 
            use of marine resources, ensuring that the area's natural wealth is preserved for future generations.This blending of cultural celebration and ecological consciousness makes the Kadagatan 
            Festival a unique and meaningful event in the Philippines​.
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
            let timer_ = 1754870400
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
