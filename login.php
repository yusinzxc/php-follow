<?php 
  session_start();
  include('get.php');

  if(isset($_SESSION['uid'])){
    header('location: /');
  }

  if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username && $password){
      $check_query = query("SELECT * FROM user WHERE username = '$username'");
      if($check_query->num_rows > 0){
        $data = allData($check_query);
        if($data['password'] == $password){
          header('location: index.php');
          $_SESSION['uid'] = $data['user_id'];
        }else {
          echo "WRONG PASSWORD";
        }
      }else {
        echo "USERNAME NOT EXIST";
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
  <title>Login</title>
</head>
<body>
  <form action="" method="post">
    <input type="text" name="username" id="username" placeholder="Username"></br>
    <input type="text" name="password" id="password" placeholder="Password">
    <input type="submit" value="Login" name="login"></br>
    <a href="signup.php">Dont have an account? Sign Up</a>
  </form>
</body>
</html>