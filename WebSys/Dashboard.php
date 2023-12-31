<?php require "./php/authenticateaccount.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png">
    <title>Bill Report</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/modal.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js/bill.js"></script>
    <script src="./js/buttonFunction.js"></script>
</head>
<body>
    <!-- Sidebar navigation -->
    <div id="sidebar">
        <h2>MENU</h2><br/><br/><br/>
        <!-- Sidebar buttons -->
        <button class='viewReport active' id='viewReportButton'>View Report</button><br /><br/><br/>
        <button class='createBill' id='createBillButton'>Create Bill</button><br /><br/><br/>
        <button class='manageAccounts'>Manage Accounts</button><br /><br/><br/>
        <a href="./php/logoutAdmin.php" class='logout'>Logout</a><br /><br/><br/>
    </div>

    <?php 
    // Include the file that displays the Modal or Update Bill popup
    include './php/modal.php'; 
    ?>

    <?php
    // Include the file that displays the bill
    require "./php/billDisplay.php";
    ?>

    <!-- Main content -->
    <div id="content">
        <h1>Pansol Rural Association Billing System</h1>
        <!-- Table for displaying bill information -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>HouseNumber</th>
                    <th>Meter</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the retrieved data to display in the table rows
                foreach ($data as $row) {
                    echo "<tr data-bill-id='" . $row['BillID'] . "' data-name='" . $row['Name'] . "' data-house-number='" . 
                    $row['HouseNumber'] . "' data-meter='" . $row['Meter'] . "' data-date='" . $row['Date'] . "' data-amount='" . 
                    $row['Amount'] . "' data-status='" . $row['Status'] . "'>";

                    // Display individual cell values
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }

                    // Buttons for update and delete actions
                    echo "<td style='text-align: center; display: flex; gap: 4px;'>";
                    echo "<button class='update-button btn btn-primary turned-button' data-bill-id='" . $row['BillID'] . "'>Update</button>";
                    echo "</td>";

                    echo "<td style='text-align: center; display: flex; gap: 4px;'>";
                    echo "<button class='delete-button' data-bill-id='" . $row['BillID'] . "'>Delete</button>";
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Script for handling modal functionality -->
    <script src="./js/modal.js"></script>
</body>
</html>
