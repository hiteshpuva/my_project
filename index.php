<?php
include("connection.php");

?>

<!DOCTYPE html>
<div class="container"></div>
<button class = "btn btn-primary my-5"><a href = "signup_form.php" class = "text-light">
SIGN UP</a>
</button>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-qruiv = "X-UA-Compatible" content = "IE-edge">
        <meta name = "viewpoint" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>
    
    <body>
        
        <div id="form">
            <h1>Login Form</h1>
            
            <form name = "form" action = "login.php" onsubmit = "return isvallid()" method = "POST">
                <label>Username</label>
                <input type = "text" id = "user" name = "user" autocomplete = "off"><br><br>
                <label>Password</label>
                <input type = "password" id = "pass" name = "pass" autocomple = "off"><br><br>
                <input type="submit" id="btn" value="Login" name="submit">
</form>

</div>

<script>
/*
document.write("The cursor is sucessfully inside the javascript code");
function isvalid() {
    document.write("The javascript has checked that the cursor is inside the function isvalid()");
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;

    if (!user && !pass) {
        alert("Username and password fields are empty!!!");
        return false;
    }
    if (!user) {
        alert("Username is empty!!!");
        return false;
    }
    if (!pass) {
        alert("Password is empty!!!");
        return false;
    }

    return true; // Allow form submission if inputs are valid
}
*/
</script>
</body>
<html>