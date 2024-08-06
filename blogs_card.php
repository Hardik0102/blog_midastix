<?php
include 'db_connect.php';
include 'access_key.php';


$sql = "SELECT id, title, summary, id AS priority FROM posts ORDER BY id DESC";
$result = $conn->query($sql);

$blogs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
}

$conn->close();
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog List</title>
    <link rel="stylesheet" href="css/blogcard.css">
    <style>
        
    </style>
</head>
<body>
    <h1>Blog List</h1>
    <div class="blog-container">
        <?php foreach ($blogs as $blog): ?>
            <div class="thumbnail">
                <?php if (!empty($blog['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($blog['image_url']); ?>" alt="<?php echo htmlspecialchars($blog['title']); ?>">
                <?php endif; ?>
            </div>
        <div class="blog-card">
            <h2 class="blog-title"><?php echo htmlspecialchars($blog['title']); ?></h2>
            <p class="blog-summary"><?php echo htmlspecialchars($blog['summary']); ?></p>
            <p class="priority">Priority: <?php echo htmlspecialchars($blog['priority']); ?></p>
            <a href="view_blog.php?id=<?php echo $blog['id']; ?>" class="read-more">Read More</a>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
