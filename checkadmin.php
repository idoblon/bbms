<?php
require_once 'config.php';
require_once 'session.php';
require_once 'helpers.php';

$mysqli = getDBConnection();

// Get user input
$email = sanitizeEmail(getPost('email'));
$input_password = getPost('password');

// Prepare and execute SQL statement
$query = "SELECT admin_id, fname, lname, password FROM admins WHERE email = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify password (supports both hashed and plain text for migration)
    if (password_verify($input_password, $row['password']) || $input_password === $row['password']) {
        $_SESSION['login'] = $row['admin_id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'false';
}

$stmt->close();
$mysqli->close();
