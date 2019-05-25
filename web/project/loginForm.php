<?php
require "database/dbConnect.php";
include "login.php";
session_start();
$username = htmlspecialchars($_POST['username']);
$password = crypt(htmlspecialchars($_POST['password']), CRYPT_BLOWFISH);
$db = get_db();
$statement = $db->prepare("SELECT * FROM famusers WHERE username='$username' AND password = '$password'");
$userFound = $statement->execute();

if($userFound) {
    $_SESSION['authenticated'] = true;
    header("Location:familyHome.php");

} else {
    $_SESSION['authenticated'] = false;
    ?><span><?php echo "Username or Password is incorrect!!";?></span> <?php
}
?>

