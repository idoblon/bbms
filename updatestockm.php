<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "blood-bank";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_error) {
    die("Connection Failed " . $mysqli->connect_error);
}

// Check if the required POST variables are set
if (isset($_POST["bloodgroup"]) && isset($_POST["stock"]) && isset($_POST["stock_id"])) {
    // Form Variables
    $bloodgroup = $_POST["bloodgroup"];
    $stock = $_POST["stock"];
    $stock_id = $_POST["stock_id"];

    // validation
    function val($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Update Users table with new Values
    if ($stock >= 0) {
        $sql = "UPDATE stock SET bloodgroup='$bloodgroup', stock='$stock' WHERE stock_id='$stock_id'";

        // Readirect to main page
        if ($mysqli->query($sql) === TRUE) {
            header("location:adminstock.php?message=success&stock_id=" . $stock_id);
        } else {
            echo "Error updating record " . $mysqli->error;
        }
    } else {

        echo "Stock value cannot be less than zero.";
    }
} else {
    echo "Required POST variables are not set.";
}

$mysqli->close();
