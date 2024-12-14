<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <title>Pabirik Festival</title>
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

    <img src="../../assets/images/Pabirik.jpg" class="blog-image" alt="">
    <div class="content">
        <h1 class="title">Pabirik Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
            The Pabirik Festival is a vibrant celebration held in Paracale, Camarines Norte, to honor its rich history as a center of gold mining in the Philippines. 
            The name "Pabirik" refers to the gold-panning tool traditionally used by miners in the region. This week-long event is filled with activities that pay tribute 
            to the town’s mining heritage, cultural traditions, and community spirit. It also coincides with the Feast of Our Lady of Candelaria, Paracale's patron saint, 
            making the festival a blend of cultural and religious significance.
            <br>
            The festival showcases Paracale’s mining legacy, which dates back centuries, as the town became known as a "gold town" due to its rich deposits of gold. 
            Events like street dancing, parades, and pageants are highlights, with participants wearing costumes inspired by miners, fishermen, and local traditions. 
            These activities not only celebrate the town's history but also boost local tourism and provide an opportunity for small businesses to thrive during the event.
            <br>
            Visitors can enjoy food stalls, bazaars, and cultural presentations, offering a glimpse into the vibrant lifestyle of the town. 
            The Pabirik Festival serves as a reminder of the resilience and ingenuity of Paracale's people, highlighting their ability to preserve their traditions while 
            embracing modern celebrations.
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let timer_ = 1738454400
            let flipdown = new FlipDown(timer_)
                .start()
                .ifEnded(() => {
                    document.querySelector(".flipdown").innerHTML = `<h2>Timer is ended</h2>`;
                })
        })
    </script>
</body>
</html>
