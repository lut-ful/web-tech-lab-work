<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: customer_login.php");
exit;
?>
