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
    <div class="header">
        <h1 class="textHeader1">Create Project</h1>
    </div>
    <div class="content">
        <form action="addProjectForm.php" method="post">
            <span style="color: red">*</span>Project Name: <input type="text" name="projectName">
            <br>
            Project Deadline: Month <input type="number" maxlength="2"  name="month">, Day <input type="number" maxlength="2"  name="day">, Year <input type="number" maxlength="4"  name="year">
            <br>
            <input type="submit">
        </form>
    </div>
    <div class="footer">

    </div>
</div>
</body>

    <?php
} else {
    header("Location: login.php");
}
?>