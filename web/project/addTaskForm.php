<?php
session_start();
require "../../database/dbConnect.php";
$taskName = strip_tags($_POST['taskName']);
$desc     = strip_tags($_POST['desc']);
$deadline = strip_tags($_POST['deadline']);
$assignee = strip_tags($_POST['assignee']);
$username = $_SESSION['username'];
$project = $_SESSION['project'];

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
            <span style="color: red">*</span>Task Name: <input type="text" name="taskName">
            <br>
            <span style="color: red">*</span>Task Description: <textarea name="desc"></textarea>
            <br>
            Task Deadline: <input type="date" name="deadline">
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