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
$db = get_db();

if("" != trim($_POST['taskName']) && "" != trim($_POST['desc']) && "" != trim($_POST['assignee'])) {
    $insertStatement = $db->prepare("INSERT INTO Task (task_title, task_description, task_deadline, assignee, date_added, added_by, project_fk) 
                                                    VALUES (
                                                            '$taskName', 
                                                            '$desc', 
                                                            '$deadline', 
                                                            '$assignee', 
                                                            current_date, 
                                                            '$username', 
                                                            (SELECT project_pk FROM project WHERE project_name='$project')
                                                            );");
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
    <meta name='viewport'
    <title>Task Maker</title>
    <link rel='stylesheet' href=''/>
    <script src=""></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">Create Task</h1>
    </div>
    <div class="content">
        <form action="addTaskForm.php" method="post">
            <?php
            if ("" != trim($_POST['taskName'])) {
                ?><span style="color: red"><?php echo "Task name can't be blank!"?></span><br><?php
            }
            ?>
            <span style="color: red">*</span>Task Name: <input type="text" name="taskName">
            <br>
            <?php
            if ("" != trim($_POST['taskDesc'])) {
                ?><span style="color: red"><?php echo "Task description can't be blank!"?></span><br><?php
            }
            ?>
            <span style="color: red">*</span>Task Description:
            <br>
            <textarea name="desc"></textarea>
            <br>
            Task Deadline: Month <input type="number" maxlength="2"  name="month">, Day <input type="number" maxlength="2"  name="day">, Year <input type="number" maxlength="4"  name="year">
            <br>
            <span style="color: red">*</span>Task Assignment:
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