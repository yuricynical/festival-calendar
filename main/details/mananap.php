<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <link rel="stylesheet" href="../../styles/comments.css">
    <title>Mananap Festival</title>
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

    <img src="../../assets/images/Mananap.jpg" class="blog-image" alt="">
    <div class="content">
        <h1 class="title">Mananap Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
            The Mananap Festival is a vibrant annual event celebrated in San Vicente, Camarines Norte, showcasing the region's rich cultural heritage and natural wonders. 
            The festival is named after "Mananap," which translates to "animals" in the local dialect, emphasizing the town's biodiversity and its role in sustaining the 
            livelihoods of its people. This event typically includes activities such as street dancing competitions, cycling events, and various cultural presentations that 
            highlight local traditions and the community's strong connection to nature​.
            <br>
            The origins of the festival are tied to the municipality’s appreciation for its natural resources and the preservation of its environment. Over the years, the 
            Mananap Festival has grown into a platform to promote tourism and environmental awareness in San Vicente. It also serves as a venue for showcasing local talent 
            and fostering unity among its residents. The celebration aligns with the town's history, which dates back to its establishment as a municipality in 1877, and its 
            predominantly agricultural economy​.
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
            let timer_ = 1745884800
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
