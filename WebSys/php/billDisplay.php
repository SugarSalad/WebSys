<?php
// Database Connection
require "./php/dbCon.php";

class AdminBillDisplay {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayBills() {
        $data = array(); // Initialize as an empty array

        // Query to call the SP_DisplayBill stored procedure
        $sqlQuery = "CALL SP_DisplayBill();";

        // Execute the statement
        $result = $this->conn->query($sqlQuery);

        if (!$result) {
            // Handle query error
            die("Error executing the query: " . $this->conn->error);
        }

        // Fetch the data
        while ($row = $result->fetch_assoc()) {
            $row = $this->formatRow($row);

            $data[] = array(
                'BillID' => isset($row['BillID']) ? $row['BillID'] : '',
                'Name' => isset($row['Name']) ? $row['Name'] : '',
                'HouseNumber' => isset($row['HouseNumber']) ? $row['HouseNumber'] : '',
                'Meter' => isset($row['Meter']) ? $row['Meter'] : '',
                'Date' => isset($row['Date']) ? $row['Date'] : '',
                'Amount' => isset($row['Amount']) ? $row['Amount'] : '',
                'Status' => isset($row['Status']) ? $row['Status'] : '',
            );
        }

        return $data;
    }

    private function formatRow($row) {
        // Format the amount with peso sign and commas
        $row['Amount'] = '₱' . number_format($row['Amount'], 2);

        // Add a comma for meter when it reaches 4 digits
        $row['Meter'] = number_format($row['Meter'], 2);

        return $row;
    }
}

// Create an instance of the BillDisplay class
$billDisplay = new AdminBillDisplay($conn);

// Fetch data using the displayBills method
$data = $billDisplay->displayBills();
?>
