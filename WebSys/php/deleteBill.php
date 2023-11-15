<?php
// Database Connection
require "./php/dbCon.php";

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    // Sanitize the input
    $id = intval($_GET['id']);

    // Call the stored procedure to delete the record
    $deleteQuery = "CALL SP_DeleteBill($id);";
    $conn->query($deleteQuery);
}
