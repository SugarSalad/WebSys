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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user input
    $id = validate($_POST['username']);
    $password = validate($_POST['password']);

    // Check if data is empty
    if (empty($id) || empty($password)) {
        header("Location: ../index.php?error=Username and Password are required");
        exit();
    }

    // Query for Student Role
    $sqlQuery = "CALL SP_GetAccount('$id', '$password')";

    // Execute the statement
    $result = $conn->query($sqlQuery);

    if (!$result) {
        // Handle query error
        die("Error executing the query: " . $conn->error);
    }

    // Fetch the user data
    $user = $result->fetch_assoc();

    if ($user) {
        // User authenticated, store session information
        $_SESSION['AccountID'] = $user['AccountID'];
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['Password'] = $user['Password'];
        $_SESSION['Level'] = $user['Level'];
        $_SESSION['Name'] = $user['Name'];
        $_SESSION['HouseNumber'] = $user['HouseNumber'];
        $_SESSION['Sex'] = $user['Sex'];
        $_SESSION['Email'] = $user['Email'];

        // Check user level and redirect accordingly
        if ($_SESSION['Level'] === 'User') {
            header("Location: ../UserForm.php");
            exit();
        } elseif ($_SESSION['Level'] === 'Admin') {
            header("Location: ../Dashboard.php");
            exit();
        } else {
            echo "Invalid user level.";
        }
    } else {
        header("Location: ../index.php?error=Incorrect Username or Password");
        exit();
    }

    header("Location: ../index.php?error=Invalid ID or Password");
    exit();
}
?>
