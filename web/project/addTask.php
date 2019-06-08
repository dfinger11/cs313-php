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
                <span class="error">*</span>Task Name:
                <br>
                <input type="text" name="taskName">
                <br>
                <span class="error">*</span>Task Description:
                <br>
                <textarea name="desc"></textarea>
                <br>
                Task Deadline:
                <br>
                Month <input type="number" maxlength="2"  name="month">
                <br>
                Day <input type="number" maxlength="2"  name="day">
                <br>
                Year <input type="number" maxlength="4"  name="year">
                <br>
                <span class="error">*</span>Task Assignment:
                <br>
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