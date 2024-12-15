<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <link rel="stylesheet" href="../../styles/comments.css">
    <title>Rahugan Festival</title>
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

    <img src="../../assets/images/Rahugan.jpg" class="blog-image" alt="">
    <div class="content">
        <h1 class="title">Rahugan Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
                The Rahugan Festival is an annual cultural and religious celebration in Basud, Camarines Norte, typically held from October 18 to 24. It coincides with the feast of St. Raphael the Archangel, 
            the town's patron saint. The festival’s name comes from the term rahug, which refers to a cluster of coconuts, symbolizing strength through unity—an essential value among the Basudeños. The 
            event honors the town's agricultural heritage, particularly its rich coconut production, while promoting community solidarity and cultural pride.
            <br>
                The festival began in 2008 and has since grown into a week-long celebration featuring vibrant street dances, cultural performances, agro-tourism fairs, and local competitions like the Laro ng Lahi.
            Key highlights include the Grand Rahugan Parade, beauty pageants such as Mutya ng Rahugan, and unique events like "Gabi ng mga Lolo at Lola," which celebrates elders. The festival also features 
            religious activities, including a fluvial procession along the Basud River​.
            <br>
            Rooted in Basud’s history and identity, the Rahugan Festival showcases the town's close-knit community and agricultural significance. It serves as a reminder of the Basudeños’ spirit of cooperation 
            and resilience, drawing visitors from across the region to experience the lively celebrations and partake in local traditions​.
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
            let timer_ = 1761264000
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
