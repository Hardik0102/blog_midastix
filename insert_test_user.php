<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';  


$username = '';
$password = password_hash('aa', PASSWORD_DEFAULT);  


$stmt = $conn->prepare("INSERT INTO users (user, password) VALUES (?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ss", $username, $password);

// Execute the statement
if ($stmt->execute()) {
    echo "Test user inserted successfully.<br>";
} else {
    echo "Error: " . $stmt->error . "<br>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
