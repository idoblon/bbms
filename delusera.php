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

// getting the domor_id from url name donor_id 
$donor_id = $_GET["donor_id"];

// sql to delete a record
$sql = "DELETE FROM donors WHERE donor_id='$donor_id'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
