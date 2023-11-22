<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="shortcut icon" type="x-icon" href="./image/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <h2>Water Billing Management System</h2>
    <div class="login-block">
        <h1>Login</h1>
        <?php if(isset($_GET['error'])) {?>
                    <span><?php echo $_GET['error']; ?></span>
        <?php } ?>

        <form method="post" action="./php/actlogin.php">
            <input type="text" name="username" placeholder="Username" required>
            <div class="password-container">
                <input type="password" name="password" id="passwordField" placeholder="Password" required>
                <button type="button" id="togglePassword">
                    <i class="fas fa-eye-slash"></i>
                </button>
            </div>
            <button type="submit" class="login">Submit</button>
        </form>
        <br><p>Don't have an account? <a href="create_account.php">Create Account</a></p>
    </div>
    

</body>
</html>
