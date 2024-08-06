<?php
include 'db_connect.php'; 
include 'access_key.php'; 

if (isset($_GET['id']) && isset($_GET['key'])) {
    $id = intval($_GET['id']);
    $key = $_GET['key'];

    if ($key === ACCESS_KEY) {
            
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "Blog entry deleted successfully.";
        } else {
            echo "Error deleting blog entry.";
        }

        $stmt->close();
        $conn->close();

        
        header("Location: display_blogs.php");
        exit();
    } else {
        echo "Invalid access key.";
    }
} else {
    echo "Invalid blog ID or access key.";
}
