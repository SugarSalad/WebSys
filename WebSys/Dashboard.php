
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="./css/dashboard.css">
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

</body>
</html>
