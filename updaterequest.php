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

$req_id = $_GET["req_id"] ?? '';
$bloodgroup = $_GET["bloodgroup"] ?? '';

// Begin transaction
$conn->begin_transaction();

try {
    // Retrieve the email associated with the req_id
    $stmt1 = $conn->prepare("SELECT email FROM request WHERE req_id = ?");
    $stmt1->bind_param("i", $req_id);
    $stmt1->execute();
    $result = $stmt1->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $stmt1->close();

        // Update stock table: decrease stock for the given blood group
        $stmt2 = $conn->prepare("UPDATE stock SET unit = unit - 1 WHERE bloodgroup = ?");
        $stmt2->bind_param("s", $bloodgroup);
        $stmt2->execute();
        $stmt2->close();

        // Update request table: mark as received
        $stmt3 = $conn->prepare("UPDATE request SET received = 1 WHERE req_id = ? AND email = ?");
        $stmt3->bind_param("is", $req_id, $email);
        $stmt3->execute();
        $stmt3->close();

        // Commit transaction
        $conn->commit();
        header("Location: adminhome.php");
        exit;
    } else {
        throw new Exception("No record found with the given req_id.");
    }
} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
