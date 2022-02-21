<?php

  include('get.php');
  if(isset($_POST['signup'])){
    $fullname = $_POST['fullname']; 
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    include('avatar.php');
    if($fullname && $username && $password && $gender){
      if($gender == 'boy'){
        $query = query("INSERT INTO `user`(`avatar`,`fullname`,`username`, `password`) VALUES ('$boy_avatar','$fullname','$username','$password')");
      }else{
        $query = query("INSERT INTO `user`(`avatar`,`fullname`,`username`, `password`) VALUES ('$girl_avatar','$fullname','$username','$password')");
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="fullname" id="fullname" placeholder="Fullname"></br>
    <input type="text" name="username" id="username" placeholder="Username"></br>
    <input type="text" name="password" id="password" placeholder="Password">
    <br>
    <label for="">Gender:</label>
    <select name="gender">
      <option value="boy">Boy</option>
      <option value="girl">Girl</option>
    </select>
    <br>
    <input type="submit" value="Signup" name="signup"></br>
    <a href="login.php">Dont have an account? Login</a>
  </form>
</body>
</html>