<?php
session_start();
require "../../database/dbConnect.php";
$project = $_SESSION['project'];
$projectPk = $_SESSION['project_pk'];

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    $username = $_SESSION['username'];
    $db = get_db();
    ?>

    <!DOCTYPE html>
    <html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Project Room</title>
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
            <button onclick="location.href = 'addTask.php';" class="accordion">Create Task</button>
            <button onclick="location.href = '?logOut';" class="accordion">Logout</button>
        </div>
    </div>
    <div class="section header">
        <h1>The Project Room</h1>
    </div>
    <div class="section content">
        <h2 class="centerText"><?php echo $project ?></h2>
        <div class="centerContent">
            <?php
            $projectStatement = $db->prepare("SELECT * FROM task WHERE project_fk=(SELECT project_pk FROM project WHERE project_name='$project' AND project_pk='$projectPk');");
            $projectStatement->execute();
            if($projectStatement->rowCount() > 0) {

            ?>
            <h3 class="centerText">Here is the list of all tasks for this project.</h3>
            <table>
                <thead>Your Families Projects</thead>
                <tr>
                    <th>Project Name</th>
                    <th style="width: 10px"></th>
                    <th>Description</th>
                    <th style="width: 10px"></th>
                    <th>Deadline</th>
                    <th style="width: 10px"></th>
                    <th>Task Assignment</th>
                    <th style="width: 10px"></th>
                    <th>Date Completed</th>
                    <th style="width: 10px"></th>
                    <th>Added By</th>
                    <th style="width: 10px"></th>
                    <th>Date Added</th>
                    <th style="width: 10px"></th>
                    <th>Edit Task</th>
                    <th style="width: 10px"></th>
                    <th>Delete Task</th>
                </tr>
                <?php
                while ($taskRow = &$projectStatement->fetch(PDO::FETCH_ASSOC)) {
                    $taskName = $taskRow['task_title'];
                    $taskDesc = $taskRow['task_description'];
                    $deadline = $taskRow['task_deadline'];
                    $assignee = $taskRow['assignee'];
                    if($taskRow['date_completed'] != null) {
                        $dateCompleted = $taskRow['date_completed'];
                    } else {
                        $dateCompleted = 'Not Completed';
                    }
                    $dateCreated = $taskRow['date_added'];
                    $createdBy = $taskRow['added_by'];
                    ?>
                    <tr>
                        <td><?php echo "$taskName" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$taskDesc" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$deadline" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$dateCompleted" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$createdBy" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$dateCreated" ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <form action="deleteTask.php" method="post">
                <h3>Delete Task</h3>
                Name of the task to be deleted: <input type="text" name="deadTask">
                <button type="submit">Delete Project</button>
            </form>
            <?php
        } else {
            ?>
                <h3 class="centerText"><?php echo "Looks like you don't have any tasks in this project."?></h3>
                <?php
        }
        ?>
            <h4 class="centerText"><?php echo "To add a task open the menu and click \"Create Task\""?></h4>
        </div>
    </div>
    <div class="section footer">

    </div>
</div>
</body>

    <?php
} else {
    header("Location: login.php");
}
?>