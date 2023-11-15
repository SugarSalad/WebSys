<?php
// Start Session
session_start();
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
        $row['BillID'],
        $row['Name'],
        $row['HouseNumber'],
        $row['Date'],
        $row['Amount'],
        $row['Status'],

        
    );
}

// Display the data in the HTML block
?>
<div id="content">
    <h1>Pansol Rural Association Billing System</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>HouseNumber</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>    </th>
                <th>    </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "<td style = text-align: center; display: flex; gap: 4px;'>
                        <button class='updateButton'>Update</button>
                      </td>";
                echo "<td style = text-align: center; display: flex; gap: 4px;'>
                        <button class='deleteButton'>Delete</button>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
