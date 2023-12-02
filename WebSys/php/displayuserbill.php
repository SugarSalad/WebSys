<?php
// Database Connection
require "dbCon.php"; // Including the file for database connection

// UserBillDisplay class to handle displaying user bills
class UserBillDisplay {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn; // Assigning the database connection to the class property
    }

    // Method to display bills for a specific user
    public function displayUserBills($userID) {
        $billData = array(); // Initialize an empty array to store bill data

        // Query to call the SP_DisplayUserBill stored procedure, using the provided userID
        $sqlQuery = "CALL SP_DisplayUserBill('$userID')";

        // Execute the stored procedure
        $result = $this->conn->query($sqlQuery);

        // Check if the query was successful
        if ($result) {
            // Fetch the result as an associative array and format specific fields
            while ($row = $result->fetch_assoc()) {
                // Format the amount with peso sign and commas
                $row['Amount'] = '₱' . number_format($row['Amount'], 2);

                // Add a comma for meter when it reaches 4 digits
                $row['Meter'] = number_format($row['Meter'], 2);

                // Add the formatted row to the bill data array
                $billData[] = $row;
            }
        } else {
            // Handle the case where the query failed, e.g., log an error or show a message
            echo "Database query failed: " . $this->conn->error;
        }

        return $billData; // Return the array containing user bill data
    }
}

// Create an instance of the UserBillDisplay class with the database connection
$userBillDisplay = new UserBillDisplay($conn);

// Initialize variables
$billData = array(); // Initialize an empty array to store bill data

if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID']; // Get the UserID from the session

    // Display user bills using the UserBillDisplay class for the obtained UserID
    $billData = $userBillDisplay->displayUserBills($userID);
} else {
    // Redirect to the login page if the UserID is not set in the session
    header("Location: ../login.php");
    exit();
}
?>
