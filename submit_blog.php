<?php
include 'db_connect.php'; // Include your database connection file

// Function to sanitize file name
function sanitizeFileName($filename) {
    // Remove any characters that are not alphanumeric, underscores, hyphens, or dots
    return preg_replace('/[^A-Za-z0-9_\-.]/', '_', $filename);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $author_id = $_POST['authorid'];
    $author_name = $_POST['author_name'];
    $title = $_POST['title'];
    $meta_title = $_POST['meta_title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $content_1 = $_POST['content_1'];
    $content_2 = $_POST['content_2'];
    $content_3 = $_POST['content_3'];
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
    $access_key = $_POST['access_key'];

    // Define the target directory for file uploads
    $target_dir = "uploads/";

    // Ensure the target directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Process the main image
    $main_image_url = '';
    if (!empty($_FILES['main_image_file']['name'])) {
        $main_image_name = sanitizeFileName($title) . "_main." . pathinfo($_FILES['main_image_file']['name'], PATHINFO_EXTENSION);
        $main_image_path = $target_dir . $main_image_name;
        if (move_uploaded_file($_FILES['main_image_file']['tmp_name'], $main_image_path)) {
            $main_image_url = $main_image_path;
        }
    }

    // Process image/video 1
    $image_video_1_url = '';
    if (!empty($_FILES['image_video_1_file']['name'])) {
        $image_video_1_name = sanitizeFileName($title) . "_1." . pathinfo($_FILES['image_video_1_file']['name'], PATHINFO_EXTENSION);
        $image_video_1_path = $target_dir . $image_video_1_name;
        if (move_uploaded_file($_FILES['image_video_1_file']['tmp_name'], $image_video_1_path)) {
            $image_video_1_url = $image_video_1_path;
        }
    }

    // Process image/video 2
    $image_video_2_url = '';
    if (!empty($_FILES['image_video_2_file']['name'])) {
        $image_video_2_name = sanitizeFileName($title) . "_2." . pathinfo($_FILES['image_video_2_file']['name'], PATHINFO_EXTENSION);
        $image_video_2_path = $target_dir . $image_video_2_name;
        if (move_uploaded_file($_FILES['image_video_2_file']['tmp_name'], $image_video_2_path)) {
            $image_video_2_url = $image_video_2_path;
        }
    }

    // Process image/video 3
    $image_video_3_url = '';
    if (!empty($_FILES['image_video_3_file']['name'])) {
        $image_video_3_name = sanitizeFileName($title) . "_3." . pathinfo($_FILES['image_video_3_file']['name'], PATHINFO_EXTENSION);
        $image_video_3_path = $target_dir . $image_video_3_name;
        if (move_uploaded_file($_FILES['image_video_3_file']['tmp_name'], $image_video_3_path)) {
            $image_video_3_url = $image_video_3_path;
        }
    }

    $sql = "INSERT INTO posts (author_id, author_name, title, meta_title, summary, content, content_1, content_2, content_3, publication_date, category, tags, status, comments_count, meta_description, meta_keywords, canonical_url, subheading_1, subheading_2, subheading_3, main_image_url, image_video_1_url, image_video_2_url, image_video_3_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssssssssssssssssss", $author_id, $author_name, $title, $meta_title, $summary, $content, $content_1, $content_2, $content_3, $publication_date, $category, $tags, $status, $comments_count, $meta_description, $meta_keywords, $canonical_url, $subheading_1, $subheading_2, $subheading_3, $main_image_url, $image_video_1_url, $image_video_2_url, $image_video_3_url);

    if ($stmt->execute()) {
        echo "Blog post published successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
