<?php require "./php/authenticateaccount.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Information</title>
    <link rel="stylesheet" href="./css/userForm.css"> <!-- Replace './css/styles.css' with your actual CSS file path -->
    <!-- Assuming you have a separate CSS file for styling -->
</head>
<body>
    <div class="whole-container">
        <h1>Billing Information</h1>
        <!------------- Billers Information ------------------> 
        <div class="banner">
            <div class="studentInfo-text1">
                <span class="text-label" style="font-weight: bold;">Name:</span><br/>
                <span class="text-info" id="name"><?php echo $_SESSION['Name']; ?></span><br><br><br>
                <div class="studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">Email:</span><br/>
                    <span class="text-info" id="email"><?php echo $_SESSION['Email']; ?></span><br><br><br>
                </div>
            </div>
            <div class="studentInfo-text2">
                <div class="studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">House Number:</span><br/>
                    <span class="text-info" id="HouseNum"><?php echo $_SESSION['HouseNumber']; ?></span><br><br><br>
                </div>
                <div class="studentInfo-text">
                    <span class="text-label" style="font-weight: bold;">Gender:</span><br/>
                    <span class="text-info" id="Sex"><?php echo $_SESSION['Sex']; ?></span><br><br><br>
                </div>
            </div>
        </div>
        <!-- Table starts here -->
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Data-->
                <tr> 
                    <td>11/15/2023</td>
                    <td>1000000000</td>
                    <td>Unpaid</td>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="./php/logoutUser.php" class="logout-button">Logout</a>
</body>
</html>

