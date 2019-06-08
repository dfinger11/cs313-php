<?php
session_start();
require "../../database/dbConnect.php";
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$db = get_db();
$statement = $db->prepare("SELECT * FROM famusers WHERE username='$username' AND password_hash = '$password';");
$statement->execute();

$rowCount = $statement->rowCount();
if (!empty($rowCount) && $rowCount == 1) {
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $username;
} else {
    $_SESSION['authenticated'] = false;
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Family Game Plan Login</title>
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
        </div>
    </div>
    <div class="section header">
        <h1 class="textHeader1">The Family Project Planner</h1>
    </div>
    <div class="section content">
        <h2 class="centerText loginCenter">Designed to help you manage your family projects</h2>
        <div class="centerContent">
            <br>
            <h3>Login</h3>
            <form action="loginform.php" method="post">
                Username:
                <br>
                <input type="text" name="username">
                <br>
                Password:
                <br>
                <input type="password" name="password">
                <br>
                <br>
                <input class="button" type="submit" value="Login">
            </form>
            <br>
        </div>
        <?php
        if($_SESSION['authenticated'] == true) {
            header("Location: familyHome.php");
        } else {
            ?><span class="centerText" style="color: red"><?php echo "Username or password is incorrect!"?></span><br><?php
        }
        ?>
        <h3 class="centerText">Don't have an account <a onclick="location.href = 'register.php';" style="color: blue">click here</a>!</h3>
        <br>
    </div>
    <div class="section footer">
        <p class="footerClass">Derek Finger 2019</p>
    </div>
</div>
</body>

