<?php
  include('get.php');
  session_start();
  $session_id = $_SESSION['uid'];
  $session_records = allData(query("SELECT * FROM user WHERE user_id = $session_id"));
  $followers = rows("SELECT * FROM follow WHERE following_id = $session_id");
  $following = rows("SELECT * FROM follow WHERE user_id = $session_id");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.0.0/css/all.css">
    <title>Profile</title>
  </head>
  <body>
    <a href="/">feed</a>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4 border">
          <div class="">
            <h1 class="fw-light">Profile</h1>
            <hr>
          </div>
          
          <!-- PROFILE -->
          <div class="d-flex flex-row" style="gap: 20px;">
            <div>
              <h3 class="fw-light"><?php echo $session_records['username'] ?></h3>
            </div>
            <!-- COUNT -->
            <div class="d-flex flex-row justify-content-between" style="gap: 15px;">
              <div class="d-flex flex-column justifY-content-center align-items-center">
                <h6 class="fw-light">Followers</h6>
                <span class="text-muted"><?php echo $followers ?></span>
              </div>
              <div class="d-flex flex-column justifY-content-center align-items-center">
                <h6 class="fw-light">Following</h6>
                <span class="text-muted"><?php echo $following ?></span>
              </div>
              <div>
                <a href="editprofile.php">
                  <i class="fa-thin fa-gear"></i>
                </a>
              </div>
            </div>
          </div>
          <hr>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
