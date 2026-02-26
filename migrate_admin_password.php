<?php
// Run this script ONCE to migrate admin password from plain text to hashed
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood-bank";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get all admins with plain text passwords
$query = "SELECT admin_id, password FROM admins";
$result = $mysqli->query($query);

$updated = 0;
while ($row = $result->fetch_assoc()) {
    // Check if password is already hashed (bcrypt hashes start with $2y$)
    if (substr($row['password'], 0, 4) !== '$2y$') {
        $hashed = password_hash($row['password'], PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("UPDATE admins SET password = ? WHERE admin_id = ?");
        $stmt->bind_param("si", $hashed, $row['admin_id']);
        $stmt->execute();
        $stmt->close();
        $updated++;
    }
}

echo "Migration complete. Updated $updated admin password(s).\n";
echo "You can now delete this file for security.\n";

$mysqli->close();
