<?php
session_start();
include 'connect.php';
include 'header.php';

if (isset($_SESSION['username']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $username = $_SESSION['username'];

    $sql_title = "SELECT title FROM cms_{$username}_pages WHERE id = $id";
    $sql_description = "SELECT description FROM cms_{$username}_pages WHERE id = $id";
    $sql_created_at = "SELECT created_at FROM cms_{$username}_pages WHERE id = $id";
    $sql_status = "SELECT status FROM cms_{$username}_pages WHERE id = $id";

    $sql_title_success = mysqli_query($con, $sql_title);
    $sql_description_success = mysqli_query($con, $sql_description);
    $sql_created_at_success = mysqli_query($con, $sql_created_at);
    $sql_status_success = mysqli_query($con, $sql_status);

    if ($sql_title_success && $sql_description_success && $sql_created_at_success && $sql_status_success) {
        $title = mysqli_fetch_assoc($sql_title_success)['title'];
        $description = mysqli_fetch_assoc($sql_description_success)['description'];
        $created_at = mysqli_fetch_assoc($sql_created_at_success)['created_at'];
        $status = mysqli_fetch_assoc($sql_status_success)['status'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Page Description</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .button-container {
      margin: 20px;
      display: flex;
      gap: 10px;
    }

    #popupOverlay {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
      z-index: 9999;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    #popupOverlay.show {
      display: flex;
      opacity: 1;
    }

    #popupBox {
      text-align: center;
    }

    #popupImage {
      max-width: 90%;
      max-height: 80vh;
      border: 3px solid white; /* white border */
      border-radius: 10px;
      box-shadow: 0 0 10px white;
    }

    #popupCloseBtn {
      margin-top: 15px;
    }

    /* Keep your original description styling intact */
    p, h3 {
      font-family: Arial, sans-serif;
      color: #333;
    }
  </style>
</head>
<body>

  <div class="button-container">
    <button class="btn btn-secondary" onclick="window.location.href='pages_page_display.php'">Go Back</button>
    <button class="btn btn-primary" onclick="openImagePopup('<?= htmlspecialchars($username) ?>', '<?= htmlspecialchars($id) ?>')">Image</button>
  </div>

  <div class="container">
    <h3>Below is the title of the page</h3>
    <p><?= htmlspecialchars($title) ?></p><br>

    <h3>Below is the description of the page</h3>
    <p><?= $description /* render as-is so HTML tags work */ ?></p><br>

    <h3>Below is the created date and time of the page</h3>
    <p><?= htmlspecialchars($created_at) ?></p><br>

    <h3>Below is the status of the page</h3>
    <p><?= htmlspecialchars($status) ?></p>
  </div>

  <!-- Popup -->
  <div id="popupOverlay">
    <div id="popupBox">
      <img id="popupImage" src="" alt="Popup Image">
      <br>
      <button id="popupCloseBtn" class="btn btn-danger" onclick="closePopup()">Close</button>
    </div>
  </div>

  <script>
    function openImagePopup(username, id) {
      const imageUrl = `http://localhost/INTETRNSHIP%20FILES/CMS/images/${username}_${id}.jpg`;

      fetch(imageUrl, { method: 'HEAD' })
        .then(response => {
          if (response.ok) {
            const overlay = document.getElementById('popupOverlay');
            document.getElementById('popupImage').src = imageUrl;
            overlay.classList.add('show');
          } else {
            alert("Image not found!");
          }
        })
        .catch(() => {
          alert("Error loading image.");
        });
    }

    function closePopup() {
      const overlay = document.getElementById('popupOverlay');
      overlay.classList.remove('show');
      setTimeout(() => {
        document.getElementById('popupImage').src = '';
      }, 300);
    }

    document.getElementById('popupOverlay').addEventListener('click', function(e) {
      if (e.target === this) {
        closePopup();
      }
    });
  </script>
</body>
</html>
