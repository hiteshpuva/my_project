<?php
session_start();
include("connection.php");
if(isset($_POST['submit'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $_SESSION['username'] = $username;
    //print_r($_POST);
    //print_r($username);
    //print_r($password);
    $sql = "select * from cms_user_details where username = '$username' and password = '$password'";
    //print_r($sql);
    $result = mysqli_query($conn,$sql);
    //print_r($result);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //print_r($row);
    $count = mysqli_num_rows($result);
    //print_r($count);
    if ($count == 1){
        header("Location:dashboard_page.php");
        exit();
    }
    else{
        //echo"Login Failed";
        echo '<script>
        window.location.href = "index.php";
        alert("Login Falied. Invalid username or password!!!")
        </script>';
    }
}


?>