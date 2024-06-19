<?php
// Start the session (if not started already)
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page you want
//header("Location: login.php");
exit();
?>
