<?php
/* Log out script */
//If the user logs out, destroy session and redirect to login page
session_start();
session_destroy();
header("location: login.php");
?>

