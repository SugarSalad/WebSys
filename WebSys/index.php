<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png"> <!-- Favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="./css/login.css"> <!-- Custom CSS for login page -->
</head>
<body>
    <h2>Water Billing Management System</h2> <!-- Title or heading -->
    <div class="login-block">
        <h1>Login</h1> <!-- Login heading -->
        <?php if(isset($_GET['error'])) {?>
            <!-- Display error message if present in the URL query parameters -->
            <span><?php echo $_GET['error']; ?></span>
        <?php } ?>

        <form method="post" action="./php/actlogin.php"> <!-- Login form -->
            <input type="text" name="username" placeholder="Username" required> <!-- Input field for username -->
            <div class="password-container">
                <input type="password" name="password" id="passwordField" placeholder="Password" required> <!-- Input field for password -->
                <button type="button" id="togglePassword">
                    <i class="fas fa-eye-slash"></i> <!-- Button to toggle password visibility -->
                </button>
            </div>
            <button type="submit" class="login">Submit</button> <!-- Submit button for login -->
        </form>
        <br>
        <p>Don't have an account? <a href="create_account.php">Create Account</a></p> <!-- Link to create an account -->
    </div>
</body>
</html>
