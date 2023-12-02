<?php
// Start Session
session_start();

// Database Connection
require "dbCon.php";

class BillUpdater {
    private $conn;
    private $updateResult; // Store the update result message

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function updateBill($billId, $name, $date, $amount, $status, $meter) {
        // Validation Method
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Validate user input
        $billId = validate($billId);
        $name = validate($name);
        $date = validate($date);
        $amount = validate($amount);
        $status = validate($status);
        $meter = validate($meter);

        // Check if data is empty
        if (empty($name) || empty($date) || empty($amount) || empty($status) || empty($meter)) {
            // Send a JSON response indicating missing values
            $this->updateResult = ['status' => 'error', 'message' => 'Missing values. Please fill in all fields.'];
        } else {
            // Call the stored procedure to get UserID based on the provided name
            $getUserIDQuery = "CALL SP_GetName('$name', @userID)";
            $userResult = $this->conn->query($getUserIDQuery);

            if ($userResult) {
                // Fetch the result of the stored procedure
                $userIDQuery = $this->conn->query("SELECT @userID as userID");
                $userData = $userIDQuery->fetch_assoc();

                if ($userData) {
                    $userID = $userData['userID'];

                    // Call the stored procedure to update the bill for the retrieved UserID
                    $updateBillQuery = "CALL SP_UpdateBill('$billId', $userID, '$date', $meter, $amount, '$status')";

                    $result = $this->conn->query($updateBillQuery);

                    // Check if the query was successful
                    if ($result) {
                        // Set the success message
                        $this->updateResult = ['status' => 'success', 'message' => 'Bill updated successfully.'];
                    } else {
                        // Set the error message and include the error message
                        $this->updateResult = ['status' => 'error', 'message' => 'Error: ' . $this->conn->error];
                    }
                } else {
                    // Set the error message for user not found
                    $this->updateResult = ['status' => 'error', 'message' => 'User not found with the provided name.'];
                }
            } else {
                // Set the error message for query failure
                $this->updateResult = ['status' => 'error', 'message' => 'Error: ' . $this->conn->error];
            }
        }
    }

    public function getUpdateResult() {
        // Retrieve the update result message
        return $this->updateResult;
    }
}

// Create an instance of the BillUpdater class
$billUpdater = new BillUpdater($conn);

// Check if the ID parameter is set in the POST request
if (isset($_POST['billId'])) {
    // Call the updateBill method
    $billUpdater->updateBill(
        $_POST['billId'],
        $_POST['name'],
        $_POST['date'],
        $_POST['amount'],
        $_POST['status'],
        $_POST['currentReading']
    );

    // Get the update result message
    $result = $billUpdater->getUpdateResult();

    // Send a JSON response with the update result
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    echo 'Invalid or missing ID parameter';
}

// Close the database connection
$conn->close();
?>
