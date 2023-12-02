<?php require "./php/authenticateaccount.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png">
    <title>Manage Account</title>
    <link rel="stylesheet" href="./css/manageAcc.css"> <!-- Custom CSS for managing accounts page -->
    <link rel="stylesheet" href="./css/modal.css"> <!-- Custom CSS for modal -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js/account.js"></script> <!-- JavaScript file for managing accounts -->
    <script src="./js/buttonFunction.js"></script> <!-- JavaScript file for button functions -->
</head>
<body>
    <!-- Sidebar navigation -->
    <div id="sidebar">
        <h2>MENU</h2><br/><br/><br/>
        <!-- Sidebar buttons -->
        <button class='viewReport' id='viewReportButton'>View Report</button><br /><br/><br/>
        <button class='createBill' id='createBillButton'>Create Bill</button><br /><br/><br/>
        <button class='manageAccounts active' id='manageAccountsButton'>Manage Accounts</button><br /><br/><br/>
        <a href="./php/logoutAdmin.php" class='logout'>Logout</a><br /><br/><br/>
    </div>

    <?php 
    // Include the file that displays the Modal or Update Account popup
    include './php/maModal.php'; 
    ?>

    <?php
    // Include the file that displays the account information
    require "./php/accDisplay.php";
    ?>

    <!-- Main content -->
    <div id="content">
        <h1>Pansol Rural Association Billing System</h1>
        <!-- Table for displaying account information -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>House Number</th>
                    <th>Gender</th>
                    <th>Email Address</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <!-- Loop through data to display account details in table rows -->
                    <tr data-user-id="<?= $row['UserID'] ?>" data-name="<?= $row['Name'] ?>" data-house-number="<?= $row['HouseNumber'] ?>"
                        data-gender="<?= $row['Sex'] ?>" data-email="<?= $row['Email'] ?>" data-username="<?= $row['Username'] ?>"
                        data-password="<?= $row['Password'] ?>" data-level="<?= $row['Level'] ?>">
                        <td><?= $row['UserID'] ?></td>
                        <td><?= $row['Name'] ?></td>
                        <td><?= $row['HouseNumber'] ?></td>
                        <td><?= $row['Sex'] ?></td>
                        <td><?= $row['Email'] ?></td>
                        <td><?= $row['Username'] ?></td>
                        <td><?= $row['Password'] ?></td>
                        <td><?= $row['Level'] ?></td>
                        <td style='text-align: center; display: flex; gap: 4px;'>
                            <!-- Updated button data attribute to use user ID -->
                            <button class='update-button btn btn-primary turned-button' data-user-id="<?= $row['UserID'] ?>">Update</button>
                        </td>
                        <td style='text-align: center; display: flex; gap: 4px;'>
                            <button class='delete-button' data-user-id="<?= $row['UserID'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./js/maModal.js"></script> <!-- JavaScript file for managing accounts modal -->
</body>
</html>
