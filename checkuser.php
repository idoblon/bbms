<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";

// create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

if (!$mysqli) {
    die("Connection  failed: " . mysqli_connect_error());
}
// target the di/name from input section
$email = $_POST['email'];
$password = $_POST['password'];

// fetching every data from the memners where email is from user input email
$query = "SELECT * FROM members WHERE email = '$email'";
$result = mysqli_query($mysqli, $query) or die($mysqli_error());
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

// conditon checking if the data is fouund or not 
if ($num_row >= 1) {
    if (password_verify($password, $row['password'])) {
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
