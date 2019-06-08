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
    <div class="header">
        <h1 class="textHeader1">The Project Room</h1>
        <h2 class="textHeader3">Here you can see all the tasks in your project called <?php echo $project ?></h2>
    </div>
    <div class="content">
        <button onclick="location.href = 'addTask.php';">Create Task</button>
        <?php
        $projectStatement = $db->prepare("SELECT * FROM task WHERE project_fk=(SELECT project_pk FROM project WHERE project_name='$project' AND project_pk='$projectPk');");
        $projectStatement->execute();
        if($projectStatement->rowCount() > 0) {

            ?>
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
            ?><span><?php echo "Looks like you don't have any tasks in this project."?></span><?php
        }
        ?>
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