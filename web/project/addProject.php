<?php
session_start();
require "../../database/dbConnect.php";

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    $username = $_SESSION['username'];
    $db = get_db();
    ?>
    <!DOCTYPE html>
    <html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Project Maker</title>
    <meta name='viewport'
          content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <link rel='stylesheet' href='project1css.css'/>
    <script src="project1js.js"></script>
</head>
<body>
<div class="page">
    <div class='section menu'>
        <div class="container" onclick="hamburgerFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div id="accContainer">
            <button onclick="location.href = '../homepage.php';" id="homeButton" class="accordion">Home</button>
            <button onclick="location.href = '../assignmentList.php';" class="accordion">Assignments</button>
            <button onclick="location.href = 'familyHome.php';" class="accordion">Family Room</button>
            <button onclick="location.href = '?logOut';" class="accordion">Logout</button>
        </div>
    </div>
    <div class="section header">
        <h1>Create Project</h1>
    </div>
    <div class="section content">
        <div class="centerContent">
            <form action="addProjectForm.php" method="post">
                <span style="color: red">*</span>Project Name: <input type="text" name="projectName">
                <br>
                Project Deadline: Month <input type="number" maxlength="2"  name="month">, Day <input type="number" maxlength="2"  name="day">, Year <input type="number" maxlength="4"  name="year">
                <br>
                <input class="button" type="submit">
            </form>
        </div>
    </div>
    <div class="section footer">
        <p class="footerClass">Derek Finger 2019</p>
    </div>
</div>
</body>

    <?php
} else {
    header("Location: login.php");
}
?>