<?php
session_start();
include 'connect.php';
include 'header.php';

if(isset($_POST['submit']) && isset($_SESSION['username'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $username = $_SESSION['username'];

    // Insert without featured_image first
    $sql = "INSERT INTO cms_" . $username . "_pages (title, description, featured_image, status) VALUES (?, ?, ?, ?)";
    
    // Initially set featured_image as empty string; we will update after file upload
    $featured_image = '';

    // Using prepared statement to avoid SQL injection
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $featured_image, $status);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        // Get the last inserted ID
        $id = $stmt->insert_id;

        // Now handle the image upload
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $img = $_FILES['image'];
            $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if(in_array($ext, $allowed)){
                $newFileName = $username . '_' . $id . '.' . $ext;
                $uploadDir = 'images/';
                if(!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }
                $destination = $uploadDir . $newFileName;

                if(move_uploaded_file($img['tmp_name'], $destination)){
                    // Update the featured_image column with the new file name
                    $updateSql = "UPDATE cms_" . $username . "_pages SET featured_image = ? WHERE id = ?";
                    $updateStmt = $con->prepare($updateSql);
                    $updateStmt->bind_param("si", $newFileName, $id);
                    $updateStmt->execute();
                    $updateStmt->close();

                    // Redirect or message
                    header('Location: pages_inserted_successfully.php');
                    exit;
                } else {
                    echo "Failed to upload the image file.";
                }
            } else {
                echo "Invalid image file type.";
            }
        } else {
            echo "No image uploaded or upload error.";
        }
        $stmt->close();
    } else {
        die("Insert failed: " . $con->error);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crud Operation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- CKEditor 4 CDN -->
  <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
<body>
<div class="container my-5">
    <form method="POST" enctype="multipart/form-data">
        <h3>Insert your page details and upload an image. Image will be saved as username_id.jpg in the images folder.</h3>

        <div class="form-group mb-3">
            <label>TITLE</label>
            <input type="text" class="form-control" placeholder="Enter your title" name="title" autocomplete="off" required />
        </div>

        <div class="form-group mb-3">
            <label>DESCRIPTION</label>
            <textarea name="description" id="description" rows="10" class="form-control" required></textarea>
            <script>
                CKEDITOR.replace('description');
            </script>
        </div>

        <div class="form-group mb-3">
            <label for="image">Choose an image to upload (.jpg File):</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*" required />
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="draft">Draft</option>
                <option value="pending">Pending Review</option>
                <option value="published">Published</option>
                <option value="inactive">Inactive</option>
                <option value="deleted">Deleted</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</body>
</html>
