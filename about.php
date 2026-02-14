<?php
  include("config.php");
  $nav = "about";
  include("header.php");
  $select_abt = "SELECT * FROM `about_us` WHERE 1 LIMIT 1";
  $run = mysqli_query($connect, $select_abt);
  $fetch = mysqli_fetch_array($run);
?>

<!DOCTYPE html>
<html lang="en">
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/goa-dining-banner.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">ABOUT US</h3>
        <p class="kkk1">THIS IS A TEST</p>
      </div>
    </div>
  </div>
  <!-- start section element -->
  <div class="container padd_t">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- <h3 class="text_c" style="text-align: center;"><b>ABOUT US</b></h3> -->
        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: justify;">
          <?php echo $fetch['content']; ?>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 abt_img_height text-center">
         <img src="admin/upload/<?php echo $fetch['image']?>">
        </div>
      </div>
    </div>
  </div>
  <?php
    include("footer.php"); 
  ?>
  
</body>
<!-- C:\xampp\htdocs\burgatory\admin\upload -->
</html>