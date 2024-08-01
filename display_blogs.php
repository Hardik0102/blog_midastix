<?php
include 'db_connect.php';
include 'access_key.php';

$sql = "SELECT id, title, status, priority FROM posts ORDER BY priority DESC, publication_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog List</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: calc(33.333% - 20px);
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }
        .card-header {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .card-body {
            margin-bottom: 20px;
        }
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .action-button {
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .delete-button { background-color: red; }
        .delete-button:hover { background-color: darkred; }
        .edit-button { background-color: blue; }
        .edit-button:hover { background-color: darkblue; }
        .publish-button { background-color: green; }
        .publish-button:hover { background-color: darkgreen; }
        .unpublish-button { background-color: orange; }
        .unpublish-button:hover { background-color: darkorange; }
        .priority-input {
            width: 50px;
            margin-right: 10px;
        }
    </style>
    <script>
        function requestAccessKey(callback) {
            const accessKey = prompt("Please enter the access key:");
            if (accessKey !== null) {
                callback(accessKey);
            }
        }

        function deleteBlog(blogId) {
            requestAccessKey(function(accessKey) {
                window.location.href = "delete_blog.php?id=" + blogId + "&key=" + encodeURIComponent(accessKey);
            });
        }

        function editBlog(blogId) {
            requestAccessKey(function(accessKey) {
                window.location.href = "edit_blog.php?id=" + blogId + "&key=" + encodeURIComponent(accessKey);
            });
        }

        function publishBlog(blogId) {
            requestAccessKey(function(accessKey) {
                window.location.href = "publish_blog.php?id=" + blogId + "&key=" + encodeURIComponent(accessKey);
            });
        }

        function unpublishBlog(blogId) {
            requestAccessKey(function(accessKey) {
                window.location.href = "unpublish_blog.php?id=" + blogId + "&key=" + encodeURIComponent(accessKey);
            });
        }

        function updatePriority(blogId) {
            const priority = document.getElementById('priority-' + blogId).value;
            requestAccessKey(function(accessKey) {
                window.location.href = "update_priority.php?id=" + blogId + "&priority=" + priority + "&key=" + encodeURIComponent(accessKey);
            });
        }
    </script>
</head>
<body>
    <h1>Blog List</h1>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id']);
                $title = htmlspecialchars($row['title']);
                $status = htmlspecialchars($row['status']);
                $priority = htmlspecialchars($row['priority']);
                echo "<div class='card'>";
                echo "<div class='card-header'>{$title}</div>";
                echo "<div class='card-body'>Status: {$status}</div>";
                echo "<div class='card-footer'>
                        <div>
                            <input type='number' id='priority-{$id}' class='priority-input' value='{$priority}'>
                            <button class='action-button' onclick='updatePriority({$id})'>Update Priority</button>
                        </div>
                        <div>
                            <button class='action-button edit-button' onclick='editBlog({$id})'>Edit</button>
                            <button class='action-button delete-button' onclick='deleteBlog({$id})'>Delete</button>";
                if ($status === 'published') {
                    echo "<button class='action-button unpublish-button' onclick='unpublishBlog({$id})'>Unpublish</button>";
                } else {
                    echo "<button class='action-button publish-button' onclick='publishBlog({$id})'>Publish</button>";
                }
                echo "  </div>
                      </div>";
                echo "</div>";
            }
        } else {
            echo "<p>No blogs found</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
