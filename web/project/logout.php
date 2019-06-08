<?php
if (isset($_GET['logOut'])) {
    session_destroy();
    header("Location: login.php");
}
?>