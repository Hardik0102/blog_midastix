<?php
include 'db_connect.php'; // Include your database connection file
include 'access_key.php'; // Include your access key file

// Retrieve the blog post ID and access key from the URL
$blog_id = $_GET['id'];
$access_key = $_GET['key'];

// Verify the access key
if ($access_key !== ACCESS_KEY) {
    echo "Error: Invalid access key.";
    exit();
}

// Retrieve the blog post from the database
$sql = "SELECT * FROM Posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="./css/editblog.css">
</head>
<body>
    <div class="main">
        <h1>Edit Blog</h1>
        <form action="update_blog.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($blog['id']); ?>">
            <div class="form-row">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="meta_title">Meta Title:</label>
                    <input type="text" id="meta_title" name="meta_title" value="<?php echo htmlspecialchars($blog['meta_title']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="summary">Summary:</label>
                <textarea id="summary" name="summary" required><?php echo htmlspecialchars($blog['summary']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="publication_date">Publication Date:</label>
                    <input type="date" id="publication_date" name="publication_date" value="<?php echo htmlspecialchars($blog['publication_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($blog['category']); ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="tags">Tags:</label>
                    <input type="text" id="tags" name="tags" value="<?php echo htmlspecialchars($blog['tags']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($blog['status']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="comments_count">Comments Count:</label>
                <input type="number" id="comments_count" name="comments_count" value="<?php echo htmlspecialchars($blog['comments_count']); ?>" required>
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description:</label>
                <textarea id="meta_description" name="meta_description" required><?php echo htmlspecialchars($blog['meta_description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="meta_keywords">Meta Keywords:</label>
                <textarea id="meta_keywords" name="meta_keywords" required><?php echo htmlspecialchars($blog['meta_keywords']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="canonical_url">Canonical URL:</label>
                <input type="text" id="canonical_url" name="canonical_url" value="<?php echo htmlspecialchars($blog['canonical_url']); ?>" required>
            </div>
            <button type="submit">Update Blog</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
