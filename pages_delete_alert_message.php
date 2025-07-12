<?php
session_start();
include 'header.php';
include 'connect.php';

if(isset($_GET['deleteid']) && isset($_SESSION['username'])){
    print_r($_SESSION);
    $id = $_GET['deleteid'];
    $username = $_SESSION['username'];
   
print_r($id);
$title_sql = "SELECT title FROM cms_" . $username . "_pages WHERE id = " .$id;
$title_sql_success = mysqli_query($con,$title_sql);

$description_sql = "SELECT description FROM cms_" . $username . "_pages WHERE id = " . $id;
$description_sql_success = mysqli_query($con, $description_sql);


$created_at_sql = "select created_at from cms_".$username."_pages where id =".$id;
$created_at_sql_success = mysqli_query($con,$created_at_sql);

// As featured image is a button it will not come here

$status_sql = "select status from cms_".$username."_pages where id =".$id;
$status_sql_success = mysqli_query($con,$status_sql);

if($title_sql_success && $description_sql_success && $created_at_sql_success && $status_sql_success){
                $row1 = mysqli_fetch_assoc($title_sql_success);
                $row2 = mysqli_fetch_assoc($description_sql_success);
                $row3 = mysqli_fetch_assoc($created_at_sql_success);
                $row4 = mysqli_fetch_assoc($status_sql_success);
                $title = (string) $row1['title'];
                $description = (string) $row2['description'];
                $created_at = (string) $row3['created_at'];
                $status = (string) $row4['status'];
                

                
            }
/*
print_r($title);echo"<br>";
print_r($description);echo"<br>";
print_r($created_at);echo"<br>";
print_r($status);echo"<br>";
*/
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGES DELETE ALERT MESSAGE</title>
</head>
<body>
    <h3>DO YOU WANT TO DELETE THE BELOW RECORD?</h3>

    <table border="1" cellpadding="5" cellspacing="3">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Featured Image</th>
            <th>created at</th>
            <th>Status</th>
        </tr>
     <tr>
            <td><?php print_r($id);?></td>
            <td><?php print_r($title);?></td>
            <td><?php print_r($description);?></td>
            <td><a href="http://localhost/INTETRNSHIP FILES/CMS/images/<?php echo $username . '_' . $id; ?>.jpg" class="btn btn-primary text-light">IMAGE</a></td>

            <td><?php print_r($created_at);?></td>
            <td><?php print_r($status);?></td>
        </tr>
        
    </table>
<td>
    
    <a href="pages_delete.php?deleteid=<?php print_r($id); ?>" class="btn btn-danger text-light">DELETE</a>
    <a href="pages_page_display.php" class="btn btn-primary text-light">CANCEL</a>

</td>
    
</body>
</html>
