<?php
session_start();
include 'conn.php';
if(isset($_POST['login']))
{
    
    $email = $_POST['email'];
    $pwd = md5($_POST['pwd']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND pass = '$pwd'  ";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
    }
    else
    {
        echo 'Password not matched!!!';
    }

}


?>



<!DOCTYPE html>
<html>
<body>

<h2>Login</h2>


<form action="" method="post">
  <label for="username">Email:</label><br>
  <input type="email" id="username" name="email"><br>
  <label for="pwd">Password:</label><br>
  <input type="password" id="pwd" name="pwd"><br><br>
  <input type="submit" name="login" value="Login">
</form>

<p>Create an account <a href="signup.php">Sign Up</a></p>

</body>
</html>

