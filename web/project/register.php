<?php
include "../../database/dbConnect.php";
session_start();
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
        <h3>Register</h3>
        <form action="formRegister.php" method="post">
            New Username: <input type="text" name="username">
            <br>
            New Password: <input type="password" name="password">
            <br>
            First Name: <input type="text" name="fname">
            <br>
            Last Name: <input type="text" name="lname">
            <br>
            <input type="submit">
        </form>
    </div>
    <div class="footer">

    </div>
</div>
</body>
