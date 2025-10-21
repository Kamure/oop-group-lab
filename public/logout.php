<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// Redirect user back to login page
header("Location: index.php?message=You have been logged out successfully.");
exit();
?>
