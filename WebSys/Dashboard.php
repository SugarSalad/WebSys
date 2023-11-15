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

    <div id="content">
        <h1>Pansol Rural Association Billing System</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Billing</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Sample data
                $data = array(
                    array("Jawo Tapalla", "Pansol", "100.00", "2023-11-15"),
                    array("Pew-Pew Cuenca", "Arawan", "75.50", "2023-11-16"),
                    array("Jane Mokoto", "Lipa", "75.50", "2023-11-16")
                );

                foreach ($data as $row) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "<td class='action-buttons'>
                            <button class='updateButton'>Update</button>
                            <button class='deleteButton'>Delete</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
