<?php
// Database Connection
require "./dbCon.php";

class BillDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteBill($billId) {
        // Check if the ID parameter is set and is a valid integer
        if (isset($billId) && is_numeric($billId)) {
            // Sanitize the input
            $id = intval($billId);

            // Use a prepared statement to prevent SQL injection
            $deleteQuery = "CALL SP_DeleteBill(?)";
            $stmt = $this->conn->prepare($deleteQuery);

            if ($stmt) {
                // Bind the parameter
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

// Create an instance of the BillDeleter class
$billDeleter = new BillDeleter($conn);

// Check if the ID parameter is set in the POST request
if (isset($_POST['billId'])) {
    // Delete the bill using the deleteBill method
    $resultMessage = $billDeleter->deleteBill($_POST['billId']);
    echo $resultMessage;
} else {
    echo 'Invalid or missing ID parameter';
}

// Close the database connection
$conn->close();
?>
