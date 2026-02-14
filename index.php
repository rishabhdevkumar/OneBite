<?php
<<<<<<< HEAD

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
=======
>>>>>>> a8a0eae980a8a81368bb43a21ec0855de1541cfa
  include("config.php");
  $nav = "home";
  include("header.php"); 
  $id = $_SESSION['category_id'];
?>

<!DOCTYPE html>
<html lang="en">
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active htt">
        <img src="image/pasta-puttanesca-horiz-c-1800.jpg" alt="">
        <div class="carousel-caption">
          <h3 class="abt_width1">WELCOME TO BURGATORY</h3>
          <button style="border: none" type="button" class="btn btn-danger btn-md dfa kjai">VIEW OUR MENUS</button>
        </div>
      </div>
      <div class="item htt">
        <img src="image/1515456591895.jpg" alt="">
        <div class="carousel-caption">
          <h3 class="abt_width1">WELCOME TO BURGATORY</h3>
          <button style="border: none" type="button" class="btn btn-danger btn-md dfa kjai">VIEW OUR MENUS</button>
        </div>
      </div>
      <div class="item htt">
        <img src="image/pexels-pixabay-461382.jpg" alt="">
        <div class="carousel-caption">
          <h3 class="abt_width1">WELCOME TO BURGATORY</h3>
          <button style="border: none" type="button" class="btn btn-danger btn-md dfa kjai">VIEW OUR MENUS</button>
        </div>
      </div>
      <div class="item htt">
        <img src="image/pexels-snappr-27365296.jpg" alt="">
        <div class="carousel-caption">
          <h3 class="abt_width1">WELCOME TO BURGATORY</h3>
          <button style="border: none" type="button" class="btn btn-danger btn-md dfa kjai">VIEW OUR MENUS</button>
        </div>
      </div>
      <div class="item htt">
        <img src="image/davide-cantelli-jpkfc5_d-DI-unsplash.jpg" alt="">
        <div class="carousel-caption">
          <h3 class="abt_width1">WELCOME TO BURGATORY</h3>
          <button style="border: none" type="button" class="btn btn-danger btn-md dfa kjai">VIEW OUR MENUS</button>
        </div>
      </div>
    </div>
    <a class="left carousel-control acb" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
   <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
          $get_menus = "SELECT * FROM `categories` WHERE 1 ORDER BY RAND() LIMIT 0,3";
          $run_menus = mysqli_query($connect, $get_menus);
          while($menu = mysqli_fetch_array($run_menus)) { 
        ?>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
            <div class="col-12 col-sm-12 col-xs-12 fix_height pad_rem opb1">
              <img src="admin/menu_img/<?php echo $menu['banner_image']; ?>" class="img-thumbnail jsd pad_remv"
                alt="<?php echo $menu['name']; ?>">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 opo">
              <p class="pob">
                <?php echo $menu['name'];?>
              </p>
              <p class="undr_line"></p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 cbc">
              <p>
                <?php echo $menu['description']; ?>
              </p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 www">
              <a href="menus.php?category_id=<?php echo base64_encode($menu['id']); ?>">
                <button type="button" class="btn btn-danger btn-md dfa">VIEW MORE</button>
              </a>
            </div>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
  <!--start daily section-->
  <div class="container mhj">
    <div class="row jhg trd" id="ty">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo">
        <h3 class="atar">Daily Specials</h3>
        <p class="uuu">Featuring the best dishes from our menu</p>
      </div>
    </div>
  </div>
  <div class="container mhj">
    <div class="row dgtk">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo1">
        <p class="asa">FEATURED</p>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
          include("config.php");
          $get_menus = "SELECT * FROM `menu` WHERE status='y' ORDER BY RAND() LIMIT 3";
          $run_menus = mysqli_query($connect, $get_menus);

          if (mysqli_num_rows($run_menus) > 0) {
            while($menu = mysqli_fetch_array($run_menus)) { 
        ?>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
            <div class="col-md-12 col-sm-12 col-xs-12 cbc item1 fix_height pad_rem opb1">
              <span class="notify-badge">
                <i class="fa fa-inr jhdqa" aria-hidden="true"></i>
                <?php echo $menu['menu_price']; ?>
              </span>
              <img src="admin/menu_img/<?php echo $menu['menu_image']; ?>" class="img-thumbnail jsd pad_remv"
                alt="<?php echo $menu['menu_title']; ?>">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 ma">
              <h5 class="text_c margin_t">
                <?php echo strtoupper($menu['menu_title']); ?>
              </h5>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <p class="marg_left">
                <?php echo $menu['menu_description']; ?>
              </p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h5 class="marg_left text_c">
                <a href="menus.php?category_id=<?php echo base64_encode($menu['category_id']); ?>"
                  style="text-decoration:none; color:inherit;">
                  Read More &#8594;
                </a>
              </h5>
            </div>
          </div>
        </div>
        <?php 
          } 
            } else {
           echo "<p style='text-align:center; color:red;'>No menu items found!</p>";
          }
        ?>
      </div>
    </div>
  </div>
  <!--start video section-->
  <div class="container-fluid text-center">
    <div class="row text-center">
      <div class="col-md-12 col-md-12 col-xs-12 text_center nopadd video_sec">
        <div class="col-md-6 col-sm-12 col-xs-12 pull-left">
          <div class="col-md-12 col-sm-12 col-xs-12 ">
            <h5 class="paddtop font_size">Italian Chef Taste Test</h5>
            <p class="text_adj">
              One of our favorite things to do is taken a person with an exceptional plate and make them eat or drink
              with us plebes actually buy day-to-day.
              We do it for two reasons.First,we like to torture people.Two,it helps us khow which product to buy the
              next time we're at the grocery store.so to find the best tomato sauce at supermarket we want to acclaimed
              italian chef steve samson.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 text-center ">
          <div class="col-md-12 col-sm-12 col-xs-12 text-center pad_rem">
            <iframe src="https://www.youtube.com/embed/sWisuBtbypE" frameborder="0" allow="autoplay; encrypted-media"
              allowfullscreen class="marg_tp video_wid"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--stat popular section-->
  <div class="container ">
    <div class="row jhg trd1" id="ty">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo3">
        <h3 class="atar1">POPULAR MENU</h3>
        <p class="uuu">Come and Test our speceial dishes</p>
      </div>
    </div>
  </div>
  <div class="container pdd_mar">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo1">
        <p class="asa">POPULAR MENU</p>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <?php
          $get_menus = "SELECT * FROM `menu` ORDER BY RAND() LIMIT 3";
          $run_menus = mysqli_query($connect, $get_menus);
          while($menu = mysqli_fetch_array($run_menus)) { 
        ?>
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
            <div class="col-md-12 col-sm-12 col-xs-12 cbc item1 fix_height pad_rem opb1">
              <span class="notify-badge">NEW</span>
              <img src="admin/menu_img/<?php echo $menu['menu_image']; ?>" class="img-thumbnail jsd pad_remv"
                alt="<?php echo $menu['menu_title']; ?>">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
              <h5 class="dhhkd margin_t1">
                <?php echo strtoupper($menu['menu_title']); ?>
              </h5>
              <p class="undr_line"></p>
              <h5 class="marg_left3 text_c font_w">
                <i class="fa fa-inr jhdqa" aria-hidden="true"></i>
                <?php echo $menu['menu_price']; ?>
              </h5>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center marg-t">
              <p class="marg_left">
                <?php echo $menu['menu_description']; ?>
              </p>
              <p class="undr_line"></p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center marg-t www">
              <a href="menus.php?category_id=<?php echo base64_encode($menu['category_id']); ?>">
                <button type="button" class="btn btn-danger bt_style">VIEW MORE</button>
              </a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!--start latest news section-->
  <div class="container ">
    <div class="row jhg trd2" id="ty">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo3">
        <h3 class="atar1">Latest News</h3>
        <p class="uuu">Bringing you the latest in cuisine and culture</p>
      </div>
    </div>
  </div>
  <div class="container marr_top">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-md-12">
        <div class="col-md-6 col-sm-12 col-xs-12 text-center">
          <div class="col-md-12 col-sm-12 col-xs-12 text-center item1 pad_rem border_st">
            <div class="col-md-12 col-sm-12 col-xs-12 img_hight text-center item1 pad_rem opb1">
              <span class="notify-badge top_mar left_mar">Packed with tons of features such as Google Fonts,Font Awesome
                4 and Typicons</span>
              <img src="image/NewYork.jpg" class="img-thumbnail jsd pad_remv" alt="Cinque Terre">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 ">
              <div class="col-md-4 col-sm-12 col-xs-12 xxz aswk clearfix pull-left">
                <div class="col-md-12 col-sm-12 col-xs-12 kop">
                  <h4 class="font_siz kgd">18 SEP 2014</h4>
                  <p> <i class="fa fa-comment kgd" aria-hidden="true"></i> 0 comments</p>
                  <p class="mar-rx kgd">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    Tweets this
                  </p>
                  <p class="mar-lf kgd"> <i class="fa fa-pencil" aria-hidden="true"></i> Post a comment</p>
                </div>
              </div>
              <div class=" clearfix  col-md-8 col-sm-12 col-xs-12 m1-top1 madw pull-right">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <p class="tdga">
                    vienna a premium resturant wordpress
                    theme develop by micro themes and
                    design for resturant and bar owners.
                    vienna a premium resturant wordpress
                    theme develop by micro themes and
                    design for resturant and bar owners.
                  </p>
                  <h5 class="marg_left2 text_c">Continue Reading &#8594;</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 text-center">
          <div class="col-md-12 col-sm-12 col-xs-12 text-center item1 pad_rem border_st">
            <div class="col-md-12 col-sm-12 col-xs-12 img_hight text-center item1 pad_rem opb1">
              <span class="notify-badge top_mar left_mar">Start selling your own items, recipe books or utensils with
                Woocommerce</span>
              <img src="image/first-1.jpg" class="img-thumbnail jsd pad_remv" alt="Cinque Terre">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-4 col-sm-12 col-xs-12 xxz aswk clearfix pull-left">
                <div class="col-md-12 col-sm-12 col-xs-12 kop">
                  <h4 class="font_siz kgd">16 SEP 2014</h4>
                  <p> <i class="fa fa-comment kgd" aria-hidden="true"></i> 0 comments</p>
                  <p class="mar-rx kgd">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    Tweets this
                  </p>
                  <p class="mar-lf kgd"> <i class="fa fa-pencil" aria-hidden="true"></i> Post a comment</p>
                </div>
              </div>
              <div class=" clearfix  col-md-8 col-sm-12 col-xs-12 m1-top1 madw pull-right">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <p class="tdga">
                    vienna a premium resturant wordpress
                    theme develop by micro themes and
                    design for resturant and bar owners.
                    vienna a premium resturant wordpress
                    theme develop by micro themes and
                    design for resturant and bar owners.
                  </p>
                  <h5 class="marg_left2 text_c">Continue Reading &#8594;</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    include("footer.php"); 
  ?>
  
</body>

</html>