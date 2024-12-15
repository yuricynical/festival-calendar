<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <link rel="stylesheet" href="../../styles/comments.css">
    <title>Mambulawan Festival</title>
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

    <img src="../../assets/images/Mambulawan.jpg" class="blog-image" alt="">
    <div class="content">
        <h1 class="title">Mambulawan Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
            The Mambulawan Festival is a vibrant cultural and religious event celebrated annually in Jose Panganiban, Camarines Norte. Held from September 24 to October 7, 
            it coincides with the Feast of Our Lady of the Most Holy Rosary, the town’s patroness. The festival promotes unity, highlights the town’s rich history, and showcases 
            its mining heritage, culture, and arts.
            <br>
            The name "Mambulawan" originates from "Mambulao," the old name of Jose Panganiban, which means "bountiful in gold." This reflects the area's historical significance as 
            a mining town even before the Spanish colonial period.The festival underscores the town's mining legacy through various activities, including street dancing, art showcases, 
            and community celebrations​.
            <br>
            Aside from cultural festivities, the event aims to drive economic growth by fostering tourism and engaging the local community. Highlights include processions, sports events, 
            and showcases of local talent. The festival also serves as a homecoming for residents and balikbayans, enhancing communal pride and tradition​.
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
            let timer_ = 1759795200
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
