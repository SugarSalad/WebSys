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
    $billID = validate($_POST['billID']);
    $name = validate($_POST['name']);
    $date = validate($_POST['date']);
    $amount = validate($_POST['amount']);
    $status = validate($_POST['status']);
    $meter = validate($_POST['meter']);

    // Check if data is empty
    if (empty($billID) || empty($name) || empty($date) || empty($amount) || empty($status) || empty($meter)) {
        // Send a JSON response indicating missing values
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Missing values. Please fill in all fields.']);
    } else {
        // Update the data in the database
        $updateQuery = "UPDATE tbl_bill SET Name='$name', Date='$date', Meter=$meter, Amount=$amount, Status='$status' WHERE BillID=$billID";

        $result = $conn->query($updateQuery);

        // Check if the query was successful
        if ($result) {
            // Send a JSON response indicating success
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'Bill updated successfully.']);
            exit();
        } else {
            // Send a JSON response indicating failure and include the error message
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Error updating bill: ' . $conn->error]);
            exit();
        }
    }
}
?>
