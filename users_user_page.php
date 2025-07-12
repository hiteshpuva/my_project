<?php
session_start();
include 'connect.php';
include 'header.php';
if(isset($_POST['submit']) && isset($_SESSION['username'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
    
    

    $sql = "INSERT INTO cms_" . $username . "_users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";

    $result = mysqli_query($con,$sql);
    if($result){
        //echo "Data inserted successfully";
        header('location:users_inserted_successfully.php');
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
                <label>NAME</label>
                <input type = "text" class = "form-control" placeholder = "Enter your name" name = "name" autocomplete = "off"><br>
            </div>
            <div class = "form-group">
                <label>EMAIL</label>
                <input type = "email" class = "form-control" placeholder = "Enter your email" name = "email" autocomplete = "off"><br>
            </div>
            <div class = "form-group">
                <label>MOBILE</label>
                <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile number" maxlength="10" pattern="\d{10}" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
<br>
            </div>
            <div class = "form-group">
                <label>PASSWORD</label>
                <input type = "text" class = "form-control" placeholder = "Enter your password" name = "password" autocomplete = "off"><br>
            </div>
                
<button type = "submit" class = "btn btn-primary" name = "submit">Submit</button>
</form>
</div>



</body>
</html>