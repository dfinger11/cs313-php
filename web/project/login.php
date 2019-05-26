<?php
session_start();
if(isset($_SESSION['authenticated'])) {
    if($_SESSION['authenticated'] == true) {
        //header("Location:familyHome.php");
    }
}
require "../../database/dbConnect.php";
function authenticate()
{
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $db = get_db();
    $statement = $db->prepare("SELECT * FROM famusers WHERE username='$username' AND password_hash = '$password'");
    $statement->execute();

    $rowCount = $statement->rowCount();
    if (!empty($rowCount) && $rowCount == 1) {
        $_SESSION['authenticated'] = true;
    } else {
        $_SESSION['authenticated'] = false;
    }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
    <title>Family Game Plan Login</title>
    <link rel='stylesheet' href=''/>
    <script src=""></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">The Family Game Plan</h1>
        <h2 class="textHeader3">Designed to help you manage your family projects</h2>
    </div>
    <div class="content">
        <h3>Login</h3>
        <form action="login.php" method="post">
            Username: <input type="text" name="username">
            <br>
            Password: <input type="password" name="password">
            <br>
            <input type="submit" value="Login">
        </form>
        <?php
        if($_SESSION['authenticated'] == true) {
            ?><span><?php echo "Login success!"?><span><?php
        } else {
            ?><span><?php echo "Login failed!"?><span><?php
        }
        ?>
        <h3>Don't have an account <a  onclick="location.href = 'register.php';" style="color: blue">click here</a>!</h3>
    </div>
    <div class="footer">

    </div>
</div>
</body>
