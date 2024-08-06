<?php
include 'db_connect.php';

$blog = null; // Initialize blog variable
$contents = []; // Initialize contents as an empty array

if (isset($_GET['blog_id'])) {
    $blog_id = intval($_GET['blog_id']);

    // Fetch blog details
    $sql = "SELECT * FROM Blog WHERE blog_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    // Fetch content details if blog exists
    if ($blog) {
        $sql_content = "SELECT * FROM Content WHERE blog_id = ?";
        $stmt_content = $conn->prepare($sql_content);
        if (!$stmt_content) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_content->bind_param("i", $blog_id);
        $stmt_content->execute();
        $result_content = $stmt_content->get_result();
        $contents = $result_content->fetch_all(MYSQLI_ASSOC);

        
        foreach ($contents as &$content) {
            $content['subcontents'] = [];
            $content_id = $content['content_id'];
            $sql_subcontent = "SELECT * FROM Subcontent WHERE content_id = ?";
            $stmt_subcontent = $conn->prepare($sql_subcontent);
            if (!$stmt_subcontent) {
                die("Prepare failed: " . $conn->error);
            }

            $stmt_subcontent->bind_param("i", $content_id);
            $stmt_subcontent->execute();
            $result_subcontent = $stmt_subcontent->get_result();
            $content['subcontents'] = $result_subcontent->fetch_all(MYSQLI_ASSOC);

            
           
        }
    }

    $stmt->close();
    $stmt_content->close();
    $stmt_subcontent->close();
    $conn->close();
} else {
    die("Blog ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
    <link rel="stylesheet" href="/css/blog.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .blog-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .blog-title {
            font-size: 2em;
            margin-bottom: 0.5em;
        }
        .blog-subtitle {
            font-size: 1.5em;
            margin-bottom: 1em;
            color: #555;
        }
        .blog-description {
            margin-bottom: 1em;
        }
        .content-section {
            margin-top: 2em;
        }
        .content-title {
            font-size: 1.2em;
            margin-bottom: 0.5em;
        }
        .sub-content {
            margin-bottom: 1em;
            margin-left: 20px;
        }
        .thumbnail-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 1em;
        }
    </style>
</head>
<body>
    <div class="blog-container">
        <?php if ($blog): ?>
            <h1 class="blog-title"><?php echo htmlspecialchars($blog['blog_title']); ?></h1>
            <?php if (!empty($blog['blog_subtitle'])): ?>
                <h2 class="blog-subtitle"><?php echo htmlspecialchars($blog['blog_subtitle']); ?></h2>
            <?php endif; ?>

            <?php if (!empty($blog['blog_thumbnail_url'])): ?>
                <img src="<?php echo htmlspecialchars($blog['blog_thumbnail_url']); ?>" alt="Blog Thumbnail" class="thumbnail-image">
            <?php endif; ?>

            <div class="blog-description">
                <?php echo nl2br(htmlspecialchars($blog['blog_description'])); ?>
            </div>

            <div class="content-section">
                <?php if (!empty($contents)): ?>
                    <?php foreach ($contents as $content): ?>
                        <div class="content-item">
                            <h3 class="content-title"><?php echo htmlspecialchars($content['content_title']); ?></h3>
                            <div class="content-description">
                                <?php echo nl2br(htmlspecialchars($content['content_description'])); ?>
                            </div>
                            <?php if (!empty($content['subcontents'])): ?>
                                <?php foreach ($content['subcontents'] as $subcontent): ?>
                                    <div class="sub-content">
                                        <h4 class="subcontent-title">
                                            <?php echo isset($subcontent['sub_content_title']) ? htmlspecialchars($subcontent['sub_content_title']) : ''; ?>
                                        </h4>
                                        <!-- <div class="subcontent-id">
                                            ID: <?php echo isset($subcontent['sub_content_id']) ? htmlspecialchars($subcontent['sub_content_id']) : ''; ?>
                                        </div> -->
                                        <div class="subcontent-description">
                                            <?php echo isset($subcontent['sub_content_description']) ? nl2br(htmlspecialchars($subcontent['sub_content_description'])) : ''; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No content found for this blog.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>Blog not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
