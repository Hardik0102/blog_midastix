<?php
// Directory where uploaded images will be saved
$uploadDir = 'uploads/';

// Check if the form was submitted with an image file
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image_file'])) {
    // Temporary file path
    $fileTmpPath = $_FILES['image_file']['tmp_name'];
    // Original file name
    $fileName = basename($_FILES['image_file']['name']);
    // File size
    $fileSize = $_FILES['image_file']['size'];
    // File type
    $fileType = $_FILES['image_file']['type'];
    // Extract file extension
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Ensure the upload directory exists; if not, create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate a unique file name to avoid overwriting existing files
    $newFileName = uniqid('image_') . '.' . $fileExtension;
    // Construct the full path where the file will be stored
    $destPath = $uploadDir . $newFileName;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // If successful, return the path where the file is stored
        echo json_encode(['success' => true, 'filepath' => $destPath]);
    } else {
        // If failed, return an error message
        echo json_encode(['success' => false, 'error' => 'There was an error uploading the file.']);
    }
} else {
    // If no file was uploaded or an invalid request was made, return an error message
    echo json_encode(['success' => false, 'error' => 'No file uploaded or invalid request.']);
}
?>
