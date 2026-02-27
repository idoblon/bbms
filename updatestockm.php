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
    $bloodgroup = $_POST["bloodgroup"];
    $stock = $_POST["stock"];
    $stock_id = $_POST["stock_id"];

    // Validation: stock must be non-negative
    if ($stock >= 0) {
        // Prepare statement to update stock
        $stmt = $mysqli->prepare("UPDATE stock SET unit = ? WHERE stock_id = ?");
        $stmt->bind_param("ii", $stock, $stock_id);

        if ($stmt->execute()) {
            header("location:adminstock.php?message=success&stock_id=" . urlencode($stock_id));
            exit;
        } else {
            echo "Error updating record " . $mysqli->error;
        }
        $stmt->close();
    } else {
        echo "Stock value cannot be less than zero.";
    }
} else {
    echo "Required POST variables are not set.";
}

$mysqli->close();
