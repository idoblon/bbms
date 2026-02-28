<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "blood-bank";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_error) {
    die("Connection Failed " . $mysqli->connect_error);
}

// Get form variables
$donor_name = $_POST["donor_name"] ?? '';
$mobile_no = $_POST["mobile_no"] ?? '';
$bloodgroup = $_POST["bloodgroup"] ?? '';
$age = $_POST["age"] ?? '';
$gender = $_POST["gender"] ?? '';
$address = $_POST["address"] ?? '';
$city = $_POST["city"] ?? '';
$donor_id = $_POST["donor_id"] ?? '';

// Prepare statement to update donor
$stmt = $mysqli->prepare("UPDATE donors SET donor_name = ?, mobile_no = ?, bloodgroup = ?, age = ?, gender = ?, address = ?, city = ? WHERE donor_id = ?");
$stmt->bind_param("sssisssi", $donor_name, $mobile_no, $bloodgroup, $age, $gender, $address, $city, $donor_id);

if ($stmt->execute()) {
    header("location:updatea.php?message=success&id=" . urlencode($donor_id));
    exit;
} else {
    echo "Error updating record " . $mysqli->error;
}

$stmt->close();
$mysqli->close();
