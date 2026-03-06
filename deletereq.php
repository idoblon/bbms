<?php
require_once 'config.php';
require_once 'helpers.php';

$conn = getDBConnection();

$req_id = sanitizeInt(getGet('req_id'));

// Prepare statement to delete record
$stmt = $conn->prepare("DELETE FROM request WHERE req_id = ?");
$stmt->bind_param("i", $req_id);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
