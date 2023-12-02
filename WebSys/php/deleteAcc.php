<?php
// Database Connection
require "./dbCon.php"; // Include file for database connection

// AccountDeleter class to handle account deletion
class AccountDeleter {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn; // Assign the database connection to the class property
    }

    // Method to delete an account by user ID
    public function deleteAccount($userId) {
        // Validate user input: Ensure $userId is an integer
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if ($userId === false) {
            echo 'Invalid or missing ID parameter';
            return;
        }

        // Use a prepared statement to prevent SQL injection
        $deleteQuery = "CALL SP_DeleteAccount(?)"; // SQL query using a stored procedure
        $stmt = $this->conn->prepare($deleteQuery); // Prepare the statement

        if ($stmt) {
            // Bind the parameter (user ID)
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

// Create an instance of the AccountDeleter class with the database connection
$accountDeleter = new AccountDeleter($conn);

// Check if the 'userId' parameter is set in the POST request
if (isset($_POST['userId'])) {
    // Call the deleteAccount method with the provided userId
    $accountDeleter->deleteAccount($_POST['userId']);
} else {
    echo 'Invalid or missing ID parameter';
}

// Close the database connection
$conn->close();
?>
