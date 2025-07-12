<?php
session_start();
include 'connect.php';
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];    
    $_SESSION['name'] = $name;

    $sql = "insert into cms_user_details(name, username, password) values ('$name','$username','$password')";
    $result = mysqli_query($con,$sql);

    $user_creation = "CREATE TABLE cms_" . $username . "_users (id INT(11) NOT NULL AUTO_INCREMENT, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, mobile VARCHAR(10) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY (id))";


    $user_creation_success = mysqli_query($con,$user_creation);

    $page_creation = "CREATE TABLE cms_" . $username . "_pages (id INT(11) NOT NULL AUTO_INCREMENT, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, featured_image VARCHAR(255) NOT NULL, created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, status VARCHAR(255) NOT NULL, PRIMARY KEY (id))";

    $page_creation_success = mysqli_query($con, $page_creation);



    if($result && $user_creation_success && $page_creation_success){
        //echo "Data inserted successfully";
        header('location:signup_success_page.php');
    }else{
        die(mysqli_error($con));
    }
}
?>

<!doctype html>
<html lang = "en">
  <head>
    <!-- Required meta tags -->
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel = "stylesheet">

    
    <title>Crud Operation</title>
  </head>
  
  <body>
    <div class = "container my-5">
        <form method = "POST">
            <div class = "form-group">
                <label>Name</label>
                <input type = "text" class = "form-control" placeholder = "Enter your name" name = "name" autocomplete = "off"><br>
            </div>
            <div class = "form-group">
                <label>Username</label>
                <input type = "text" class = "form-control" placeholder = "Enter your username" name = "username" autocomplete = "off"><br>
            </div>
            <div class = "form-group">
                <label>Password</label>
                <input type = "text" class = "form-control" placeholder = "Enter your password" name = "password" autocomplete = "off"><br>
            </div>
            
<button type = "submit" class = "btn btn-primary" name = "submit">SignUp</button>
</form>
</div>



</body>
</html>