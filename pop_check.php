<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Image Popup</title>
  <style>
    /* Modal background */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      animation: fadeIn 0.3s ease-in-out;
    }

    /* Modal content */
    .modal-content {
      background: white;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      animation: scaleIn 0.3s ease-in-out;
    }

    /* Animation */
    @keyframes scaleIn {
      from { transform: scale(0.5); opacity: 0; }
      to   { transform: scale(1); opacity: 1; }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    .close-btn {
      background: red;
      color: white;
      border: none;
      padding: 5px 10px;
      margin-top: 10px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<!-- Image Button -->
<img src="thumbnail.jpg" alt="Click me" style="width:100px;cursor:pointer;" onclick="showPopup()">

<!-- Hidden Modal -->
<div class="modal" id="imageModal">
  <div class="modal-content">
    <img src="your-image.jpg" alt="Popup Image" style="max-width: 90vw; max-height: 70vh;">
    <br>
    <button class="close-btn" onclick="closePopup()">Close</button>
  </div>
</div>

<script>
  function showPopup() {
    document.getElementById('imageModal').style.display = 'flex';
  }

  function closePopup() {
    document.getElementById('imageModal').style.display = 'none';
  }
</script>

</body>
</html>
