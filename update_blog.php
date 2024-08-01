<?php
include 'db_connect.php'; // Include your database connection file

// Retrieve form data
$blog_id = $_POST['id'];
$author_id = $_POST['authorid'];
$author_name = $_POST['author_name'];
$title = $_POST['title'];
$meta_title = $_POST['meta_title'];
$summary = $_POST['summary'];
$content = $_POST['content'];
$content_1 = isset($_POST['content_1']) ? $_POST['content_1'] : null;
$content_2 = isset($_POST['content_2']) ? $_POST['content_2'] : null;
$content_3 = isset($_POST['content_3']) ? $_POST['content_3'] : null;
$publication_date = $_POST['publication_date'];
$category = $_POST['category'];
$tags = $_POST['tags'];
$status = $_POST['status'];
$comments_count = $_POST['comments_count'];
$meta_description = $_POST['meta_description'];
$meta_keywords = $_POST['meta_keywords'];
$canonical_url = $_POST['canonical_url'];
$subheading_1 = $_POST['subheading_1'];
$subheading_2 = $_POST['subheading_2'];
$subheading_3 = $_POST['subheading_3'];

// Prepare and execute SQL query
$sql = "UPDATE posts SET 
            author_id = ?, 
            author_name = ?, 
            title = ?, 
            meta_title = ?, 
            summary = ?, 
            content = ?, 
            content_1 = ?, 
            content_2 = ?, 
            content_3 = ?, 
            publication_date = ?, 
            category = ?, 
            tags = ?, 
            status = ?, 
            comments_count = ?, 
            meta_description = ?, 
            meta_keywords = ?, 
            canonical_url = ?, 
            subheading_1 = ?, 
            subheading_2 = ?, 
            subheading_3 = ? 
        WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param(
    "issssssssssssiisssssi",
    $author_id,
    $author_name,
    $title,
    $meta_title,
    $summary,
    $content,
    $content_1,
    $content_2,
    $content_3,
    $publication_date,
    $category,
    $tags,
    $status,
    $comments_count,
    $meta_description,
    $meta_keywords,
    $canonical_url,
    $subheading_1,
    $subheading_2,
    $subheading_3,
    $blog_id
);

if (!$stmt->execute()) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Close statement and connection
$stmt->close();
$conn->close();

// Redirect back to display page
header("Location: display_blogs.php");
exit();
