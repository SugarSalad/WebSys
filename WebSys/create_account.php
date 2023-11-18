<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/create_account.css">
    <script src="./js/createacc.js"></script>
</head>
<body>
    <h2>Water Billing Management System</h2>
    <div class="regAcc-block">
        <h1>Register Account</h1>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
        ?>
        <form id="registrationForm" method="post" action="./php/createacc.php">
            <input type="text" name="username" placeholder="Username" required>
            <div class="password-container">
                <input type="password" name="password" id="passwordField" placeholder="Password" required>
                <button type="button" id="togglePassword">
                    <i class="fas fa-eye-slash"></i>
                </button>
            </div>

            <h3>User Information</h3>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="houseNo" placeholder="House Number" required>
            <label type="gender">Gender:</label>
            <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            </select><br><br>
            <input type="text" name="email" placeholder="Email Address" required>
            <button type="submit" class="submit">Submit</button><br><br>
            <button type="button" class="close-btn" onclick="closeForm()">Exit</button>
        </form>
    </div>

    <script>
        var passwordField = document.getElementById("passwordField");
        var togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordField.type = "password";
                togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });

        function closeForm() {
            var form = document.getElementById("registrationForm");
            form.style.display = "none";
            window.location.href = "index.php"; // Redirects to index.php after form closure
            alert('Closing form...');
        }
    </script>


<?php
session_start();

// Check if the success message is set in the session
if (isset($_SESSION['success_message'])) {
    // Display JavaScript popup message
    $successMessage = $_SESSION['success_message'];
    echo "<script>
            // Call the displaySuccessMessage function from the separate JavaScript file
            displaySuccessMessage('$successMessage');
          </script>";

    // Unset the session variable to clear the message after displaying it
    unset($_SESSION['success_message']);
}
?>



</body>
</html>
