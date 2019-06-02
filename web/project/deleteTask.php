<?php
session_start();
require "../../database/dbConnect.php";
$task = $_POST['deadTask'];
$project = $_SESSION['project'];
$checkStatement = get_db()->prepare("SELECT task_title FROM task WHERE task_title='$task';");
$checkStatement->execute();
$checkRows = $checkStatement->rowCount();
if(!empty($checkRows) && $checkRows > 0) {
    $deleteStatement = get_db()->prepare("DELETE FROM task WHERE task_title='$task' AND project_fk='$project';");
    $deleteStatement->execute();
}
header("Location: projectView.php");
?>