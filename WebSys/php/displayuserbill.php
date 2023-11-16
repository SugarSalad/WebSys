<?php
// Database Connection
require "dbCon.php";

// Initialize variables
$billData = array(); // Initialize as an empty array

if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];

    // Query to call the SP_DisplayUserBill stored procedure
    $sqlQuery = "CALL SP_DisplayUserBill('$userID')";

    // Execute the stored procedure
    $result = $conn->query($sqlQuery);

    // Check if the query was successful
    if ($result) {
        // Fetch the result as an associative array
        while ($row = $result->fetch_assoc()) {
            // Format the amount with peso sign and commas
            $row['Amount'] = '₱' . number_format($row['Amount'], 2);

            // Add a comma for meter when it reaches 4 digits
            $row['Meter'] = number_format($row['Meter']);

            $billData[] = $row;
        }
    } else {
        // Handle the case where the query failed, e.g., log an error or show a message
        echo "Database query failed: " . $conn->error;
    }
} else {
    // Redirect to the login page if the UserID is not set in the session
    header("Location: ../login.php");
    exit();
}
?>
