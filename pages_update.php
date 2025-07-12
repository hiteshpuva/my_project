<?php
session_start();
include 'connect.php';
include 'header.php';

if (isset($_GET['updateid']) && isset($_SESSION['username'])) {
    $id = (int) $_GET['updateid'];
    $username = $_SESSION['username'];
} else {
    die("Invalid request");
}

// Fetch existing data
$sql = "SELECT * FROM cms_{$username}_pages WHERE id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$title = $row['title'];
$description = $row['description'];
$featured_image = $row['featured_image'];
$status = $row['status'];

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // Handle new image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img = $_FILES['image'];
        $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $allowed)) {
            $newImageName = $username . '_' . $id . '.jpg'; // Save as JPG
            $uploadPath = 'images/' . $newImageName;

            // Remove old image if exists
            if (file_exists($uploadPath)) {
                unlink($uploadPath);
            }

            move_uploaded_file($img['tmp_name'], $uploadPath);
            $featured_image = $newImageName; // Update value
        }
    }

    // Update all fields including featured_image
    $sql = "UPDATE cms_{$username}_pages 
            SET title = '$title', 
                description = '$description', 
                featured_image = '$featured_image',
                status = '$status' 
            WHERE id = $id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('Location: pages_page_display.php');
        exit;
    } else {
        die('Error: ' . mysqli_error($con));
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Update Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    /* Popup Overlay Styles */
    #popupOverlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    #popupBox {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      max-width: 600px;
      max-height: 80vh;
      overflow: auto;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
      animation: popupFadeIn 0.3s ease forwards;
    }
    #popupImage {
      max-width: 100%;
      max-height: 60vh;
      border-radius: 5px;
    }
    @keyframes popupFadeIn {
      from {opacity: 0; transform: scale(0.8);}
      to {opacity: 1; transform: scale(1);}
    }
  </style>

  <!-- CKEditor CDN -->
  <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>
<body>

<div class="container my-5">
  <form method="POST" enctype="multipart/form-data">
    <h3>Update Image and Page Details</h3>

    <button type="button" class="btn btn-primary text-light mb-3" onclick="openImagePopup('<?php echo $username; ?>', '<?php echo $id; ?>')">
      Preview Current Image
    </button>

    <div class="form-group mb-3">
      <label>TITLE</label>
      <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
    </div>

    <div class="form-group mb-3">
      <label>DESCRIPTION</label>
      <textarea class="form-control" name="description" id="description" required><?php echo htmlspecialchars($description); ?></textarea>
    </div>

    <div class="form-group mb-3">
      <label for="image">Upload New Image (.jpg File)(optional)</label>
      <input type="file" class="form-control" name="image" accept="image/*">
    </div>

    <div class="form-group mb-3">
      <label for="status">STATUS</label>
      <select name="status" class="form-control" required>
        <option value="Draft" <?php if ($status == 'Draft') echo 'selected'; ?>>Draft</option>
        <option value="Pending_Review" <?php if ($status == 'Pending_Review') echo 'selected'; ?>>Pending Review</option>
        <option value="Published" <?php if ($status == 'Published') echo 'selected'; ?>>Published</option>
        <option value="Inactive" <?php if ($status == 'Inactive') echo 'selected'; ?>>Inactive</option>
        <option value="Deleted" <?php if ($status == 'Deleted') echo 'selected'; ?>>Deleted</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Update</button>
  </form>
</div>

<!-- Popup markup -->
<div id="popupOverlay">
  <div id="popupBox">
    <img id="popupImage" src="" alt="Image Preview" />
    <br /><br />
    <button onclick="closePopup()" class="btn btn-danger">Close</button>
  </div>
</div>

<script>
  function openImagePopup(username, id) {
    const imageUrl = `images/${username}_${id}.jpg`;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', imageUrl, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        document.getElementById('popupImage').src = imageUrl;
        document.getElementById('popupOverlay').style.display = 'flex';
      } else {
        alert("Image not found!");
      }
    };
    xhr.onerror = function () {
      alert("Error loading image.");
    };
    xhr.send();
  }

  function closePopup() {
    document.getElementById('popupOverlay').style.display = 'none';
    document.getElementById('popupImage').src = '';
  }

  // Initialize CKEditor
  CKEDITOR.replace('description');
</script>

</body>
</html>
