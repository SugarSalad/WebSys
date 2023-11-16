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
    $BillID = validate($_POST['billId']);
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

                // Call the stored procedure to update the bill for the retrieved UserID
                $updateBillQuery = "CALL SP_UpdateBill('$BillID', $userID, '$date', $meter, $amount, '$status')";
                // Before the update query
                echo "Before Update Query: BillID: $BillID, UserID: $userID, Date: $date, Meter: $meter, Amount: $amount, Status: $status";

                $result = $conn->query($updateBillQuery);
                // After the update query
                echo "After Update Query: Update successful. Rows affected: " . $conn->affected_rows;

                
                // Check if the query was successful
                if ($result) {
                    // Send a plain text response indicating success
                    header('Content-Type: text/plain');
                    echo 'Bill updated successfully.';
                    exit();
                } else {
                    // Send a plain text response indicating failure and include the error message
                    header('Content-Type: text/plain');
                    echo 'Error: ' . $conn->error;
                }
            } else {
                // Send a plain text response indicating user not found
                header('Content-Type: text/plain');
                echo 'User not found with the provided name.';
            }
        } else {
            // Send a plain text response indicating query failure
            header('Content-Type: text/plain');
            echo 'Error: ' . $conn->error;
        }
    }
}
?>
