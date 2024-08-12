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

// Extract user input
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate user input
if (strlen($fname) < 2) {
    echo 'First name must be at least 2 characters';
} elseif (strlen($lname) < 2) {
    echo 'Last name must be at least 2 characters';
} elseif (strlen($email) <= 4) {
    echo 'Email address is too short';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'Invalid email format';
} elseif (strlen($password) <= 4) {
    echo 'Password must be at least 4 characters';
} else {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and bind the INSERT statement
    $stmt = $mysqli->prepare("INSERT INTO members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);

    // Execute the INSERT statement
    if ($stmt->execute()) {
        // Registration successful
        $_SESSION['login'] = $mysqli->insert_id;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        echo 'true';
    } else {
        // Registration failed
        echo 'Error processing request. Please try again.';
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
