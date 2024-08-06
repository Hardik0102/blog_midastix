<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Blog</title>
    <link rel="stylesheet" href="/css/addblog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function addContentField() {
            const contentContainer = document.getElementById('content-container');
            const contentIndex = contentContainer.children.length;

            const contentField = document.createElement('div');
            contentField.className = 'content-field';
            contentField.innerHTML = `
                <h3>Content ${contentIndex + 1}</h3>
                <label for="content_title_${contentIndex}">Content Title:</label>
                <input type="text" id="content_title_${contentIndex}" name="content_title[]" required><br>
                <label for="content_description_${contentIndex}">Content Description:</label>
                <textarea id="content_description_${contentIndex}" name="content_description[]" required></textarea><br>
                <div class="subcontent-container" id="subcontent-container_${contentIndex}"></div>
                <button type="button" class="add-subcontent-button" onclick="addSubcontentField(${contentIndex})">Add Subcontent</button><br>
                <button type="button" class="delete-button" onclick="removeContentField(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;

            contentContainer.appendChild(contentField);
        }

        function addSubcontentField(contentIndex) {
            const subcontentContainer = document.getElementById(`subcontent-container_${contentIndex}`);
            const subcontentIndex = subcontentContainer.children.length;

            const subcontentField = document.createElement('div');
            subcontentField.className = 'subcontent-field';
            subcontentField.innerHTML = `
                <h4>Subcontent ${subcontentIndex + 1}</h4>
                <label for="sub_content_title_${contentIndex}_${subcontentIndex}">Subcontent Title:</label>
                <input type="text" id="sub_content_title_${contentIndex}_${subcontentIndex}" name="sub_content_title[${contentIndex}][]" required><br>
                <label for="sub_content_description_${contentIndex}_${subcontentIndex}">Subcontent Description:</label>
                <textarea id="sub_content_description_${contentIndex}_${subcontentIndex}" name="sub_content_description[${contentIndex}][]" required></textarea><br>
                <button type="button" class="delete-button" onclick="removeSubcontentField(this)">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;

            subcontentContainer.appendChild(subcontentField);
        }

        function removeContentField(button) {
            const contentContainer = document.getElementById('content-container');
            contentContainer.removeChild(button.parentElement);
        }

        function removeSubcontentField(button) {
            const subcontentContainer = button.parentElement.parentElement;
            subcontentContainer.removeChild(button.parentElement);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('new_blog_thumbnail');
            const imagePreview = document.getElementById('image-preview');

            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.add('dragover');
            });

            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('dragover');
            });

            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropZone.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length) {
                    fileInput.files = files;
                    displayPreview(files[0]);
                }
            });

            dropZone.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length) {
                    displayPreview(fileInput.files[0]);
                }
            });

            function displayPreview(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `
                        <img src="${e.target.result}" alt="Image Preview">
                        <button type="button" class="delete-button" onclick="removeImage()">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });

        function removeImage() {
            const imagePreview = document.getElementById('image-preview');
            const fileInput = document.getElementById('new_blog_thumbnail');
            imagePreview.innerHTML = '';
            fileInput.value = '';
        }
    </script>
</head>
<body>
    <form action="submit_blog.php" method="post" enctype="multipart/form-data">
        <h1>Submit Blog</h1>
        <label for="blog_title">Blog Title:</label>
        <input type="text" id="blog_title" name="blog_title" required>
        
        <label for="blog_subtitle">Blog Subtitle:</label>
        <input type="text" id="blog_subtitle" name="blog_subtitle">
        
        <label for="blog_description">Blog Description:</label>
        <textarea id="blog_description" name="blog_description" required></textarea>
        
        <label for="blog_author">Author:</label>
        <input type="text" id="blog_author" name="blog_author" required>
        
        <label for="status">Status:</label>
        <input type="checkbox" id="status" name="status">

        <label for="new_blog_thumbnail">Blog Thumbnail:</label>
        <div id="drop-zone">Drag and drop an image here or click to select a file</div>
        <input type="file" id="new_blog_thumbnail" name="new_blog_thumbnail" accept="image/*" style="display:none;">
        <div id="image-preview"></div>
        
        <div id="content-container">
       
        </div>
        <button type="button" onclick="addContentField()">Add Content</button>
        
        <input type="submit" value="Submit Blog">
    </form>
</body>
</html>
