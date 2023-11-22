<?php
// Database Connection
require "./php/dbCon.php";

// Fetch data from the database using the stored procedure
$sqlQuery = "CALL SP_DisplayAccount();";

// Execute the statement
$result = $conn->query($sqlQuery);

if (!$result) {
    // Handle query error
    die("Error executing the query: " . $conn->error);
}

// Fetch the data
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array(
        'UserID' => isset($row['UserID']) ? $row['UserID'] : '',
        'Name' => isset($row['Name']) ? $row['Name'] : '',
        'HouseNumber' => isset($row['HouseNumber']) ? $row['HouseNumber'] : '',
        'Sex' => isset($row['Sex']) ? $row['Sex'] : '',
        'Email' => isset($row['Email']) ? $row['Email'] : '',
        'Username' => isset($row['Username']) ? $row['Username'] : '',
        'Password' => isset($row['Password']) ? $row['Password'] : '',
        'Level' => isset($row['Level']) ? $row['Level'] : '',
    );
}

?>
