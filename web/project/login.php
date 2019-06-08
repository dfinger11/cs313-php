<?php
session_start();
if(isset($_SESSION['authenticated'])) {
    if($_SESSION['authenticated'] == true) {
        header("Location: familyHome.php");
    }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
          content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Family Game Plan Login</title>
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
        </div>
    </div>
    <div class="section header">
        <h1 class="textHeader1">The Family Game Plan</h1>
    </div>
    <div class="section content">
        <h2 class="textHeader3 loginCenter">Designed to help you manage your family projects</h2>
        <div class="loginSubContent">
            <form action="formLogin.php" method="post">
                Username:
                <br>
                <input type="text" name="username">
                <br>
                Password:
                <br>
                <input type="password" name="password">
                <br>
                <input type="submit" value="Login">
            </form>
        </div>
        <h3 class="loginCenter">Don't have an account <a onclick="location.href = 'register.php';" style="color: blue">click here</a>!</h3>
    </div>
    <div class="section footer">
        <p class="footerClass">Derek Finger 2019</p>
    </div>
</div>
</body>
