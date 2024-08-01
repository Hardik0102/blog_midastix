<?php
// Start session
session_start();

// Include database connection
include 'db_connect.php';

// Define the correct access key
define('ACCESS_KEY', '11112');

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$access_key = $_POST['access_key'];

// Verify the access key
if ($access_key !== ACCESS_KEY) {
    echo "Error: Invalid access key.";
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL injection prevention with prepared statements
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    // User registered successfully, redirect to login page
    header('Location: login.php');
} else {
    // Error occurred, display error message
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
