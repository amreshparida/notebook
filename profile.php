<?php
session_start();

include 'conn.php';

if(!isset($_SESSION['email']))
{
    header("Location: index.php");
    exit();
}


if(isset($_POST['upload']))
{
    $image = $_FILES['image']['name'];
    $target = "images/".time()."_".basename($image);


    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
       
        $user_email = $_SESSION['email'];
        $sql = "UPDATE users SET profile_img = '$target' WHERE email = '$user_email' ";
        $conn->query($sql);
    }

}







?>

<html>
    <body>


    <div >

    <b>My Profile Pic</b>

    <?php
$user_email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

?>


<h3><?php echo $row['fullname']; ?></h3>
    <img src="<?php echo $row['profile_img']; ?>" style="width:100px; height: 100px;" />

    </div>


    <br/>



    <form method="POST" action="" enctype="multipart/form-data">

    <label>Image Upload</label>
    <br/><br/>
    <input type="file" name="image">

    <br/><br/>

    <input type="submit" value="Upload" name="upload" />



    </form>

    </body>
</html>