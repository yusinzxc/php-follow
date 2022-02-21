<?php
  session_start();
  $session_id = $_SESSION['uid'];
  if(!empty($_POST)){
    include('get.php');
    $caption = htmlspecialchars($_POST['caption'], ENT_QUOTES, 'UTF-8');
    $file = $_FILES['file'];
    
    if($caption && $file['name'] !== ""){

      $path = "./post_f/";
      $tmp = $file['tmp_name'];
      date_default_timezone_set("Asia/Manila");
      $date = date("h:i:sa");
      if($tmp !== ""){

        $name = $file['name'];
        $newpath = $path.$name;
        if(move_uploaded_file($tmp, $newpath)){ 
          include('db.php');
          if(query("INSERT INTO `post`(`user_id`, `image_video`, `caption`, `date`) VALUES ('$session_id','$newpath','$caption','$date')")){
            header('location: index.php');
          }

        }

      }

    }else {
      header('location: index.php');
    }

  }else {
    header('location: index.php');
  }

?>