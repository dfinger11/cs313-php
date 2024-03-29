<?php
session_start();
require "../../database/dbConnect.php";
require "logout.php";

$project = strip_tags($_POST['projectName']);
$month = strip_tags($_POST['month']);
$day = strip_tags($_POST['day']);
$year = strip_tags($_POST['year']);
$date = $year . '-' . $month . '-' . $day;
if($date == "--" || $day == "" || $month == "" || $year == "") {
    $deadline = null;
} else {
    $deadline = $date;
}
$username = $_SESSION['username'];

if("" != trim($_POST['projectName'])) {
    $db = get_db();
    if(empty($deadline) || $deadline == null || $deadline == "") {
        $insertStatement = $db->prepare("INSERT INTO project (project_name, date_created, created_by, family_fk) 
                                                    VALUES (
                                                            '$project', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT family_fk FROM famusers WHERE username='$username')
                                                            );");
    } else {
        $insertStatement = $db->prepare("INSERT INTO project (project_name, deadline, date_created, created_by, family_fk) 
                                                    VALUES (
                                                            '$project', 
                                                            '$deadline', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT family_fk FROM famusers WHERE username='$username')
                                                            );");
    }
    $insertStatement->execute();
    header("Location: familyHome.php");
}

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
        <br>
    </div>
    <div class="section content">
        <div class="centerContent">
            <form action="addProjectForm.php" method="post">
            <?php
            if("" == trim($_POST['projectName'])) {
                ?><span style="color: red"><?php echo "Project name can't be blank!"?></span><br><?php
            }
            ?>
                <span style="color: red">*</span>Project Name: <input type="text" name="projectName">
                <br>
                <br>
                Project Deadline: Month <input type="number" maxlength="2"  name="month">, Day <input type="number" maxlength="2"  name="day">, Year <input type="number" maxlength="4"  name="year">
                <br>
                <br>
                <input class="button centerContent" type="submit">
            </form>
            <br>
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