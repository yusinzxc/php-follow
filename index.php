<?php
  session_start();
  if(isset($_SESSION['uid'])){
    include('get.php');
    $session_id = $_SESSION['uid'];
    $session_data = allData(query("SELECT * FROM user WHERE user_id = $session_id"));
    $s_avatar = $session_data['avatar'];
    $s_fullname = $session_data['fullname'];
    $s_username = $session_data['username'];
    $s_password = $session_data['password'];

    function checkFollowed($session_id,$u_id){
      return query("SELECT * FROM follow WHERE user_id = $session_id AND following_id = $u_id");
    }

    $followers = rows("SELECT * FROM follow WHERE following_id = $session_id");
    $following = rows("SELECT * FROM follow WHERE user_id = $session_id");
  }else {
    header('location: login.php');
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.0.0/css/all.css">
    <title>Feed</title>
  </head>
  <body class="bg-light">
    <div class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3 sticky-top">
      <div class="container-fluid">
        <a href="" class="nav-brand">
          <i class="fa-brands fa-twitter text-primary fs-3"></i>
          <ul class="navbar-nav d-flex justify-content-end">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fa-solid fa-magnifying-glass"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo $s_avatar ?>" alt="" class="rounded-circle" style="height: 25px; width:25px;">
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </a>
      </div>
    </div>
    <div class="row m-4" style="gap: 10px;">
    <!-- SIDENAV -->
      <div class="col-3 d-flex flex-column" style="gap: 15px;">
      <!-- PROFILE -->
        <div class="container shadow-sm rounded-2 bg-white p-4" style="padding: 30px 10px;">
          <img src="<?php echo $s_avatar ?>" alt="" style="height: 40px; width: 40px;" class="rounded-circle">
          <h4><?php echo $s_fullname ?></h4>
          <span class="text-muted">@<?php echo $s_username ?></span> 
          <div class="d-flex" style="gap: 10px;">
            <div>
              <span class="fw-bold"><?php echo $following?></span>
              <span class="text-muted">Following</span>
            </div>
            <div>
              <span class="fw-bold"><?php echo $followers ?></span>
              <span class="text-muted">Followers</span>
            </div>
          </div>
        </div>
        <!-- LINKS -->
        <div class="container d-flex flex-column shadow-sm rounded-2 bg-white p-4" style="gap: 30px;">
          <a href="" class="text-decoration-none text-dark">        
            <div class="d-flex align-items-center" style="gap: 10px;">
              <i class="fa-solid fa-house fs-5 text-primary"></i>
              <span class="fs-5 text-primary">Home</span>
            </div>
          </a>
          <a href="" class="text-decoration-none text-dark">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <i class="fa-regular fa-hashtag fs-5"></i>
              <span class="fs-5">Explore</span>
            </div>
          </a>
          <a href="" class="text-decoration-none text-dark">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <i class="fa-regular fa-bell fs-5"></i>
              <span class="fs-5">Notification</span>
            </div>
          </a>
          <a href="" class="text-decoration-none text-dark">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <i class="fa-regular fa-square-ellipsis fs-5"></i>
              <span class="fs-5">More</span>
            </div> 
          </a>
          <hr>
          <div>
            <center>
              <button class="btn btn-primary w-50">Tweet</button>
            </center>
          </div>
        </div>
      </div>
    <!-- CONTENT -->
      <div class="col vh-100 d-flex flex-column" style="gap: 20px;">
        <!-- CREATE POST -->
        <form method="POST" action="post.php" enctype="multipart/form-data">
        <div class="container p-4 bg-white rounded-2 shadow-sm">
          <div class="container">
            <textarea name="caption" id="" cols="30" rows="5" class="w-100 p-3 fs-3" placeholder="What's on your mind ?"></textarea> 
          </div>
         <div class="container d-flex align-items-center justify-content-between py-2">
            <div class="d-flex align-items-center" style="gap: 10px;">
              <input type="file" name="file" id="" class="border-end pe-3">
              <i class="fa-light fa-face-laugh text-muted"></i>
            </div> 
            <div class="">
              <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-feather-pointed"></i> Tweet</button>
            </div>
          </div>
        </div>
        </form>
        <!-- MAIN --> 
        <?php include('getFollowed.php') ?>
        
      </div>
    <!-- WHO FOLLOW -->
      <div class="col-3 vh-100">
        <div class="bg-white rouded-2 shadow-sm p-4 d-flex flex-column" style="position: relative; gap: 15px;">
          <div>
            <h5 class="fw-bold">Who to follow</h5>
            <hr class="text-muted">
          </div>
          <!-- FOLLOW USER -->
          <?php
            $getToFollow = query("SELECT * FROM user WHERE NOT user_id = $session_id");
            while($records = $getToFollow->fetch_assoc()){
              $u_id = $records['user_id'];
              $u_avatar = $records['avatar'];
              $u_fullname = $records['fullname'];
              $u_username = $records['username'];
              $u_password = $records['password'];
          ?>
              <div class="d-flex align-items-center" style="gap: 10px;">
                <div>
                  <img src="<?php echo $u_avatar ?>" alt="" style="height: 45px; width:45px;" class="rounded-circle">
                </div>
                <div class="d-flex flex-column">
                  <span class="fs-6 fw-bold"><?php echo $u_fullname ?></span>
                  <span class="text-muted">@<?php echo $u_username?></span>
                </div>
                <div class="pe-3" style="position: absolute; right:0;">
                  <?php 
                    if(checkFollowed($session_id, $u_id)->num_rows > 0){
                      echo "<a class='btn btn-primary disabled'>Followed</a>";
                    }else{
                      echo "<a href='follow.php?fid=$u_id' class='btn btn-primary'>Follow</a>";
                    } 
                  ?>
                </div>
              </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
