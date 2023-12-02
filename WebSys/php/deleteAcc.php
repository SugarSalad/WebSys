<?php
// Database Connection
require "./dbCon.php";

class AccountDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteAccount($userId) {
        // Validate user input
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if ($userId === false) {
            echo 'Invalid or missing ID parameter';
            return;
        }

        // Use a prepared statement to prevent SQL injection
        $deleteQuery = "CALL SP_DeleteAccount(?)";
        $stmt = $this->conn->prepare($deleteQuery);

        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $userId);

            // Execute the statement
            $stmt->execute();

            // Check if the record was deleted successfully
            if ($stmt->affected_rows > 0) {
                echo 'Record deleted successfully';
            } else {
                echo 'No record found with the provided ID';
            }

            // Close the statement
            $stmt->close();
        } else {
            echo 'Error preparing statement: ' . $this->conn->error;
        }
    }
}

// Create an instance of the AccountDeleter class
$accountDeleter = new AccountDeleter($conn);

// Check if the ID parameter is set in the POST request
if (isset($_POST['userId'])) {
    // Call the deleteAccount method
    $accountDeleter->deleteAccount($_POST['userId']);
} else {
    echo 'Invalid or missing ID parameter';
}

// Close the database connection
$conn->close();
?>
