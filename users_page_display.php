<?php
include 'connect.php';
include 'header.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATION</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel = "stylesheet">
    
</head>
<body>
    
<div class="container"></div>
<button class = "btn btn-primary my-5"><a href = "users_user_page.php" class = "text-light">
ADD USER</a>
</button>

</button>
<table class="table">
  <thead>
    <tr>
      <th scope = "col">ID</th>
      <th scope = "col">NAME</th>
      <th scope = "col">EMAIL</th>
      <th scope = "col">MOBILE</th>
      <th scope = "col">PASSWORD</th>
      <th scope = "col">OPERATIONS</TH>
    </tr>
  </thead>
  <tbody>

<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    print_r($username);
    //$_SESSION['id'] = $id;
}
$sql = "select*from cms_".$username."_users";
//print_r($_SESSION);
$result = mysqli_query($con,$sql);
if($result)
{
    while($row = mysqli_fetch_assoc($result)){
    $id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $password = $row['password'];
    echo '<tr>
      <th scope="row">'.$id.'</th>
      <td>'.$name.'</td>
      <td>'.$email.'</td>
      <td>'.$mobile.'</td>
      <td>'.$password.'</td>
      <td>
        <button class="btn btn-primary"><a href="users_update.php?updateid='.$id.'" class="text-light">Update</a></button>
        <button class="btn btn-danger text-light" onclick="confirmUserDelete('.$id.')">Delete</button>
      </td>
    </tr>';

    
  }
    
}

//}
?>



  </tbody>
</table>

<script>
  function confirmUserDelete(id) {
  if (confirm("Are you sure you want to delete this user?")) {
    window.location.href = 'users_delete.php?deleteid=' + id;
  }
}
</script>


</body>
</html>