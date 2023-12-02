<?php

// Database Connection
require "./php/dbCon.php";
class AccountDisplay {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayAccounts() {
        $sqlQuery = "CALL SP_DisplayAccount();";
        $result = $this->conn->query($sqlQuery);

        if (!$result) {
            // Handle query error
            die("Error executing the query: " . $this->conn->error);
        }

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

        return $data;
    }
}


// Create an instance of the AccountDisplay class
$accountDisplay = new AccountDisplay($conn);

// Fetch data from the database using the stored procedure
$data = $accountDisplay->displayAccounts();
?>
