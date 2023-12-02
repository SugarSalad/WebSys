<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

// UserAuthenticator class for user authentication and session handling
class UserAuthenticator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Function to validate input data (prevent SQL injection and XSS attacks)
    public function validateInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to authenticate user credentials
    public function authenticateUser($id, $password) {
        // Validate user input to prevent attacks
        $id = $this->validateInput($id);
        $password = $this->validateInput($password);

        // Check if username or password is empty
        if (empty($id) || empty($password)) {
            return "Username and Password are required";
        }

        // Query to fetch user data based on provided credentials
        $sqlQuery = "CALL SP_GetAccount('$id', '$password')";

        // Execute the SQL statement
        $result = $this->conn->query($sqlQuery);

        // Check for query execution error
        if (!$result) {
            // Handle query error
            die("Error executing the query: " . $this->conn->error);
        }

        // Fetch the user data
        $user = $result->fetch_assoc();

        if ($user) {
            // User authenticated, store session information
            $this->storeSession($user);

            // Check user level and return redirection path based on the user role
            if ($user['Level'] === 'User') {
                return "../UserForm.php";
            } elseif ($user['Level'] === 'Admin') {
                return "../Dashboard.php";
            } else {
                return "Invalid user level.";
            }
        } else {
            return "Incorrect Username or Password";
        }
    }

    // Function to store user information in session variables
    private function storeSession($user) {
        $_SESSION['AccountID'] = $user['AccountID'];
        $_SESSION['UserID'] = $user['UserID'];
        $_SESSION['Username'] = $user['Username'];
        $_SESSION['Password'] = $user['Password'];
        $_SESSION['Level'] = $user['Level'];
        $_SESSION['Name'] = $user['Name'];
        $_SESSION['HouseNumber'] = $user['HouseNumber'];
        $_SESSION['Sex'] = $user['Sex'];
        $_SESSION['Email'] = $user['Email'];
    }
}

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userAuthenticator = new UserAuthenticator($conn);

    // Validate user input and authenticate user
    $errorMessage = $userAuthenticator->authenticateUser($_POST['username'], $_POST['password']);

    // Redirect the user based on authentication result or display an error message
    if (strpos($errorMessage, '../') === 0) {
        // If the errorMessage starts with '../', it is a valid redirect path
        header("Location: " . $errorMessage);
        exit();
    } else {
        // Redirect to the index.php page with an error message as a query parameter
        header("Location: ../index.php?error=" . $errorMessage);
        exit();
    }
}
?>
