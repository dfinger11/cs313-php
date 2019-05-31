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
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            Re-enter password: <input type="password" name="repassword">
            <br>
            First Name: <input type="text" name="fname">
            <br>
            Last Name: <input type="text" name="lname">
            <br>
            Family title:
            <select name="famTitle">
                <option value="none" >Select Title</option>
                <option value="Father" >Father</option>
                <option value="Mother" >Mother</option>
                <option value="Child" >Child</option>
            </select>
            <br>
            Family Group: <input type="text" name="family">
            <br>
            <input type="submit">
        </form>
    </div>
    <div class="footer">

    </div>
</div>
</body>
