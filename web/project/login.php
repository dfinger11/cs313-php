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
    <title>Family Game Plan Login</title>
    <link rel='stylesheet' href='project1css.css'/>
    <script src="project1js.js"></script>
</head>
<body>
<div class="page">
    <div class="header">
        <div class='section menu'>
            <div class="container" onclick="hamburgerFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div id="accContainer">
                <button onclick="location.href = 'homepage.php';" id="homeButton" class="accordion">Home</button>
                <button onclick="location.href = 'assignmentList.php';" class="accordion">Assignments</button>
            </div>
        </div>
        <h1 class="textHeader1">The Family Game Plan</h1>
        <h2 class="textHeader3">Designed to help you manage your family projects</h2>
    </div>
    <div class="content">
        <h3>Login</h3>
        <form action="formLogin.php" method="post">
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            <input type="submit" value="Login">
        </form>
        <h3>Don't have an account <a onclick="location.href = 'register.php';" style="color: blue">click here</a>!</h3>
    </div>
    <div class="footer">

    </div>
</div>
</body>
