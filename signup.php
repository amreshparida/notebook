<?php
include 'conn.php';

if(isset($_POST['signup']))
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if($pwd != $cpwd)
    {
        echo "Please match your password!!!";
    }
    else
    {
        $enc_pwd = md5($pwd);
        $sql = "INSERT INTO users SET  fullname = '$fullname', email = '$email', pass = '$enc_pwd' ";
        $conn->query($sql);
    }

}


?>
<!DOCTYPE html>
<html>
<body>

<h2>Sign Up Form</h2>


<form action="" method="post">
  <label for="username">Full Name:</label><br>
  <input type="text" id="username" name="fullname"><br>

  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>

  <label for="pwd">Password:</label><br>
  <input type="password" id="pwd" name="pwd"><br>

  <label for="pwd">Confirm Password:</label><br>
  <input type="password" id="pwd" name="cpwd"><br><br>

  <input type="submit" name="signup" value="Sign Up">
</form>

<p>Have an account <a href="index.php">Login</a></p>

</body>
</html>

