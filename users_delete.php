<?php
session_start();
include 'connect.php';

if(isset($_GET['deleteid']) && isset($_SESSION['username'])){
    $id = $_GET['deleteid'];
    $username = $_SESSION['username'];
    $_SESSION['id'] = $id;

    $sql = "delete from cms_".$username."_users where id = $id";
    $result = mysqli_query($con,$sql);
    if($result){
        header('location:users_page_display.php');
    }else{
        die(mysqli_query($con,$sql));
    }
}
?>
