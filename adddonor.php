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

// Escape user inputs for security
$donor_name = $mysqli->real_escape_string($_POST['donor_name']);
$bloodgroup = $mysqli->real_escape_string($_POST['bloodgroup']);
$mobile_no = $mysqli->real_escape_string($_POST['mobile_no']);
$age = $mysqli->real_escape_string($_POST['age']);
$gender = $mysqli->real_escape_string($_POST['gender']);
$city = $mysqli->real_escape_string($_POST['city']);
$address = $mysqli->real_escape_string($_POST['address']);

// Validate input
if (strlen($donor_name) < 2) {
    echo 'name';
} elseif (strlen($bloodgroup) <= 3) {
    echo 'bg';
} elseif (strlen($mobile_no) < 10) {
    echo 'mob';
} else {
    
    // SQL to insert values
    $query = "INSERT INTO donors(donor_name, mobile_no, bloodgroup, age, gender, city, address) 
              VALUES ('$donor_name','$mobile_no','$bloodgroup','$age','$gender','$city','$address')";

    // SQL to update stock
    $sql = "UPDATE stock SET unit = unit + 1 WHERE bloodgroup = '$bloodgroup'";

    // Execute queries
    $insert_row = $mysqli->query($query);
    $update_stock = $mysqli->query($sql);

    if ($insert_row && $update_stock) {
        echo "true";
    } else {
        if (!$insert_row) {
            echo "Error with INSERT query: " . $mysqli->error;
        } elseif (!$update_stock) {
            echo "Error with UPDATE query: " . $mysqli->error;
        }
    }
}

// Close connection
$mysqli->close();
