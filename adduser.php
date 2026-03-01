<?php
require_once 'config.php';
require_once 'session.php';
require_once 'helpers.php';

$mysqli = getDBConnection();

// Extract user input
$fname = sanitizeString(getPost('fname'));
$lname = sanitizeString(getPost('lname'));
$email = sanitizeEmail(getPost('email'));
$input_password = getPost('password');

// Validate user input
if (strlen($fname) < 2) {
    echo 'fname';
} elseif (strlen($lname) < 2) {
    echo 'lname';
} elseif (strlen($email) <= 4) {
    echo 'eshort';
} elseif (!validateEmail($email)) {
    echo 'eformat';
} elseif (strlen($input_password) < 4) {
    echo 'pshort';
} else {
    // Check if email already exists
    $check_stmt = $mysqli->prepare("SELECT mem_id FROM members WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo 'false';
        $check_stmt->close();
    } else {
        $check_stmt->close();
        
        // Hash the password
        $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

        // Prepare and bind the INSERT statement
        $stmt = $mysqli->prepare("INSERT INTO members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);

        // Execute the INSERT statement
        if ($stmt->execute()) {
            $_SESSION['login'] = $mysqli->insert_id;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            echo 'true';
        } else {
            echo 'error';
        }
        $stmt->close();
    }
}

// Close connection
$mysqli->close();
