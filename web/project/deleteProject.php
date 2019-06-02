<?php
session_start();
require "../../database/dbConnect.php";
$project = $_POST['deadProject'];
$username = $_SESSION['username'];
$checkStatement = get_db()->prepare("SELECT project_name FROM project WHERE project_name='$project';");
$checkStatement->execute();
$checkRows = $checkStatement->rowCount();
if(!empty($checkRows) && $checkRows > 0) {
    $deleteStatement = get_db()->prepare("DELETE FROM project WHERE project_name='$project' AND family_fk=(SELECT family_fk FROM famusers WHERE username='$username';");
    $deleteStatement->execute();
}
header("Location: familyHome.php");
?>