<?php
session_start(); // Start the session

// Example: Getting username and id from session
$username = $_SESSION['username']; // E.g., 'john'
$id = $_SESSION['id'];             // E.g., 101

if (isset($_POST['submit']) && isset($_GET['id'])) {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img = $_FILES['image'];

        // Get file extension
        $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

        // Validate allowed types
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        // ✅ Rename file as username_id.jpg
        $newFileName = ($username . '_' . $id . '.jpg'); // Force .jpg extension

        // ✅ Target folder is "images/"
        $uploadDir = 'images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $targetPath = $uploadDir . $newFileName;

        // ✅ Move uploaded file
        if (move_uploaded_file($img['tmp_name'], $targetPath)) {
            echo "✅ Image uploaded successfully as: <strong>$newFileName</strong><br>";
            echo "<img src='$targetPath' width='300' alt='Uploaded Image'>";
        } else {
            echo "❌ Failed to move uploaded file.";
        }
    } else {
        echo "❌ No image selected or an error occurred.";
    }
}
?>
