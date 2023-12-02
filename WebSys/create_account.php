<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png"> <!-- Link to the favicon -->
    <title>Register Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Linking Font Awesome for icons -->
    <link rel="stylesheet" href="./css/create_account.css"> <!-- Linking a custom CSS file -->
</head>
<body>
    
    <div class="regAcc-block">
        <h1>Register Account</h1>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>'; // Displaying an error message if it exists
        }
        ?>
        <form id="registrationForm" method="post" action="./php/createacc.php"> <!-- Form for account registration -->
            <input type="text" name="username" placeholder="Username" required> <!-- Input for username -->
            <div class="password-container">
                <input type="password" name="password" id="passwordField" placeholder="Password" required> <!-- Input for password -->
                <button type="button" id="togglePassword">
                    <i class="fas fa-eye-slash"></i> <!-- Button to toggle password visibility -->
                </button>
            </div>

            <h3>User Information</h3>
            <input type="text" name="name" placeholder="Full Name" required> <!-- Input for full name -->
            <input type="text" name="houseNo" placeholder="House Number" required> <!-- Input for house number -->
            <label type="gender">Gender:</label>
            <select id="gender" name="gender" required> <!-- Dropdown for selecting gender -->
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br><br>
            <input type="text" name="email" placeholder="Email Address" required> <!-- Input for email -->
            <button type="submit" class="submit">Submit</button><br><br> <!-- Submit button -->
            <button type="button" class="close-btn" onclick="closeForm()">Exit</button> <!-- Button to close the form -->
        </form>
    </div>

    <script>
        var passwordField = document.getElementById("passwordField");
        var togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {
            if (passwordField.type === "password") {
                passwordField.type = "text";
                togglePassword.innerHTML = '<i class="fas fa-eye"></i>'; // Change icon to show password
            } else {
                passwordField.type = "password";
                togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Change icon to hide password
            }
        });

        function closeForm() {
            var form = document.getElementById("registrationForm");
            form.style.display = "none"; // Hide the form
            window.location.href = "index.php"; // Redirects to index.php after form closure
            alert('Closing form...'); // Display an alert when closing the form
        }
    </script>
</body>
</html>
