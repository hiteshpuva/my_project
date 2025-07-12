<?php
session_start();
if(isset($_SESSION['name'])){
    $name = $_SESSION['name'];
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello <?php print_r($name);?> .You Have signed up successfully</h1><br>
    <a href="index.php">CLICK HERE TO LOGIN</a>

    
</body>
</html>