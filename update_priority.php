<?php
include 'db_connect.php';
include 'access_key.php';

$blog_id = $_GET['id'];
$priority = $_GET['priority'];
$access_key = $_GET['key'];

// Verify the access key
if ($access_key !== ACCESS_KEY) {
    echo "Error: Invalid access key.";
    exit();
}

// Update the priority of the blog
$sql = "UPDATE posts SET priority = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $priority, $blog_id);

if ($stmt->execute()) {
    echo "Priority updated successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect back to blog list
header("Location: display_blogs.php");
exit();

