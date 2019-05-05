<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
          content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Assignment List</title>
    <link rel='stylesheet' href='assignmentStyles.css'/>
    <script src="assignmentScripts.js"></script>
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
            <button onclick="location.href = 'homepage.php';" id="homeButton" class="accordion">Home</button>
            <button class="accordion">About Me</button>
            <button onclick="location.href = 'assignmentList.php';" class="accordion">Assignments</button>
        </div>
    </div>
    <div class='section header'>
        <h1>AssignmentList</h1>
    </div>
    <div class='section content'>
        <h2>
            <?php
            echo "Server Time: " . date("h:i:sa")
            ?>
        </h2>
        <h2>
            <?php
            echo "Server Date: " . date("d/m/Y");
            ?>
        </h2>
        <br>
    </div>
</div>
<div class="page">
    <div class="footer">
        <p class="footerClass">Derek Finger 2019</p>
    </div>
</div>
</body>
</html>