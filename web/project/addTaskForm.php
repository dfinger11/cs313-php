<?php
session_start();
require "../../database/dbConnect.php";
$taskName = strip_tags($_POST['taskName']);
$desc     = strip_tags($_POST['desc']);
$month = strip_tags($_POST['month']);
$day = strip_tags($_POST['day']);
$year = strip_tags($_POST['year']);
$date = $year . '-' . $month . '-' . $day;
if($date == "--" || $day == "" || $month == "" || $year == "") {
    $deadline = null;
} else {
    $deadline = $date;
}
$assignee = strip_tags($_POST['assignee']);
$username = $_SESSION['username'];
$project = $_SESSION['project'];
$projectPk = $_SESSION['project_pk'];
$db = get_db();

if("" != trim($_POST['taskName']) && "" != trim($_POST['desc']) && "" != trim($_POST['assignee'])) {
    if ($deadline != null) {
        $insertStatement = $db->prepare("INSERT INTO Task (task_title, task_description, task_deadline, assignee, date_added, added_by, project_fk) 
                                                    VALUES (
                                                            '$taskName', 
                                                            '$desc', 
                                                            '$deadline', 
                                                            '$assignee', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT DISTINCT ON (project_pk) project_pk FROM project WHERE project_name='$project' AND project_pk='$projectPk')
                                                            );");
    } else {
        $insertStatement = $db->prepare("INSERT INTO Task (task_title, task_description, assignee, date_added, added_by, project_fk) 
                                                    VALUES (
                                                            '$taskName', 
                                                            '$desc',  
                                                            '$assignee', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT DISTINCT ON (project_pk) project_pk FROM project WHERE project_name='$project' AND project_pk='$projectPk')
                                                            );");
    }

    $insertStatement->execute();
    header("Location: projectView.php");
}

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    $username = $_SESSION['username'];
    $db = get_db();
    ?>

    <!DOCTYPE html>
    <html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Task Maker</title>
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
            <button onclick="location.href = 'projectView.php';" class="accordion">Project Room</button>
            <button onclick="location.href = '?logOut';" class="accordion">Logout</button>
        </div>
    </div>
    <div class=" section header">
        <h1 class="textHeader1">Create Task</h1>
    </div>
    <div class="section content">
        <div class="centerContent">
            <form action="addTaskForm.php" method="post">
            <?php
            if ("" != trim($_POST['taskName'])) {
                ?><span style="color: red"><?php echo "Task name can't be blank!"?></span><br><?php
            }
            ?>
                <h4><span class="error">*</span>Task Name:</h4>
                <br>
                <input type="text" name="taskName">
                <br>
            <?php
            if ("" != trim($_POST['taskDesc'])) {
                ?><span style="color: red"><?php echo "Task description can't be blank!"?></span><br><?php
            }
            ?>
                <h4><span class="error">*</span>Task Description:</h4>
                <br>
                <textarea name="desc"></textarea>
                <br>
                <br>
                <h4>Task Deadline:</h4>
                <h4>Month</h4> <input type="number" maxlength="2"  name="month">
                <br>
                <h4>Day</h4> <input type="number" maxlength="2"  name="day">
                <br>
                <h4>Year</h4> <input type="number" maxlength="4"  name="year">
                <br>
                <br>
                <h4><span class="error">*</span>Task Assignment:</h4>
            <select name="assignee">
                <?php
                $memberStatement = $db->prepare("SELECT fname, lname FROM famusers WHERE family_fk=(SELECT family_fk FROM famusers WHERE username='$username');");
                $memberStatement->execute();
                while ($memberRow = &$memberStatement->fetch(PDO::FETCH_ASSOC)) {
                    $fname = $memberRow['fname'];
                    $lname = $memberRow['lname'];
                    $fullname = $fname . ' ' . $lname;
                    ?>
                    <option value="<?php echo $fullname ?>" ><?php echo $fullname ?></option>
                    <?php
                }
                ?>
            </select>
                <br>
                <br>
                <input class="button" type="submit">
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