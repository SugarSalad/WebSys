<?php
    // Require the database connection file
    require "dbCon.php";

    // Start or resume the session
    session_start();

    // Check if the user is authenticated
    if (!isset($_SESSION['UserID'])) {
        // If the UserID session variable is not set, redirect the user to the index.php page
        header("Location: ../index.php");
        exit(); // Stop further execution of the script
    }
?>
