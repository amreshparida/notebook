<?php
session_start();

include 'conn.php';

if(!isset($_SESSION['email']))
{
    header("Location: index.php");
    exit();
}

$title_e = "";
$content_e = "";

if(isset($_POST['add']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user = $_SESSION['email'];

    $image = $_FILES['image']['name'];
    $target = "images/".time()."_".basename($image);


    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
       
        $sql = "INSERT INTO notes SET  title = '$title', content = '$content', user_email = '$user', img='$target'";
        $conn->query($sql);
        
    }




}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    $sql = "DELETE FROM notes WHERE id = '$id' ";
    $conn->query($sql);
}


if(isset($_GET['edit']))
{
    $edit_id = $_GET['edit'];

    $sql = "SELECT * FROM notes WHERE id = '$edit_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $title_e = $row['title'];
    $content_e = $row['content'];


}

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $note_id = $_GET['edit'];
    $image = $_FILES['image']['name'];
    $target = "images/".time()."_".basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $sql = "UPDATE notes SET  title = '$title', content = '$content',img='$target' WHERE id = '$note_id' ";
    $conn->query($sql);
    }
    header("Location: dashboard.php");

}


?>
<html>
    <body>


        <h2>Welcome, <?php echo $_SESSION['email']; ?></h2>

        <a href="profile.php">My Profile</a>
        <br/>
        <a href="attandence.php">Take Attandence</a>
        <br/>
        <a href="logout.php">Logout</a>
        <br/><br/>



<form method="post" action="" enctype="multipart/form-data">
<label for="title">Title:</label><br>
  <input type="text" id="title" name="title" value="<?php echo $title_e; ?>" ><br>

  <label for="username">Content:</label><br>
  <textarea name="content"><?php echo $content_e; ?></textarea>
  <br/><br/>
  <label>Image Upload</label>
    <br/><br/>
    <input type="file" name="image"><br><br>


  <?php 

  if(isset($_GET['edit']))
  {
      ?>

<input type="submit" name="update" value="Update">

<?php } else { ?>

  <input type="submit" name="add" value="Add">

<?php } ?>

</form>


<br/><br/>


<table>
    <tr>
        <th style="border:1px solid black; padding:6px;">Date</th>
        <th style="border:1px solid black; padding:6px;">Title</th>
        <th style="border:1px solid black; padding:6px;">Content</th>
        <th style="border:1px solid black; padding:6px;">image</th>
        <th style="border:1px solid black; padding:6px;">Action</th>
    </tr>
<?php

$user_email = $_SESSION['email'];
$sql = "SELECT * FROM notes WHERE user_email = '$user_email' ";
$result = $conn->query($sql);


if($result->num_rows > 0)
{

    while($row = $result->fetch_assoc()) {

?>

    <tr>
    <td style="border:1px solid black; padding:6px;"><?php echo date( 'd/m/Y', strtotime($row['created_on'])); ?></td>
        <td style="border:1px solid black; padding:6px;"><?php echo $row['title']; ?></td>
        <td style="border:1px solid black; padding:6px;"><?php echo $row['content']; ?></td>
        <td style="border:1px solid black; padding:6px;"><img src="<?php echo $row['img']; ?>" style="width: 100px; height: 100px;"></td>
        <td style="border:1px solid black; padding:6px;"> 
        <a style="color:red;" href="?delete=<?php echo $row['id']; ?>">Delete</a>  <a href="?edit=<?php echo $row['id']; ?>">Edit</a> </td>
    </tr>

<?php 

    }
}
else{
    echo "<tr><td style='border:1px solid black; padding:6px;' colspan=4>No note found!!!</td></tr>";
}
?>


</table>





    </body>
</html>