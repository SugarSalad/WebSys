<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js/bill.js"></script>
</head>
<body>
    <div id="sidebar">
        <h2>DASHBORAD</h2><br/><br/><br/>
        <button class='viewReport'>View Report</button><br /><br/><br/>
        <button class='createBill'>Create Bill</button><br /><br/><br/>
        <button class='createAccount'>Create Account</button><br /><br/><br/>
        <button class='manageAccounts'>Manage Accounts</button><br /><br/><br/>
        <button class='logout'>Logout</button><br /><br/><br/>
    </div>

    <?php
    // Include the file that displays the bill
    require "./php/billDisplay.php";
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $row) {
                echo "<tr data-bill-id='" . $row['BillID'] . "'>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "<td style='text-align: center; display: flex; gap: 4px;'>";
                echo       "<button class='updateButton'>Update</button>";
                echo    "</td>";
                echo "<td style='text-align: center; display: flex; gap: 4px;'>";
                echo    "<button class='delete-button' data-bill-id='" . $row['BillID'] . "'>Delete</button>";
                echo  "</td>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
