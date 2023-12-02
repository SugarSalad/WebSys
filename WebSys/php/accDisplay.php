<?php

// Database Connection
require "./php/dbCon.php";

// AccountDisplay class for handling account data display
class AccountDisplay {
    private $conn;

    // Constructor to initialize the connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to display accounts fetched from the database
    public function displayAccounts() {
        // SQL query to call the stored procedure
        $sqlQuery = "CALL SP_DisplayAccount();";
        $result = $this->conn->query($sqlQuery);

        // Check if the query execution encountered an error
        if (!$result) {
            // Handle query error
            die("Error executing the query: " . $this->conn->error);
        }

        // Fetching data and storing it in an array
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = array(
                'UserID' => isset($row['UserID']) ? $row['UserID'] : '',
                'Name' => isset($row['Name']) ? $row['Name'] : '',
                'HouseNumber' => isset($row['HouseNumber']) ? $row['HouseNumber'] : '',
                'Sex' => isset($row['Sex']) ? $row['Sex'] : '',
                'Email' => isset($row['Email']) ? $row['Email'] : '',
                'Username' => isset($row['Username']) ? $row['Username'] : '',
                'Password' => isset($row['Password']) ? $row['Password'] : '',
                'Level' => isset($row['Level']) ? $row['Level'] : '',
            );
        }

        return $data; // Return the fetched data
    }
}

// Create an instance of the AccountDisplay class with the database connection
$accountDisplay = new AccountDisplay($conn);

// Fetch data from the database using the stored procedure
$data = $accountDisplay->displayAccounts();
?>
