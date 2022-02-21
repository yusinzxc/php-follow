<?php

  $db_host = 'localhost';
  $db_user = 'root';
  $db_pass = '';
  $db_name = 'twitter';

  $con = new mysqli($db_host,$db_user,$db_pass, $db_name);
  if($con->connect_error){
    echo $con->connect_error;
  }

?>