<?php
    session_start(); // Start or resume the session

    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session data

    header("Location: ../index.php"); // Redirect the user to the index.php page
?>
