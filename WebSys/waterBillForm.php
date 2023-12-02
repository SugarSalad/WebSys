<?php require "./php/authenticateaccount.php" ?> <!-- Including the authentication PHP file -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png"> <!-- Favicon -->
    <title>Water Bill Form</title>
    <link rel="stylesheet" href="./css/billForm.css"> <!-- Custom CSS for bill form -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- jQuery library -->
    <script src="./js/buttonFunction.js"></script> <!-- JavaScript file for button functions -->
    <script src="./js/createbill.js"></script> <!-- JavaScript file for creating bill -->
</head>
<body>
    <h2>Water Bill Form</h2>

    <!-- Div to display status messages -->
    <div id="statusMessage"></div>

    <!-- Water bill form starts here -->
    <div id="waterBillForm">
        <form method="post" action="./php/createbill.php"> <!-- Form for creating water bill -->
            <!-- Input fields for customer information -->
            <label for="name">Customer Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>

            <label for="currentReading">Current Meter Reading:</label>
            <input type="number" id="currentReading" name="currentReading" step="any" required><br><br>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" step="any" required><br><br>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Unpaid">Unpaid</option>
                <option value="Paid">Paid</option>
            </select><br><br>

            <input type="submit" name="submit" value="Create Bill"> <!-- Submit button to create bill -->
        </form>
    </div>

    <!-- Sidebar navigation -->
    <div id="sidebar">
        <h3>MENU</h3><br/><br/><br/>
        <!-- Sidebar buttons -->
        <button class='viewReport' id='viewReportButton'>View Report</button><br /><br/><br/>
        <button class='createBill active'>Create Bill</button><br /><br/><br/>
        <button class='manageAccounts'>Manage Accounts</button><br /><br/><br/>
        <a href="./php/logoutAdmin.php" class='logout'>Logout</a><br /><br/><br/>
    </div>
</body>
</html>
