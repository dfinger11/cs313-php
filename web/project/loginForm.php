<?php
session_start();
require "../../database/dbConnect.php";
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$db = get_db();
$statement = $db->prepare("SELECT * FROM famusers WHERE username='$username' AND password_hash = '$password'");
$userFound = $statement->execute();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
    <title>Family Game Plan Login</title>
    <link rel='stylesheet' href=''/>
    <script src=""></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">The Family Game Plan</h1>
        <h2 class="textHeader3">Designed to help you manage your family projects</h2>
    </div>
    <div class="content">
        <h3>Login</h3>
        <form action="loginForm.php" method="post">
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            <input type="submit" value="Login">
        </form>
        <?php

        if($userFound) {
            $_SESSION['authenticated'] = true;
            header("Location:familyHome.php");
        } else {
        $_SESSION['authenticated'] = false;
        header("Location:login.php");
        ?><span><?php echo "Login failed!"?><span><?php
                }
                ?>
        <h3>Don't have an account <a  onclick="location.href = 'register.php';" style="color: blue">click here</a>!</h3>
    </div>
    <div class="footer">

    </div>
</div>
</body>

