<?php
session_start();
require "database/dbConnect.php";
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
    header("Location:login.php");
    ?><span><?php echo "Login failed!"?><span><?php
}
?>

