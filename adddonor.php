<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user inputs
$donor_name = $_POST['donor_name'] ?? '';
$bloodgroup = $_POST['bloodgroup'] ?? '';
$mobile_no = $_POST['mobile_no'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$city = $_POST['city'] ?? '';
$address = $_POST['address'] ?? '';

// Validate input
if (strlen($donor_name) < 2) {
    echo 'name';
} elseif (strlen($bloodgroup) <= 3) {
    echo 'bg';
} elseif (strlen($mobile_no) < 10) {
    echo 'mob';
} else {
    // Begin transaction
    $mysqli->begin_transaction();
    
    try {
        // Insert donor using prepared statement
        $query = "INSERT INTO donors(donor_name, mobile_no, bloodgroup, age, gender, city, address) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssssss", $donor_name, $mobile_no, $bloodgroup, $age, $gender, $city, $address);
        $stmt->execute();
        $stmt->close();

        // Update stock using prepared statement
        $sql = "UPDATE stock SET unit = unit + 1 WHERE bloodgroup = ?";
        $stmt2 = $mysqli->prepare($sql);
        $stmt2->bind_param("s", $bloodgroup);
        $stmt2->execute();
        $stmt2->close();

        // Commit transaction
        $mysqli->commit();
        echo "true";
    } catch (Exception $e) {
        // Rollback on error
        $mysqli->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Close connection
$mysqli->close();
