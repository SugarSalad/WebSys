<?php 
    // Login Credentials to XAMPP
    $sname = "localhost";   // Server name, typically 'localhost' for local development
    $uname = "root";        // Username, often 'root' by default in XAMPP
    $password = "";         // Password, usually blank by default in local XAMPP setup

    // Database Name
    $dbName = "water";      // Name of the database to connect to

    // Establishing connection to the database using mysqli
    $conn = mysqli_connect($sname, $uname, $password, $dbName);

    // Checking if the connection was successful
    if ($conn->connect_error) {
        // If the connection fails, display an error message and terminate the script
        die("Connection Failed: " . $conn->connect_error);
    }
?>
