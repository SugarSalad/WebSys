<?php 

    //Login Credentials to XAMPP
    $sname = "localhost";
    $uname = "root";
    $password = "";

    //Database Name
    $dbName = "water";

    $conn = mysqli_connect($sname, $uname, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection Failed".$conn->connect_error);
    }

?>