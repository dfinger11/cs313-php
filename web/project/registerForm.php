<?php
session_start();
require "../../database/dbConnect.php";
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
$repassword = strip_tags($_POST['repassword']);
$fname = strip_tags($_POST['fname']);
$lname = strip_tags($_POST['lname']);
$title = strip_tags($_POST['famTitle']);
$family = strip_tags($_POST['family']);

$db = get_db();
$statement = $db->prepare("SELECT * FROM famusers WHERE username='$username';");
$statement->execute();

$famStatement = $db->prepare("SELECT * FROM family WHERE family_name='$family';");
$famStatement->execute();

$rowCountUser = $statement->rowCount();
$rowCountFam = $famStatement->rowCount();
$userExists = false;
$famExixts = false;
if (!empty($rowCountUser) && $rowCountUser == 1) {
    $userExists = true;
} else if($password != $repassword
            || $title == "none"
            || "" == trim($_POST['family'])
            || "" == trim($_POST['username'])
            ||  "" == trim($_POST['fname'])
            || "" == trim($_POST['lname'])) {

} else if (!empty($rowCountFam) && $rowCountFam == 1) {
    $updateStatement = $db->prepare("INSERT INTO famusers (username, password_hash, fname, lname, family_fk, family_title)
                                                        VALUES (
                                                            '$username',
                                                            '$password',
                                                            '$fname',
                                                            '$lname',
                                                            (SELECT family_pk FROM family WHERE family_name ='$family'),
                                                            '$title'
                                                        );");
    $updateStatement->execute();
    header("Location: familyHome.php");

} else {
    $insertFamStatement = $db->prepare("INSERT INTO family (family_name) VALUES ('$family');");
    $insertFamStatement->execute();
    $userStatement = $db->prepare("INSERT INTO famusers (username, password_hash, fname, lname, family_fk, family_title) 
                                                        VALUES (
                                                            '$username',
                                                            '$password',
                                                            '$fname',
                                                            '$lname',
                                                            (SELECT family_pk FROM family WHERE family_name ='$family'),
                                                            '$title'
                                                        );");
    $userStatement->execute();
    $_SESSION['authenticated'] = true;
    $_SESSION['username'] = $username;
    header("Location: familyHome.php");
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Family Game Plan Login</title>
    <meta name='viewport'
          content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <link rel='stylesheet' href='project1css.css'/>
    <script src="project1js.js"></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">The Family Game Plan</h1>
        <h2 class="textHeader3">Designed to help you manage your family projects</h2>
    </div>
    <div class="content">
        <h3>Register</h3>
        <form action="registerForm.php" method="post">
            <?php
            if($userExists == true) {
                ?><span style="color: red"><?php echo "Username already exists!"?></span><br><?php
            }else if("" == trim($_POST['username'])) {
                ?><span style="color: red"><?php echo "Username can't be blank!"?></span><br><?php
            }
            ?>
            New Username: <input type="text" name="username">
            <br>
            <?php
            if($password != $repassword) {
                ?><span style="color: red"><?php echo "Passwords don't match"?></span><br><?php
            }
            ?>
            New Password: <input type="password" name="password">
            <br>
            Re-enter password: <input type="password" name="repassword">
            <br>
            <?php
            if("" == trim($_POST['fname'])) {
                ?><span style="color: red"><?php echo "Please enter your first name!"?></span><br><?php
            }
            ?>
            First Name: <input type="text" name="fname">
            <br>
            <?php
            if("" == trim($_POST['lname'])) {
                ?><span style="color: red"><?php echo "Please enter your last name!"?></span><br><?php
            }
            ?>
            Last Name: <input type="text" name="lname">
            <br>
            <?php
            if($title == "none") {
                ?><span style="color: red"><?php echo "Please Select your family title!"?></span><br><?php
            }
            ?>
            Family title:
            <select name="famTitle">
                <option value="none" >Select Title</option>
                <option value="Father" >Father</option>
                <option value="Mother" >Mother</option>
                <option value="Child" >Child</option>
            </select>
            <br>
            <?php
            if("" == trim($_POST['family'])) {
                ?><span style="color: red"><?php echo "Please enter your family's name!"?></span><br><?php
            }
            ?>
            Family Name: <input type="text" name="family">
            <br>
            <input type="submit">
        </form>
    </div>
    <div class="footer">

    </div>
</div>
</body>
