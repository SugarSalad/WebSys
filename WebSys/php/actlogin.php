<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

class UserAuthenticator {
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

    public function authenticateUser($id, $password) {
        // Validate user input
        $id = $this->validateInput($id);
        $password = $this->validateInput($password);

        // Check if data is empty
        if (empty($id) || empty($password)) {
            return "Username and Password are required";
        }

        // Query for Student Role
        $sqlQuery = "CALL SP_GetAccount('$id', '$password')";

        // Execute the statement
        $result = $this->conn->query($sqlQuery);

        if (!$result) {
            // Handle query error
            die("Error executing the query: " . $this->conn->error);
        }

        // Fetch the user data
        $user = $result->fetch_assoc();

        if ($user) {
            // User authenticated, store session information
            $this->storeSession($user);

            // Check user level and return accordingly
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userAuthenticator = new UserAuthenticator($conn);

    // Validate user input and authenticate user
    $errorMessage = $userAuthenticator->authenticateUser($_POST['username'], $_POST['password']);

    if (strpos($errorMessage, '../') === 0) {
        // If the errorMessage starts with '../', it is a valid redirect path
        header("Location: " . $errorMessage);
        exit();
    } else {
        header("Location: ../index.php?error=" . $errorMessage);
        exit();
    }
}
?>
