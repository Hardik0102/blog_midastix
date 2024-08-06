<?php
include 'db_connect.php';

function sanitizeFileName($filename) {
    return preg_replace('/[^A-Za-z0-9_\-.]/', '_', $filename);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author = $_POST['blog_author'];
    $blog_title = $_POST['blog_title'];
    $blog_subtitle = $_POST['blog_subtitle'];
    $blog_description = $_POST['blog_description'];
    $status = isset($_POST['status']) ? 1 : 0; 
    $content_titles = isset($_POST['content_title']) ? $_POST['content_title'] : []; 
    $content_descriptions = isset($_POST['content_description']) ? $_POST['content_description'] : [];
    $sub_content_titles = isset($_POST['sub_content_title']) ? $_POST['sub_content_title'] : [];
    $sub_content_descriptions = isset($_POST['sub_content_description']) ? $_POST['sub_content_description'] : [];

    $blog_thumbnail_url = null;

    // Handle file upload
    if (isset($_FILES['new_blog_thumbnail']) && $_FILES['new_blog_thumbnail']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/' . sanitizeFileName($blog_title) . '/'; // Create a directory named after the blog title
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
        }
        $file_tmp = $_FILES['new_blog_thumbnail']['tmp_name'];
        $file_name = sanitizeFileName($blog_title) . '_' . basename($_FILES['new_blog_thumbnail']['name']);
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            $blog_thumbnail_url = $file_path;
        } else {
            die("Error uploading file.");
        }
    }

    // Insert blog details into the database
    $sql = "INSERT INTO Blog (blog_title, blog_subtitle, blog_description, status, author, blog_thumbnail_url) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssiss", $blog_title, $blog_subtitle, $blog_description, $status, $author, $blog_thumbnail_url);

    if ($stmt->execute()) {
        $blog_id = $stmt->insert_id;

        // Insert content details into the database
        if (!empty($content_titles) && !empty($content_descriptions)) {
            $sql_content = "INSERT INTO Content (blog_id, content_title, content_description) 
                            VALUES (?, ?, ?)";
            
            $stmt_content = $conn->prepare($sql_content);
            if (!$stmt_content) {
                die("Prepare failed: " . $conn->error);
            }

            foreach ($content_titles as $index => $content_title) {
                $content_description = $content_descriptions[$index];

                $stmt_content->bind_param("iss", $blog_id, $content_title, $content_description);

                if ($stmt_content->execute()) {
                    $content_id = $stmt_content->insert_id;

                    // Insert subcontent details into the database
                    if (!empty($sub_content_titles[$index]) && !empty($sub_content_descriptions[$index])) {
                        $sql_subcontent = "INSERT INTO SubContent (content_id, sub_content_title, sub_content_description) 
                                           VALUES (?, ?, ?)";
                        
                        $stmt_subcontent = $conn->prepare($sql_subcontent);
                        if (!$stmt_subcontent) {
                            die("Prepare failed: " . $conn->error);
                        }

                        foreach ($sub_content_titles[$index] as $sub_index => $sub_content_title) {
                            $sub_content_description = $sub_content_descriptions[$index][$sub_index];

                            $stmt_subcontent->bind_param("iss", $content_id, $sub_content_title, $sub_content_description);

                            if (!$stmt_subcontent->execute()) {
                                echo "Error inserting subcontent: " . $stmt_subcontent->error;
                            }
                        }

                        $stmt_subcontent->close();
                    }
                } else {
                    echo "Error inserting content: " . $stmt_content->error;
                }
            }

            $stmt_content->close();
        }

        echo "Blog, content, and subcontent published successfully!";
    } else {
        echo "Error inserting blog: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
