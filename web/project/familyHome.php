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
    <meta name='viewport'
    <title>Family Room</title>
    <link rel='stylesheet' href=''/>
    <script src=""></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">The Family Room</h1>
        <h2 class="textHeader3">Here you can see all the members of your family</h2>
    </div>
    <div class="content">
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
        <table>
            <thead><?php echo "The $famName Family"?></thead>
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
        <?php
        $projectStatement = $db->prepare("SELECT * FROM project WHERE family_fk=(SELECT family_pk FROM family WHERE family_name='$famName');");
        $projectStatement->execute();
        if($projectStatement->rowCount() > 0) {

            ?>
            <table>
                <thead>Your Families Projects</thead>
                <tr>
                    <th>Project Name</th>
                    <th style="width: 10px"></th>
                    <th>Deadline</th>
                    <th style="width: 10px"></th>
                    <th>Is Completed</th>
                    <th style="width: 10px"></th>
                    <th>Created By</th>
                    <th style="width: 10px"></th>
                    <th>Date Created</th>
                </tr>
                <?php
                while ($projectRow = &$projectStatement->fetch(PDO::FETCH_ASSOC)) {
                    $project = $projectRow['project_name'];
                    $deadline = $projectRow['deadline'];
                    if($projectRow['is_completed'] == 't') {
                        $isCompleted = true;
                    } else if ($projectRow['is_completed'] == 'f') {
                        $isCompleted = false;
                    }

                    $dateCreated = $projectRow['date_created'];
                    $createdBy = $projectRow['created_by'];
                    ?>
                    <tr>
                        <td><?php echo "$project" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$deadline" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$isCompleted" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$createdBy" ?></td>
                        <td style="width: 10px"></td>
                        <td><?php echo "$dateCreated" ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else {
            ?><span><?php echo "Looks like you don't have any projects."?></span><?php
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