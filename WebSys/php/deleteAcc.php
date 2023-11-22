<?php
// Database Connection
require "./dbCon.php";

// Check if the ID parameter is set and is a valid integer
if (isset($_POST['userId']) && is_numeric($_POST['userId'])) {
    // Sanitize the input
    $id = intval($_POST['userId']);

    // Use a prepared statement to prevent SQL injection
    $deleteQuery = "CALL SP_DeleteAccount(?)";
    $stmt = $conn->prepare($deleteQuery);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $id);

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
        echo 'Error preparing statement: ' . $conn->error;
    }
} else {
    echo 'Invalid or missing ID parameter';
}

// Close the database connection
$conn->close();
?>
