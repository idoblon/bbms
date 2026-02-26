<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get user input
$email = $_POST['email'] ?? '';
$input_password = $_POST['password'] ?? '';

// Prepare and execute SQL statement
$query = "SELECT mem_id, fname, lname, email, password FROM members WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($input_password, $row['password'])) {
        $_SESSION['login'] = $row['mem_id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}

$stmt->close();
$mysqli->close();
