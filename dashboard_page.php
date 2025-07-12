<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            background-color: #444;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            border-bottom: 2px solid #ccc;
        }
    </style>
</head>
<body>

    <!-- Sidebar Menu -->
    <div class = "sidebar">
        <h2>Menu</h2>
        <a href = "dashboard_page.php">Home</a>
        <a href = "users_page_display.php">Users</a>
        <a href = "pages_page_display.php">Pages</a>
        <a href = "logout_page.php">Logout</a>
    </div>


      <!--Main Content-->
    <div class="content">
        <?php
        session_start();
        include 'connection.php';
        if(isset($_SESSION['username'])){
            $username = $_SESSION['username'];
            $name_selection = "select name from cms_user_details where username = '$username'";
            $name_selection_successful = mysqli_query($conn,$name_selection);
            if($name_selection_successful){
                $row = mysqli_fetch_assoc($name_selection_successful);
                $name = (string) $row['name'];
                
            }
        }
        ?>
        <div class="header">Welcome to <?php print_r($name);?>'s Dashboard Page

        
    </div>
        <p>This webpage is about the Content Management System.</p>
    </div>

    
</body>
</html>

