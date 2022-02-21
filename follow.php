<?php
  session_start();
  if(!empty($_GET['fid'])){
  
    include('get.php');
    $session_id = $_SESSION['uid'];
    $following_id = $_GET['fid'];
    $query = query("INSERT INTO `follow`(`user_id`, `following_id`) VALUES ('$session_id','$following_id')");
    if($query){
      header('location: /');
    }

  }else {
    header('location: index.php');
  }

?>