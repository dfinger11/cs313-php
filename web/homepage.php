<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
          content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Derek's Homepage</title>
    <link rel='stylesheet' href='homepageStyles.css'/>
    <script src="homepageScript.js"></script>
</head>
<body>
<div class='page'>
    <div class='section menu'>
        <div class="container" onclick="hamburgerFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div id="accContainer">
            <button onclick="location.href = 'homepage.html';" id="homeButton" class="accordion">Home</button>
            <button class="accordion">About Me</button>
            <button class="accordion">Assignments</button>
        </div>
    </div>
    <div class='section header'>
        <h1>DEREK'S HOMEPAGE</h1>
    </div>
    <div class='section content'>
        <h2>
            <?php
            $timestamp = time();
            $date_time = date("d-m-Y (D) H:i:s", $timestamp);
            echo "Current date and local time on this server is $date_time";
            ?>
        </h2>
        <div class="slideshow-container">
            <div class="indexSlides slideOne fade">
                <div class="numbertext">1 / 3</div>
                <img src="images/thanksgiving.jpeg" style="width:100%">
                <div class="text">Picture of my wife and I at her grandparentt's house for thanksgiving.</div>
            </div>
            <div class="indexSlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="images/halloween.jpeg" style="width:100%">
                <div class="text">This last halloween my wife and I dressed up as Clark Kent and Louis Lane.</div>
            </div>

            <div class="indexSlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="images/weddingbouquet.JPG" style="width:100%">
                <div class="text">At my wedding reception holding my wife's bouquet.</div>
            </div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>
        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>
</div>
<div class="page">
    <div class="footer">
        <p class="footerClass">Derek Finger 2019</p>
    </div>
</div>
</body>
</html>