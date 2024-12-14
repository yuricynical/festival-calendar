<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/details.css">
    <script src="../../scripts/flipdown.js"></script>
    <link rel="stylesheet" href="../../styles/flipdown.css">
    <title>Palong Festival</title>
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

    <img src="../../assets/images/Palong.jpg" class="blog-image" alt="">
    <div class="content">
        <h1 class="title">Palong Festival</h1>
        <div class="timer">
            <div id="flipdown" class="flipdown"></div>
        </div>
        <hr>
        <div class="text">
            The Palong Festival is a vibrant annual celebration held in Capalonga, Camarines Norte, from May 10 to 13. The festival honors the town's agricultural heritage, 
            symbolized by the rooster's comb (locally called "palong manok"), which represents abundance and resilience. The event features colorful street dancing, agro-industrial 
            fairs, and cultural presentations. It also coincides with the feast of the Black Nazarene on May 13, attracting devotees and tourists alike.
            <br>
            The festival's roots trace back to the town's name, derived from "Apalong," the Agta and Dumagat tribes' term for a local plant resembling a rooster's comb.
            This indigenous connection highlights the town's rich cultural and natural history. The arrival of Spanish colonizers influenced the adoption of the name "Capalonga," 
            now associated with the area's traditions and festivities.
            <br>
            Through lively performances and communal activities, the Palong Festival showcases Capalonga's gratitude for its blessings, blending cultural pride with religious devotion.
            It has become a unifying event for the local community and a platform for promoting regional products and traditions.
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let timer_ = 1747094400
            let flipdown = new FlipDown(timer_)
                .start()
                .ifEnded(() => {
                    document.querySelector(".flipdown").innerHTML = `<h2>Timer is ended</h2>`;
                })
        })
    </script>
</body>
</html>
