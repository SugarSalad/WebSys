<?php require "./php/authenticateaccount.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png">
    <title>Billing Information</title>
    <link rel="stylesheet" href="./css/userForm.css"> <!-- Linking to your custom CSS file -->
</head>
<body>
    <div class="whole-container">
        <h1>Billing Information</h1>
        <!-- Displaying user's information -->
        <div class="banner">
            <!-- Div to contain user's information -->
            <div class="studentInfo-text1">
                <!-- Displaying user's name -->
                <span class="text-label" style="font-weight: bold;">Name:</span><br/>
                <span class="text-info" id="name"><?php echo $_SESSION['Name']; ?></span><br><br><br>
                <div class="studentInfo-text">
                    <!-- Displaying user's email -->
                    <span class="text-label" style="font-weight: bold;">Email:</span><br/>
                    <span class="text-info" id="email"><?php echo $_SESSION['Email']; ?></span><br><br><br>
                </div>
            </div>
            <div class="studentInfo-text2">
                <!-- Displaying user's house number -->
                <div class="studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">House Number:</span><br/>
                    <span class="text-info" id="HouseNum"><?php echo $_SESSION['HouseNumber']; ?></span><br><br><br>
                </div>
                <div class="studentInfo-text">
                    <!-- Displaying user's gender -->
                    <span class="text-label" style="font-weight: bold;">Gender:</span><br/>
                    <span class="text-info" id="Sex"><?php echo $_SESSION['Sex']; ?></span><br><br><br>
                </div>
            </div>
        </div>
        <!-- Including PHP file to display user's bill information -->
        <?php include "./php/displayuserbill.php" ?>
        <!-- Table to display user's billing history -->
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Meter</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping through user's billing data -->
                <?php foreach ($billData as $bill) : ?>
                    <tr> 
                        <!-- Displaying billing details: Date, Meter, Amount, and Status -->
                        <td><?php echo $bill['Date']; ?></td>
                        <td><?php echo $bill['Meter']; ?></td>
                        <td><?php echo $bill['Amount']; ?></td>
                        <td><?php echo $bill['Status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Logout button for user -->
    <a href="./php/logoutUser.php" class="logout-button">Logout</a>
</body>
</html>
