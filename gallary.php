<?php
  include("config.php");
  $nav = "gallery";
  include("header.php");
  $get_gallery = "SELECT * FROM `gallery_photo` WHERE 1";
  $gallery = mysqli_query($connect,$get_gallery);
?>

<!DOCTYPE html>
<html lang="en">
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/1140-Outback-Bloomin-Onion-Original.web.360.207.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">GALLARY</h3>
      </div>
    </div>
  </div>
  <!--start gallary section-->
  <div class="container mhj2 padd_t">
    <div class="row jhg trd" id="ty">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo">
        <h3 class="atar">GALLARY</h3>
      </div>
    </div>
  </div>
  <div class="container mhj">
    <div class="row dgtk">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <ul class="lu-style">
          <?php
          while($fetch_image=mysqli_fetch_array($gallery))
            {
          ?>
          <li class="list_li">
            <a class="fancybox" rel="group" href="admin/menu_img/<?php echo $fetch_image['gallery_image']?>"><img
              src="admin/menu_img/<?php echo $fetch_image['gallery_image']?>"
              class="img-thumbnail jsd pad_remv fix_height1" alt="Cinque Terre">
            </a>
          </li>
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <?php
    include("footer.php"); 
  ?>
</body>

</html>