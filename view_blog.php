<?php
include 'db_connect.php'; // Include your database connection file

// Retrieve the blog post ID from the URL
$blog_id = $_GET['id'];

// Check if the blog ID is set and is a valid integer
if (isset($blog_id) && is_numeric($blog_id)) {
   
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
} else {
    
    echo "Invalid blog ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <link rel="stylesheet" href="/css/blog.css">
</head>
<body>
    <div class="blog-container">
        <div class="blog-post">
            <h2 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h2>
            <p class="blog-meta-title"><?php echo htmlspecialchars($blog['meta_title']); ?></p>
            <p class="blog-summary"><?php echo htmlspecialchars($blog['summary']); ?></p>
            <?php if (!empty($blog['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($blog['image_url']); ?>" alt="Blog Image" class="blog-image">
            <?php endif; ?>
            <div class="blog-content"><?php echo nl2br(htmlspecialchars($blog['content'])); ?></div>
            <p class="blog-publication-date">Published on: <?php echo htmlspecialchars($blog['publication_date']); ?></p>
            <p class="blog-category">Category: <?php echo htmlspecialchars($blog['category']); ?></p>
            <p class="blog-tags">Tags: <?php echo htmlspecialchars($blog['tags']); ?></p>
            <p class="blog-status">Status: <?php echo htmlspecialchars($blog['status']); ?></p>
            <p class="blog-comments-count">Comments: <?php echo htmlspecialchars($blog['comments_count']); ?></p>
            <p class="blog-meta-description">Meta Description: <?php echo htmlspecialchars($blog['meta_description']); ?></p>
            <p class="blog-meta-keywords">Meta Keywords: <?php echo htmlspecialchars($blog['meta_keywords']); ?></p>
            <p class="blog-canonical-url">Canonical URL: <a href="<?php echo htmlspecialchars($blog['canonical_url']); ?>"><?php echo htmlspecialchars($blog['canonical_url']); ?></a></p>
        </div>
    </div>
</body>
</html>
