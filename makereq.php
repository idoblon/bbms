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

// Prepare and sanitize inputs
$name = $mysqli->real_escape_string($_POST['name']);
$bloodgroup = $mysqli->real_escape_string($_POST['bloodgroup']);
$mobile_no = $mysqli->real_escape_string($_POST['mobile_no']);
$requested_amount = $mysqli->real_escape_string($_POST['requested_amount']);
$received = 0;
$email = $_SESSION['email'];

// Validate inputs
if (strlen($name) < 2) {
    echo 'Invalid name: Name should be at least 2 characters long.';
} elseif (strlen($bloodgroup) <= 3) {
    echo 'Invalid blood group: Blood group should be valid.';
} elseif (strlen($mobile_no) < 10) {
    echo 'Invalid mobile number: Mobile number should be at least 10 digits.';
} else {
    // Prepare the SQL statement
    $query = "INSERT INTO request (name, bloodgroup, mobile_no, email, received, requested_amount) VALUES ('$name', '$bloodgroup', '$mobile_no', '$email', '$received', '$requested_amount')";

    // Execute the query and check for errors
    if ($mysqli->query($query) === TRUE) {
        echo 'true';
    } else {
        echo 'Error: ' . $query . '<br>' . $mysqli->error;
    }
}

// Close the connection
$mysqli->close();
