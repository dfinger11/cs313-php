<?php
session_start();
require "../../database/dbConnect.php";
require "logout.php";


if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
    $username = $_SESSION['username'];
    $db = get_db();
    ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Family Room</title>
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
            <button onclick="location.href = '?logOut';" class="accordion">Logout</button>
            <button onclick="location.href = 'addProject.php';">New Project</button>
        </div>
    </div>
    <div class="section header">
        <h1 class="centerText">The Family Project Planner</h1>
    </div>
    <div class="section content">
        <br>
        <h2 class="centerText">Family Room</h2>
        <br>
        <h3 class="centerText">Here you can see all the members of your family.</h3>
        <h3 class="centerText">To view a project click on the project name in the table.</h3>
        <?php
        $famStatement = $db->prepare("SELECT family_name FROM family WHERE family_pk=
                                     (
                                         SELECT DISTINCT ON (family_fk) family_fk FROM famusers WHERE username='$username'
                                     );
");
        $famStatement->execute();
        $famNameRow = $famStatement->fetch(PDO::FETCH_ASSOC);
        $famName = $famNameRow['family_name'];

        $memberStatment = $db->prepare("SELECT fname, lname, family_title FROM famusers WHERE family_fk=(
                                                    SELECT family_fk FROM famusers WHERE username='$username');");
        $memberStatment->execute();
        ?>
        <br>
        <h4 class="centerText"><?php echo "The $famName Family"?></h4>
        <table class="centerContent">
            <tr>
                <th>First Name</th>
                <th style="width: 10px"></th>
                <th>Last Name</th>
                <th style="width: 10px"></th>
                <th>Title</th>
            </tr>
        <?php
        while ($memberRow = &$memberStatment->fetch(PDO::FETCH_ASSOC)) {
            $fname = $memberRow['fname'];
            $lname = $memberRow['lname'];
            $title = $memberRow['family_title'];
            ?>
            <tr>
                <td><?php echo "$fname"?></td>
                <td style="width: 10px"></td>
                <td><?php echo "$lname"?></td>
                <td style="width: 10px"></td>
                <td><?php echo "$title"?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <br>
        <div class="centerContent">
        <br>
        <?php
        $projectStatement = $db->prepare("SELECT * FROM project WHERE family_fk=(SELECT family_fk FROM famusers WHERE username='$username');");
        $projectStatement->execute();
        if($projectStatement->rowCount() > 0) {

            ?>
            <br>
            <h4>Your Families Projects</h4>
            <table class="centerContent">
                <tr>
                    <th>Project Name</th>
                    <th style="width: 10px"></th>
                    <th>Deadline</th>
                    <th style="width: 10px"></th>
                    <th>Date Completed</th>
                    <th style="width: 10px"></th>
                    <th>Created By</th>
                    <th style="width: 10px"></th>
                    <th>Date Created</th>
                </tr>
                <?php
                while ($projectRow = &$projectStatement->fetch(PDO::FETCH_ASSOC)) {
                    $project = $projectRow['project_name'];
                    $projectPk = $projectRow['project_pk'];
                    $deadline = $projectRow['deadline'];
                    if($projectRow['date_completed'] != null) {
                        $dateCompleted = $projectRow['date_completed'];
                    } else {
                        $dateCompleted = 'Not Completed';
                    }

                    $dateCreated = $projectRow['date_created'];
                    $createdBy = $projectRow['created_by'];
                    ?>
                    <tr>
                        <td onclick=" <?php $_SESSION['project'] = $project; $_SESSION['project_pk'] = $projectPk; ?> window.location.href = 'projectView.php';"><?php echo "$project" ?></td>
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
            <br>
            <form action="deleteProject.php" method="post">
                <h4>Delete Project</h4>
                Name of Project to be deleted: <input type="text" name="deadProject">
                <button class="button" type="submit">Delete Project</button>
            </form>
            <?php
        } else {
            ?>
            <p class="centerText"><?php echo "Looks like you don't have any projects."?></p>
            <br>
            <pclass="centerText"><?php echo "To add a project open the menu and click \"New Project\""?></p>
            <?php
        }
        ?>
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