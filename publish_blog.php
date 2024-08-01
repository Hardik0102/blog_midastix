<?php
include 'db_connect.php';
include 'access_key.php';

$blog_id = $_GET['id'];
$access_key = $_GET['key'];

// Verify the access key
if ($access_key !== ACCESS_KEY) {
    echo "Error: Invalid access key.";
    exit();
}

// Update the blog status to published and set priority
$sql = "UPDATE posts SET status = 'published', priority = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blog_id);

if ($stmt->execute()) {
    echo "Blog published successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect back to blog list
header("Location: display_blogs.php");
exit();

