<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

// AccountCreator class for creating new user accounts
class AccountCreator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Function to validate input data
    public function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to create a new user account
    public function createAccount($username, $password, $name, $houseNo, $gender, $email) {
        // Validate user input to prevent attacks
        $username = $this->validateInput($username);
        $password = $this->validateInput($password);
        $name = $this->validateInput($name);
        $houseNo = $this->validateInput($houseNo);
        $gender = $this->validateInput($gender);
        $email = $this->validateInput($email);

        // Check if any field is empty
        if (empty($username) || empty($password) || empty($name) || empty($houseNo) || empty($gender) || empty($email)) {
            return "Missing values. Please fill in all fields.";
        } else {
            // Call the stored procedure to create the account
            $createAccountQuery = "CALL SP_CreateAccount('$username', '$password', 'User', '$name', '$houseNo', '$gender', '$email')";
            $result = $this->conn->query($createAccountQuery);

            if ($result) {
                // Set a session variable to indicate successful account creation
                $_SESSION['success_message'] = "Account created successfully.";
                return true; // Return true for successful creation
            } else {
                // Return an error message if account creation fails
                return "Error: " . $this->conn->error;
            }
        }
    }
}

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountCreator = new AccountCreator($conn);

    // Validate user input and attempt to create the account
    $errorMessage = $accountCreator->createAccount(
        $_POST['username'],
        $_POST['password'],
        $_POST['name'],
        $_POST['houseNo'],
        $_POST['gender'],
        $_POST['email']
    );

    // Handle success or error messages after account creation
    if ($errorMessage === true) {
        // If account creation is successful, display an alert and redirect
        ?>
        <script>
            alert('Account created successfully.');
            window.location.href = "../index.php"; // Redirect after displaying the alert
        </script>
        <?php
        exit(); // Stop further execution
    } else {
        // If there's an error during account creation, redirect with an error message
        header("Location: ../create_account.php?error=$errorMessage");
        exit();
    }
} else {
    // Redirect to the registration page if the form is not submitted
    header("Location: ../create_account.php");
    exit();
}
?>
