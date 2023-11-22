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
    $id = validate($_POST['id']);
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $level = validate($_POST['level']);
    $name = validate($_POST['name']);
    $housenum = validate($_POST['housenum']);
    $sex = validate($_POST['sex']);
    $email = validate($_POST['email']);

    // Check if data is empty
    if (empty($id) || empty($username) || empty($password) || empty($level) || empty($name) || empty($housenum) || empty($sex) || empty($email)) {
        // Send a JSON response indicating missing values
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Missing values. Please fill in all fields.']);
    } else {
        // Call the stored procedure to update the account
        $updateAccountQuery = "CALL SP_UpdateAccount($id, '$username', '$password', $level, '$name', '$housenum', '$sex', '$email')";
        
        // Before the update query
        echo "Before Update Query: UserID: $id, Username: $username, Password: $password, Level: $level, Name: $name, HouseNumber: $housenum, Sex: $sex, Email: $email";

        $result = $conn->query($updateAccountQuery);

        // After the update query
        echo "After Update Query: Update successful. Rows affected: " . $conn->affected_rows;

        // Check if the query was successful
        if ($result) {
            // Send a plain text response indicating success
            header('Content-Type: text/plain');
            echo 'Account updated successfully.';
            exit();
        } else {
            // Send a plain text response indicating failure and include the error message
            header('Content-Type: text/plain');
            echo 'Error: ' . $conn->error;
        }
    }
}
?>
