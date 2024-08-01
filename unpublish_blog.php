<?php
include 'db_connect.php'; 
include 'access_key.php'; 

// Retrieve blog ID and access key from URL
$blog_id = $_GET['id'];
$access_key = $_GET['key'];

// Verify the access key
if ($access_key !== ACCESS_KEY) {
    echo "Error: Invalid access key.";
    exit();
}

// Update blog status to 'unpublished'
$sql = "UPDATE posts SET status = 'unpublished' WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("i", $blog_id);

if (!$stmt->execute()) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect back to blog list
header("Location: display_blogs.php");
exit();

