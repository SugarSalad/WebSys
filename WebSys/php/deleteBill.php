<?php
// Database Connection
require "./dbCon.php"; // Including the file for database connection

// BillDeleter class to handle bill deletion
class BillDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn; // Assigning the database connection to the class property
    }

    // Method to delete a bill by bill ID
    public function deleteBill($billId) {
        // Check if the ID parameter is set and is a valid integer
        if (isset($billId) && is_numeric($billId)) {
            // Sanitize the input and convert to integer
            $id = intval($billId);

            // Use a prepared statement to prevent SQL injection
            $deleteQuery = "CALL SP_DeleteBill(?)"; // SQL query using a stored procedure
            $stmt = $this->conn->prepare($deleteQuery); // Prepare the statement

            if ($stmt) {
                // Bind the parameter (bill ID)
                $stmt->bind_param("i", $id);

                // Execute the statement
                $stmt->execute();

                // Check if the record was deleted successfully
                if ($stmt->affected_rows > 0) {
                    return 'Record deleted successfully';
                } else {
                    return 'No record found with the provided ID';
                }

                // Close the statement
                $stmt->close();
            } else {
                return 'Error preparing statement: ' . $this->conn->error;
            }
        } else {
            return 'Invalid or missing ID parameter';
        }
    }
}

// Create an instance of the BillDeleter class with the database connection
$billDeleter = new BillDeleter($conn);

// Check if the 'billId' parameter is set in the POST request
if (isset($_POST['billId'])) {
    // Delete the bill using the deleteBill method with the provided billId
    $resultMessage = $billDeleter->deleteBill($_POST['billId']);
    echo $resultMessage; // Output the result message (success or error)
} else {
    echo 'Invalid or missing ID parameter'; // Output if 'billId' is not set in the POST request
}

// Close the database connection
$conn->close();
?>
