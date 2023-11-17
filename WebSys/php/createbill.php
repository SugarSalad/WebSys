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
    $name = validate($_POST['name']);
    $date = validate($_POST['date']);
    $amount = validate($_POST['amount']);
    $status = validate($_POST['status']);
    $meter = validate($_POST['currentReading']);

    // Check if data is empty
    if (empty($name) || empty($date) || empty($amount) || empty($status) || empty($meter)) {
        // Send a JSON response indicating missing values
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Missing values. Please fill in all fields.']);
        exit();
    } else {
        // Call the stored procedure to get UserID based on the provided name
        $getUserIDQuery = "CALL SP_GetName('$name', @userID)";
        $userResult = $conn->query($getUserIDQuery);

        if ($userResult) {
            // Fetch the result of the stored procedure
            $userIDQuery = $conn->query("SELECT @userID as userID");
            $userData = $userIDQuery->fetch_assoc();

            if ($userData) {
                $userID = $userData['userID'];

                // Call the stored procedure to create a new bill
                $createBillQuery = "CALL SP_CreateBill($userID, '$date', $meter, $amount, '$status')";
                $result = $conn->query($createBillQuery);

                // Check if the query was successful
                if ($result) {
                    // Send a JSON response indicating success
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'message' => 'Bill created successfully.']);
                    exit();
                } else {
                    // Send a JSON response indicating failure and include the error message
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'Error creating bill: ' . $conn->error]);
                    exit();
                }
            } else {
                // Send a JSON response indicating user not found
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'User not found with the provided name.']);
                exit();
            }
        } else {
            // Send a JSON response indicating query failure
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
            exit();
        }
    }
}
?>
