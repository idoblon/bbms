<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$req_id = $_GET["req_id"];
$bloodgroup = $_GET["bloodgroup"];

// Retrieve the email associated with the req_id
$sql_email = "SELECT email FROM request WHERE req_id = '$req_id'";
$result = $conn->query($sql_email);


if ($result->num_rows > 0) {
    // Fetch the email from the result
    $row = $result->fetch_assoc();
    $email = $row["email"];
    // Update stock table: decrease stock for the given blood group
    $sql = "UPDATE stock SET stock = stock - 1 WHERE bloodgroup = '$bloodgroup'";
    // Execute the stock update query
    if ($conn->query($sql) === TRUE) {
        $sql2 = "UPDATE request SET received = 1 WHERE req_id = '$req_id' AND email = '$email'";
        if ($conn->query($sql2) === TRUE) {
            echo "Successfully accepted and updated stock.";
            // Redirect to adminhome.php
            header("Location: adminhome.php");
            exit(); // Ensure script stops executing after redirection
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error updating stock: " . $conn->error;
    }
} else {
    echo "Error: No record found with the given req_id.";
}

$conn->close();
