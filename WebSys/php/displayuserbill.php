<?php
// Database Connection
require "dbCon.php";

class UserBillDisplay {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayUserBills($userID) {
        $billData = array(); // Initialize as an empty array

        // Query to call the SP_DisplayUserBill stored procedure
        $sqlQuery = "CALL SP_DisplayUserBill('$userID')";

        // Execute the stored procedure
        $result = $this->conn->query($sqlQuery);

        // Check if the query was successful
        if ($result) {
            // Fetch the result as an associative array
            while ($row = $result->fetch_assoc()) {
                // Format the amount with peso sign and commas
                $row['Amount'] = '₱' . number_format($row['Amount'], 2);

                // Add a comma for meter when it reaches 4 digits
                $row['Meter'] = number_format($row['Meter'], 2);

                $billData[] = $row;
            }
        } else {
            // Handle the case where the query failed, e.g., log an error or show a message
            echo "Database query failed: " . $this->conn->error;
        }

        return $billData;
    }
}

// Create an instance of the UserBillDisplay class
$userBillDisplay = new UserBillDisplay($conn);

// Initialize variables
$billData = array(); // Initialize as an empty array

if (isset($_SESSION['UserID'])) {
    $userID = $_SESSION['UserID'];

    // Display user bills using the UserBillDisplay class
    $billData = $userBillDisplay->displayUserBills($userID);
} else {
    // Redirect to the login page if the UserID is not set in the session
    header("Location: ../login.php");
    exit();
}
?>
