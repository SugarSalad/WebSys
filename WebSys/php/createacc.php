<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

// Validation Method
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user input
    $username = validate($_POST['username']);
    $password = validate($_POST['password']); 
    $name = validate($_POST['name']);
    $houseNo = validate($_POST['houseNo']);
    $gender = validate($_POST['gender']);
    $email = validate($_POST['email']);

    // Check if data is empty
    if (empty($username) || empty($password) || empty($name) || empty($houseNo) || empty($gender) || empty($email)) {
        // Redirect to registration page with an error message
        header("Location: ../create_account.php?error=Missing values. Please fill in all fields.");
        exit();
    } else {
        // Call the stored procedure to create the account
        $createAccountQuery = "CALL SP_CreateAccount('$username', '$password', 'User', '$name', '$houseNo', '$gender', '$email')";
        $result = $conn->query($createAccountQuery);

        // Check if the query was successful
        if ($result) {
            // Send a success message as a query parameter
            header("Location: ../index.php?success=Account created successfully.");
            exit();
        } else {
            // Send an error message as a query parameter
            header("Location: ../create_account.php?error=Error: " . $conn->error);
            exit();
        }
    }
} else {
    // Redirect to registration page if form is not submitted
    header("Location: ../create_account.php");
    exit();
}
?>
