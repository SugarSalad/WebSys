<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

class AccountUpdater {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    private function validate($data) {
        // Function to sanitize and validate input data
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function updateAccount($id, $username, $password, $level, $name, $housenum, $sex, $email) {
        // Validate and sanitize input data
        $id = $this->validate($id);
        $username = $this->validate($username);
        $password = $this->validate($password);
        $level = $this->validate($level);
        $name = $this->validate($name);
        $housenum = $this->validate($housenum);
        $sex = $this->validate($sex);
        $email = $this->validate($email);

        // Check for missing values
        if (empty($id) || empty($username) || empty($password) || empty($level) || empty($name) || empty($housenum) || empty($sex) || empty($email)) {
            return ['status' => 'error', 'message' => 'Missing values. Please fill in all fields.'];
        } else {
            // SQL query to update the account using a stored procedure
            $updateAccountQuery = "CALL SP_UpdateAccount($id, '$username', '$password', '$level', '$name', '$housenum', '$sex', '$email')";

            // Execute the query
            $result = $this->conn->query($updateAccountQuery);

            // Check if the query was successful
            if ($result) {
                return 'Account updated successfully.';
            } else {
                return 'Error: ' . $this->conn->error;
            }
        }
    }
}

// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance of AccountUpdater class
    $accountUpdater = new AccountUpdater($conn);

    // Call updateAccount method with provided POST data
    $result = $accountUpdater->updateAccount(
        $_POST['userID'],
        $_POST['uname'],
        $_POST['password'],
        $_POST['level'],
        $_POST['name'],
        $_POST['houseNumber'],
        $_POST['gender'],
        $_POST['emailAdd']
    );

    // Check if the result is an array or plain text and set appropriate content type for response
    if (is_array($result)) {
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        header('Content-Type: text/plain');
        echo $result;
    }
}

// Close the database connection
$conn->close();
?>
