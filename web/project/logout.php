<?php
if (isset($_GET['logOut'])) {
    session_destroy();
}
?>