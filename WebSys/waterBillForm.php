<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Bill Form</title>
    <link rel="stylesheet" href="./css/billForm.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js/buttonFunction.js"></script>

</head>
<body>
<h2>Water Bill Form</h2>
<div id="waterBillForm">
<form method="post" action="process_form.php">
    <label for="name">Customer Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required><br><br>

    <label for="currentReading">Current Meter Reading:</label>
    <input type="number" id="currentReading" name="currentReading" required><br><br>

    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required><br><br>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="Paid">Paid</option>
        <option value="Unpaid">Unpaid</option>
    </select><br><br>

    <input type="submit" name="submit" value="Create Bill">
</form>
</div>

<div id="sidebar">
        <h3>BILL FORM</h3><br/><br/><br/>
        <button class='viewReport' id='viewReportButton'>View Report</button><br /><br/><br/>
        <button class='createBill'>Create Bill</button><br /><br/><br/>
        <button class='createAccount'>Create Account</button><br /><br/><br/>
        <button class='manageAccounts'>Manage Accounts</button><br /><br/><br/>
        <button class='logout'>Logout</button><br /><br/><br/>
    </div>
</body>
</html>