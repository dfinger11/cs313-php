<?php
session_start();
require "../../database/dbConnect.php";
$projectName = strip_tags($_POST['projectName']);
$deadline = strip_tags($_POST['deadline']);
$username = $_SESSION['username'];

if("" != trim($_POST['projectName'])) {
    if(empty($deadline) || $deadline = null || $deadline = "") {
        $insertStatement = $db->prepare("INSERT INTO project (project_name, date_created, created_by, family_fk) 
                                                    VALUES (
                                                            '$projectName', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT family_fk FROM famusers WHERE username='$username')
                                                            );");
    } else {
        $insertStatement = $db->prepare("INSERT INTO project (project_name, deadline, date_created, created_by, family_fk) 
                                                    VALUES (
                                                            '$projectName', 
                                                            '$deadline', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT family_fk FROM famusers WHERE username='$username')
                                                            );");
    }
}

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    $username = $_SESSION['username'];
    $db = get_db();
    ?>

    <!DOCTYPE html>
    <html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
    <title>Project Maker</title>
    <link rel='stylesheet' href=''/>
    <script src=""></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">Create Project</h1>
    </div>
    <div class="content">
        <form action="addProjectForm.php" method="post">
            <?php
            if("" == trim($_POST['projectName'])) {
                ?><span style="color: red"><?php echo "Project name can't be blank!"?></span><br><?php
            }
            ?>
            <span style="color: red">*</span>Project Name: <input type="text" name="projectName">
            <br>
            Project Deadline: <input type="date" name="deadline">
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