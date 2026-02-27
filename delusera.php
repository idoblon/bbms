<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// getting the donor_id from url
$donor_id = $_GET["donor_id"] ?? '';

// Prepare statement to delete record
$stmt = $conn->prepare("DELETE FROM donors WHERE donor_id = ?");
$stmt->bind_param("i", $donor_id);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
