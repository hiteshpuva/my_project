<?php
session_start();
include 'connect.php';
include 'header.php';
if(isset($_GET['updateid']) && isset($_SESSION['username'])){
$id = $_GET['updateid'];
$username = $_SESSION['username'];
}
// THESE ARE THE STATEMENTS THAT ARE CALLED IN THE TEXT BOX
$sql = "select*from cms_".$username."_users where id = $id";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$password = $row['password'];

// THESE STATEMENTS ARE NOT BEING CALLED IN THE TEXT BOX
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "update cms_".$username."_users set id = $id, name = '$name', email = '$email', mobile = '$mobile', password = '$password' where id = $id";
    $result = mysqli_query($con,$sql);
    if($result){
        //echo "Data inserted successfully";
        header('location:users_page_display.php');
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
                <input type = "text" class = "form-control" placeholder = "Enter your name" name = "name" autocomplete = "off" value = <?php echo $name; ?>><br>
            </div>
            <div class = "form-group">
                <label>Email</label>
                <input type = "email" class = "form-control" placeholder = "Enter your email" name = "email" autocomplete = "off" value = <?php echo $email; ?>><br>
            </div>
           <div class="form-group">
    <label>Mobile</label>
    <input type="text" class="form-control" name="mobile" placeholder="Enter your mobile number" 
           maxlength="10" pattern="\d{10}" required 
           oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
           autocomplete="off" 
           value="<?php echo htmlspecialchars($mobile ?? '', ENT_QUOTES); ?>">
    <br>
</div>

            <div class = "form-group">
                <label>Password</label>
                <input type = "text" class = "form-control" placeholder = "Enter your password" name = "password" autocomplete = "off" value = <?php echo $password ?>><br>
            </div>
                
<button type = "submit" class = "btn btn-primary" name = "submit">Update</button>
</form>
</div>



</body>
</html>