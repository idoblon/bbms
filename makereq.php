<?php
require_once 'config.php';
require_once 'session.php';
require_once 'helpers.php';

$mysqli = getDBConnection();

// Get and sanitize inputs
$name = sanitizeString(getPost('name'));
$bloodgroup = getPost('bloodgroup');
$mobile_no = getPost('mobile_no');
$requested_amount = sanitizeInt(getPost('requested_amount'));
$email = $_SESSION['email'] ?? '';

// Validate inputs
if (strlen($name) < 2) {
    echo 'Invalid name: Name should be at least 2 characters long.';
} elseif (!validateBloodGroup($bloodgroup)) {
    echo 'Invalid blood group: Blood group should be valid.';
} elseif (!validatePhone($mobile_no)) {
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
