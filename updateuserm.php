<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "blood-bank";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_error) {
    die("Connection Failed " . $mysqli->connect_error);
}

// Form Variables
$donor_name = val($_POST["donor_name"]);
$mobile_no = val($_POST["mobile_no"]);
$bloodgroup = val($_POST["bloodgroup"]);
$age = val($_POST["age"]);
$gender = val($_POST["gender"]);
$address = val($_POST["address"]);
$city = val($_POST["city"]);
$donor_id = val($_POST["donor_id"]);

// validation

function val($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}




// Update Users table with new Values
$sql = "UPDATE donors SET donor_name='$donor_name', mobile_no='$mobile_no', bloodgroup='$bloodgroup', age='$age', gender='$gender', address='$address' WHERE donor_id='$donor_id'";

// Readirect to main page
if ($mysqli->query($sql) === TRUE) {
    header("location:updatea.php?message=success&id=" . $donor_id);
} else {
    echo "Error updating record " . $mysqli->error;
}


$mysqli->close();
