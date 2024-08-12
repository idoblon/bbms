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

// Get user input
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute query
$query = "SELECT mem_id, fname, lname, email, password FROM members WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($mem_id, $fname, $lname, $email, $hashed_password);
$stmt->fetch();

// Check if user exists and verify password
if ($mem_id) {
    if (password_verify($password, $hashed_password)) {
        $_SESSION['login'] = $mem_id;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;

        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}

// Close statement and connection
$stmt->close();
$mysqli->close();
?>
