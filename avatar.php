<?php

  $path_avatar_b = array('/avatar/boy/1.jpg','/avatar/boy/2.jpg','/avatar/boy/3.jpg');
  $path_avatar_g = array('/avatar/girl/1.jpg','/avatar/girl/2.jpg','/avatar/girl/3.jpg');
  function avatar($path_avatar){
    $randomAvatar = array_rand($path_avatar, 1);
    return $path_avatar[$randomAvatar];
  }
  $girl_avatar = avatar($path_avatar_g);
  $boy_avatar = avatar($path_avatar_b);
?>