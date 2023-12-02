<?php
    session_start(); // Start/resume the session

    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session data

    header("Location: ../index.php"); // Redirect to the index.php page
?>
