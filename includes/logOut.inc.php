<?php
require_once "config_session.inc.php";
session_destroy();

header ('Location: ../index.php');




function preventCachingAndRedirectToLogin() {
    require_once "config_session.inc.php";
    
    // Check if user is not logged in
    if (!isset($_SESSION['user_email'])) {
        // Redirect to login page
        header("Location: ../index.php");
        exit(); // Terminate script execution after redirection
    }

    // Prevent caching of the page
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
}

?>