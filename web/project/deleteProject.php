<?php
session_start();
require "../../database/dbConnect.php";
$project = $_POST['deadProject'];
$checkStatement = get_db()->prepare("SELECT project_name FROM project WHERE project_name='$project';");
$checkStatement->execute();
$checkRows = $checkStatement->rowCount();
if(!empty($checkRows) && $checkRows > 0) {
    $deleteStatement = get_db()->prepare("DELETE FROM project WHERE project_name='$project';");
    $deleteStatement->execute();
}
header("Location: familyHome.php");
?>