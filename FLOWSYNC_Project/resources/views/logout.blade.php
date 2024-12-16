<?php
session_start();                // Start a session to access session variables
session_destroy();              // Destroy all session data to log the user out
header("Location: login.php");  // Redirect the user to the login page
exit;                           // Ensure that no further code is executed after the redirect
?>
