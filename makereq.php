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

// Get inputs
$name = $_POST['name'] ?? '';
$bloodgroup = $_POST['bloodgroup'] ?? '';
$mobile_no = $_POST['mobile_no'] ?? '';
$requested_amount = $_POST['requested_amount'] ?? '';
$email = $_SESSION['email'] ?? '';

// Validate inputs
if (strlen($name) < 2) {
    echo 'Invalid name: Name should be at least 2 characters long.';
} elseif (strlen($bloodgroup) <= 3) {
    echo 'Invalid blood group: Blood group should be valid.';
} elseif (strlen($mobile_no) < 10) {
    echo 'Invalid mobile number: Mobile number should be at least 10 digits.';
} else {
    // Prepare statement
    $stmt = $mysqli->prepare("INSERT INTO request (name, bloodgroup, mobile_no, email, received, requested_amount) VALUES (?, ?, ?, ?, 0, ?)");
    $stmt->bind_param("ssssd", $name, $bloodgroup, $mobile_no, $email, $requested_amount);

    if ($stmt->execute()) {
        echo 'true';
    } else {
        echo 'Error: ' . $mysqli->error;
    }
    $stmt->close();
}

// Close the connection
$mysqli->close();
