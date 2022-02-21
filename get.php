<?php 
  function query($sql){
    include('db.php');
    return $con->query($sql);
  }
  function allData($query){
    include('db.php');
    return $query->fetch_assoc();
  }
  function rows($sql){
    $query = query("$sql");
    return $query->num_rows;
  }
?>