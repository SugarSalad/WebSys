<?php

    require "dbCon.php";

    // Start or resume the session
    session_start();

    // Check if the user is authenticated
    if (!isset($_SESSION['AccountID'])) {
        header("Location: ../index.php");
        exit();
    }

?>