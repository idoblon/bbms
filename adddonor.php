<?php
require_once 'config.php';
require_once 'session.php';
require_once 'helpers.php';

$mysqli = getDBConnection();

// Get and sanitize user inputs
$donor_name = sanitizeString(getPost('donor_name'));
$bloodgroup = getPost('bloodgroup');
$mobile_no = getPost('mobile_no');
$age = sanitizeInt(getPost('age'));
$gender = getPost('gender');
$city = sanitizeString(getPost('city'));
$address = sanitizeString(getPost('address'));

// Validate input
if (strlen($donor_name) < 2) {
    echo 'name';
} elseif (!validateBloodGroup($bloodgroup)) {
    echo 'bg';
} elseif (!validatePhone($mobile_no)) {
    echo 'mob';
} else {
    // Begin transaction
    $mysqli->begin_transaction();
    
    try {
        // Insert donor using prepared statement
        $query = "INSERT INTO donors(donor_name, mobile_no, bloodgroup, age, gender, city, address) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssssss", $donor_name, $mobile_no, $bloodgroup, $age, $gender, $city, $address);
        $stmt->execute();
        $stmt->close();

        // Update stock using prepared statement
        $sql = "UPDATE stock SET unit = unit + 1 WHERE bloodgroup = ?";
        $stmt2 = $mysqli->prepare($sql);
        $stmt2->bind_param("s", $bloodgroup);
        $stmt2->execute();
        $stmt2->close();

        // Commit transaction
        $mysqli->commit();
        echo "true";
    } catch (Exception $e) {
        // Rollback on error
        $mysqli->rollback();
        echo "Error: " . $e->getMessage();
    }
}

// Close connection
$mysqli->close();
