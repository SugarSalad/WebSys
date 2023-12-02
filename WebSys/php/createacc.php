<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

class AccountCreator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function createAccount($username, $password, $name, $houseNo, $gender, $email) {
        // Validate user input
        $username = $this->validateInput($username);
        $password = $this->validateInput($password);
        $name = $this->validateInput($name);
        $houseNo = $this->validateInput($houseNo);
        $gender = $this->validateInput($gender);
        $email = $this->validateInput($email);

        // Check if data is empty
        if (empty($username) || empty($password) || empty($name) || empty($houseNo) || empty($gender) || empty($email)) {
            return "Missing values. Please fill in all fields.";
        } else {
            // Call the stored procedure to create the account
            $createAccountQuery = "CALL SP_CreateAccount('$username', '$password', 'User', '$name', '$houseNo', '$gender', '$email')";
            $result = $this->conn->query($createAccountQuery);

            if ($result) {
                // Set a session variable to indicate success
                $_SESSION['success_message'] = "Account created successfully.";
                return true;
            } else {
                // Return an error message
                return "Error: " . $this->conn->error;
            }
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountCreator = new AccountCreator($conn);

    // Validate user input and create account
    $errorMessage = $accountCreator->createAccount(
        $_POST['username'],
        $_POST['password'],
        $_POST['name'],
        $_POST['houseNo'],
        $_POST['gender'],
        $_POST['email']
    );

    if ($errorMessage === true) {
        ?>
        <script>
            alert('Account created successfully.');
            window.location.href = "../index.php"; // Redirect after displaying the alert
        </script>
        <?php
        exit();
    } else {
        // Redirect to registration page with an error message
        header("Location: ../create_account.php?error=$errorMessage");
        exit();
    }
} else {
    // Redirect to registration page if form is not submitted
    header("Location: ../create_account.php");
    exit();
}
?>
