<?php
// Database Connection
require "./php/dbCon.php";

// AdminBillDisplay class to handle displaying bills for admin
class AdminBillDisplay {
    private $conn;

    // Constructor to set the database connection
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to fetch and format bill data for display
    public function displayBills() {
        $data = array(); // Initialize as an empty array to store fetched data

        // SQL query to call the SP_DisplayBill stored procedure
        $sqlQuery = "CALL SP_DisplayBill();";

        // Execute the SQL statement
        $result = $this->conn->query($sqlQuery);

        // Check for query execution errors
        if (!$result) {
            // Handle query error
            die("Error executing the query: " . $this->conn->error);
        }

        // Fetch and format each row of data
        while ($row = $result->fetch_assoc()) {
            // Format specific fields in each row using the formatRow method
            $row = $this->formatRow($row);

            // Store formatted row data in the $data array
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

        return $data; // Return the fetched and formatted data
    }

    // Method to format specific fields in a row of data
    private function formatRow($row) {
        // Format the 'Amount' field with peso sign (₱) and commas for better readability
        $row['Amount'] = '₱' . number_format($row['Amount'], 2);

        // Add commas for better readability in 'Meter' field when it reaches 4 digits
        $row['Meter'] = number_format($row['Meter'], 2);

        return $row; // Return the formatted row
    }
}

// Create an instance of the AdminBillDisplay class with the database connection
$billDisplay = new AdminBillDisplay($conn);

// Fetch and format data using the displayBills method
$data = $billDisplay->displayBills();
?>
