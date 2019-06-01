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
            <h1 class="textHeader1">Create Project</h1>
        </div>
        <div class="content">
            <form action="addProject.php" method="post">
                <span style="color: red">*</span>Task Name: <input type="text" name="taskName">
                <br>
                <span style="color: red">*</span>Task Description: <textarea name="desc"></textarea>
                <br>
                Task Deadline: <input type="date" name="deadline">
                <br>
                Task Assignment:
                <select name="assignee">
                    <?php
                    $memberStatement = $db->prepare("SELECT fname, lname FROM famusers WHERE family_fk=(SELECT family_fk FROM famusers WHERE username='$username');");
                    $memberStatement->execute();
                    while ($memberRow = &$memberStatement->fetch(PDO::FETCH_ASSOC)) {
                        $fname = $memberRow['fname'];
                        $lname = $memberRow['lname'];
                        $fullname = $fname + $lname;
                        ?>
                        <option value="<?php $fullname ?>" ><?php $fullname ?></option>
                        <?php
                    }
                    ?>

                    <option value="none" >Select Title</option>
                    <option value="Father" >Father</option>
                    <option value="Mother" >Mother</option>
                    <option value="Child" >Child</option>
                </select>
                <br>
                Last Name: <input type="text" name="lname">
                <br>
                Family title:
                <select name="famTitle">
                    <option value="none" >Select Title</option>
                    <option value="Father" >Father</option>
                    <option value="Mother" >Mother</option>
                    <option value="Child" >Child</option>
                </select>
                <br>
                Family Name: <input type="text" name="family">
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