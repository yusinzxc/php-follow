<?php
  $session_id = $_SESSION['uid'];
  $query = query("SELECT * FROM follow WHERE user_id = $session_id");
  while($records = $query->fetch_assoc()){
    $following_id = $records['following_id'];
    $f_data_user = allData(query("SELECT * FROM USER WHERE user_id = $following_id"));
    $f_data_post = allData(query("SELECT * FROM post WHERE user_id = $following_id"));
?>

        <!-- MAIN --> 
        <div class="container p-4 bg-white rounded-2 shadow-sm d-flex">
          <div>
            <img src="<?php echo $f_data_user['avatar'] ?>" alt="" style="height: 40px; width: 40px;" class="rounded-circle">
          </div>
          <div class="container">
            <!-- PROFILE AUTHOR -->
            <div>
              <span class="fs-6 fw-bold"><?php echo $f_data_user['fullname'] ?></span>
              <span class="fs-6 text-muted">@<?php echo $f_data_user['username'] ?></span>
              <span class="fs-6 text-muted"> - <?php echo $f_data_post['date'] ?></span>
            </div>
            <!-- CAPTION/IMAGES -->
            <div>
              <p><?php echo $f_data_post['caption'] ?></p>
              <hr>
              <center>
                <div class="card p-2 shadow-sm">
                  <img src="<?php echo $f_data_post['image_video'] ?>" alt="" class="img-fluid">
                </div>
              </center>
            </div>
            <!-- BUTTONS -->
            <div class="d-flex flex-row py-3" style="gap: 20px;">
             <div class="text-muted">
               <!-- comments -->
               <i class="fa-regular fa-comment"></i>
               <span>0</span>
             </div> 
             <div class="text-muted">
               <!-- re-tweet -->
               <i class="fa-regular fa-retweet"></i>
               <span>0</span>
             </div> 
             <div class="text-muted">
               <!-- likes -->
               <i class="fa-regular fa-heart"></i>
               <span>0</span>
             </div> 
             
             <div class="text-muted">
               <!-- likes -->
               <i class="fa-regular fa-bookmark"></i>
             </div> 
            </div>
          </div>
        </div>
 

<?php }?>