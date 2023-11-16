<?php
// Database Connection
require "./php/dbCon.php";

// Fetch data from the database using the stored procedure
$sqlQuery = "CALL SP_DisplayBill();";

// Execute the statement
$result = $conn->query($sqlQuery);

if (!$result) {
    // Handle query error
    die("Error executing the query: " . $conn->error);
}

// Fetch the data
$data = array();
while ($row = $result->fetch_assoc()) {
    $row['Amount'] = '₱' . number_format($row['Amount'], 2);

    $data[] = array(
        'BillID' => isset($row['BillID']) ? $row['BillID'] : '',
        'Name' => isset($row['Name']) ? $row['Name'] : '',
        'HouseNumber' => isset($row['HouseNumber']) ? $row['HouseNumber'] : '',
        'Meter' => isset($row['Meter']) ? $row['Meter'] : '',
        'Date' => isset($row['Date']) ? $row['Date'] : '',
        'Amount' => isset($row['Amount']) ? $row['Amount'] : '',
        'Status' => isset($row['Status']) ? $row['Status'] : '',
    );
}

?>
