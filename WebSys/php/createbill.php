<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

// BillCreator class for creating new bills
class BillCreator {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Function to validate and sanitize input data
    private function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to create a new bill
    public function createBill($name, $date, $amount, $status, $meter) {
        // Validate user input
        $name = $this->validate($name);
        $date = $this->validate($date);
        $amount = $this->validate($amount);
        $status = $this->validate($status);
        $meter = $this->validate($meter);

        // Check if any field is empty
        if (empty($name) || empty($date) || empty($amount) || empty($status) || empty($meter)) {
            return ['status' => 'error', 'message' => 'Missing values. Please fill in all fields.'];
        }

        // Call the stored procedure to get UserID based on the provided name
        $getUserIDQuery = "CALL SP_GetName('$name', @userID)";
        $userResult = $this->conn->query($getUserIDQuery);

        if ($userResult) {
            // Fetch the result of the stored procedure
            $userIDQuery = $this->conn->query("SELECT @userID as userID");
            $userData = $userIDQuery->fetch_assoc();

            if ($userData) {
                $userID = $userData['userID'];

                // Check if the user ID is valid
                if ($userID != null) {
                    // Call the stored procedure to create a new bill
                    $createBillQuery = "CALL SP_CreateBill($userID, '$date', $meter, $amount, '$status')";
                    $result = $this->conn->query($createBillQuery);

                    // Check if the query was successful
                    if ($result) {
                        return ['status' => 'success', 'message' => 'Bill created successfully.'];
                    } else {
                        return ['status' => 'error', 'message' => 'Error creating bill: ' . $this->conn->error];
                    }
                } else {
                    return ['status' => 'error', 'message' => 'User not found with the provided name.'];
                }
            } else {
                return ['status' => 'error', 'message' => 'Error fetching user data.'];
            }
        } else {
            return ['status' => 'error', 'message' => 'Error: ' . $this->conn->error];
        }
    }
}

// Create an instance of the BillCreator class
$billCreator = new BillCreator($conn);

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and create a new bill
    $result = $billCreator->createBill($_POST['name'], $_POST['date'], $_POST['amount'], $_POST['status'], $_POST['currentReading']);

    // Send a JSON response based on the result
    header('Content-Type: application/json');
    echo json_encode($result);
}
?>
