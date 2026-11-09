
<?php
session_start();

// Clear all session data
session_unset();

// Destroy session
session_destroy();

// Return to login page
header("Location: login.php");
exit();
?>
