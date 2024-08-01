<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish Blog</title>
    <link rel="stylesheet" href="/css/publish.css">
    <style>
        .dropzone {
            border: 2px dashed #cccccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: #cccccc;
            font-size: 20px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .dropzone.dragover {
            border-color: #0000ff;
            color: #0000ff;
        }
        .image-preview, .video-preview {
            display: none;
            max-width: 300px;
            max-height: 200px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="maincontainer">
        <h1 class="publishblogheading">Publish Blog</h1>
        <div class="form_container">
            <form id="blog_form" action="submit_blog.php" method="post" enctype="multipart/form-data">
                <label for="authorid">Author ID:</label>
                <input type="text" id="blog_authorid" name="authorid" required><br><br>

                <label for="author_name">Author Name:</label>
                <input type="text" id="blog_author_name" name="author_name" required><br><br>

                <label for="title">Title:</label>
                <input type="text" id="blog_title" name="title" required><br><br>

                <label for="meta_title">Meta Title:</label>
                <input type="text" id="blog_meta_title" name="meta_title"><br><br>

                <label for="summary">Summary:</label>
                <input type="text" id="blog_summary" name="summary"><br><br>

                <label for="content">Content:</label>
                <textarea id="blog_content" name="content" rows="4" cols="50"></textarea><br><br>

                <label for="content_1">Content 1:</label>
                <textarea id="content_1" name="content_1" rows="4" cols="50"></textarea><br><br>

                <label for="content_2">Content 2:</label>
                <textarea id="content_2" name="content_2" rows="4" cols="50"></textarea><br><br>

                <label for="content_3">Content 3:</label>
                <textarea id="content_3" name="content_3" rows="4" cols="50"></textarea><br><br>

                <label for="publication_date">Publication Date:</label>
                <input type="date" id="blog_publication_date" name="publication_date" required><br><br>

                <label for="category">Category:</label>
                <input type="text" id="blog_category" name="category"><br><br>

                <label for="tags">Tags:</label>
                <input type="text" id="blog_tags" name="tags"><br><br>

                <label for="status">Status:</label>
                <input type="text" id="blog_status" name="status"><br><br>

                <label for="comments_count">Comments Count:</label>
                <input type="text" id="blog_comments_count" name="comments_count"><br><br>

                <label for="meta_description">Meta Description:</label>
                <textarea id="blog_meta_description" name="meta_description" rows="2" cols="50"></textarea><br><br>

                <label for="meta_keywords">Meta Keywords:</label>
                <input type="text" id="blog_meta_keywords" name="meta_keywords"><br><br>

                <label for="canonical_url">Canonical URL:</label>
                <input type="text" id="blog_canonical_url" name="canonical_url"><br><br>

                <label for="subheading_1">Subheading 1:</label>
                <input type="text" id="subheading_1" name="subheading_1"><br><br>

                <label for="subheading_2">Subheading 2:</label>
                <input type="text" id="subheading_2" name="subheading_2"><br><br>

                <label for="subheading_3">Subheading 3:</label>
                <input type="text" id="subheading_3" name="subheading_3"><br><br>

                <!-- Image Uploads -->
                <label for="main_image">Main Image:</label>
                <div id="main_image_dropzone" class="dropzone">Drag and drop an image here or click to select a file</div>
                <input type="file" id="main_image_file" name="main_image_file" style="display:none;" accept="image/*"><br><br>
                <img id="main_image_preview" class="image-preview" src="" alt="Main Image Preview">
                <input type="hidden" id="main_image_url" name="main_image_url"><br><br>

                <label for="image_video_1">Image/Video 1:</label>
                <div id="image_video_1_dropzone" class="dropzone">Drag and drop an image/video here or click to select a file</div>
                <input type="file" id="image_video_1_file" name="image_video_1_file" style="display:none;" accept="image/*,video/*"><br><br>
                <div id="image_video_1_preview_container">
                    <img id="image_video_1_preview" class="image-preview" src="" alt="Image/Video 1 Preview">
                    <video id="image_video_1_video_preview" class="video-preview" controls></video>
                </div>
                <input type="hidden" id="image_video_1_url" name="image_video_1_url"><br><br>

                <label for="image_video_2">Image/Video 2:</label>
                <div id="image_video_2_dropzone" class="dropzone">Drag and drop an image/video here or click to select a file</div>
                <input type="file" id="image_video_2_file" name="image_video_2_file" style="display:none;" accept="image/*,video/*"><br><br>
                <div id="image_video_2_preview_container">
                    <img id="image_video_2_preview" class="image-preview" src="" alt="Image/Video 2 Preview">
                    <video id="image_video_2_video_preview" class="video-preview" controls></video>
                </div>
                <input type="hidden" id="image_video_2_url" name="image_video_2_url"><br><br>

                <label for="image_video_3">Image/Video 3:</label>
                <div id="image_video_3_dropzone" class="dropzone">Drag and drop an image/video here or click to select a file</div>
                <input type="file" id="image_video_3_file" name="image_video_3_file" style="display:none;" accept="image/*,video/*"><br><br>
                <div id="image_video_3_preview_container">
                    <img id="image_video_3_preview" class="image-preview" src="" alt="Image/Video 3 Preview">
                    <video id="image_video_3_video_preview" class="video-preview" controls></video>
                </div>
                <input type="hidden" id="image_video_3_url" name="image_video_3_url"><br><br>

                <!-- Access Key Field -->
                <label for="access_key">Access Key:</label>
                <input type="password" id="access_key" name="access_key" required><br><br>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
    <script>
       function setupDropzone(dropzoneId, fileInputId, imagePreviewId, videoPreviewId, urlInputId) {
            const dropzone = document.getElementById(dropzoneId);
            const fileInput = document.getElementById(fileInputId);
            const imagePreview = document.getElementById(imagePreviewId);
            const videoPreview = document.getElementById(videoPreviewId);
            const urlInput = document.getElementById(urlInputId);

            dropzone.addEventListener('dragover', (event) => {
                event.preventDefault();
                dropzone.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', (event) => {
                event.preventDefault();
                dropzone.classList.remove('dragover');
                const files = event.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    showPreview(files[0]);
                }
            });

            dropzone.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length > 0) {
                    showPreview(fileInput.files[0]);
                }
            });

            function showPreview(file) {
                const fileType = file.type.split('/')[0];
                if (fileType === 'image') {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                        videoPreview.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                } else if (fileType === 'video') {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        videoPreview.src = e.target.result;
                        videoPreview.style.display = 'block';
                        imagePreview.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
                urlInput.value = file.name;
            }
        }

        setupDropzone('main_image_dropzone', 'main_image_file', 'main_image_preview', '', 'main_image_url');
        setupDropzone('image_video_1_dropzone', 'image_video_1_file', 'image_video_1_preview', 'image_video_1_video_preview', 'image_video_1_url');
        setupDropzone('image_video_2_dropzone', 'image_video_2_file', 'image_video_2_preview', 'image_video_2_video_preview', 'image_video_2_url');
        setupDropzone('image_video_3_dropzone', 'image_video_3_file', 'image_video_3_preview', 'image_video_3_video_preview', 'image_video_3_url');
    </script>
</body>
</html>
