<?php
include 'connect.php';
include 'header.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>CRUD OPERATION</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="image_style.css" />
</head>
<body>

<div class="container">
  <button class="btn btn-info my-5">
    <a href="pages_user_page.php" class="text-light" style="text-decoration: none;">ADD PAGE</a>
  </button>


  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">TITLE</th>
        <th scope="col">DESCRIPTION</th>
        <th scope="col">FEATURED IMAGE</th>
        <th scope="col">CREATED AT</th>
        <th scope="col">STATUS</th>
        <th scope="col">OPERATIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
      }

      $sql = "SELECT * FROM cms_{$username}_pages";
      $result = mysqli_query($con, $sql);
      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $title = $row['title'];
          $description = $row['description'];
          $created_at = $row['created_at'];
          $status = $row['status'];
          $_SESSION['show']=$id;

          echo '
            <tr>
              <th scope="row">' . $id . '</th>
              <td>' . $title . '</td>
              <td>' . $description . '</td>
              <td>
                <button class="btn btn-warning text-light" onclick="openImagePopup(\'' . $username . '\', \'' . $id . '\')">Image</button>
               </td>
              <td>' . $created_at . '</td>
              <td>' . $status . '</td>
              <td>
                <button class="btn btn-primary">
                  <a href="pages_update.php?updateid=' . $id . '" class="text-light" style="text-decoration: none;">Update</a>
                </button><br><br>
                <button class="btn btn-danger text-light" onclick="confirmDelete(' . $id . ')">Delete</button><br><br>
                <button class="btn btn-success">
  <a href="description.php?id=' .$id. '" class="text-light" style="text-decoration: none;">Show Details</a>
</button>

              </td>
            </tr>';
        }
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Popup markup, styled via image_style.css -->
<div id="popupOverlay">
  <div id="popupBox">
    <img id="popupImage" src="" alt="Image Preview" />
    <br />
    <button onclick="closePopup()">Close</button>
  </div>
</div>

<script>
  function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this item?")) {
      window.location.href = 'pages_delete.php?deleteid=' + id;
    }
  }

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
</script>

</body>
</html>
