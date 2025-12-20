<?php
  include("config.php");
  $nav = "menu";
  include("header.php");
  $category_id = isset($_GET['category_id']) ? base64_decode($_GET['category_id']) : 0;
  $get_categories = "SELECT * FROM categories WHERE status='y'";
  $run_categories = mysqli_query($connect, $get_categories);

  if ($category_id == 0 && $row = mysqli_fetch_array($run_categories)) {
    $category_id = $row['id'];
    mysqli_data_seek($run_categories, 0);
  }
  $get_menus = "SELECT * FROM menu WHERE status='y' AND category_id='" . mysqli_real_escape_string($connect, $category_id) . "'";
  $run_menus = mysqli_query($connect, $get_menus);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script>
    function change_category_color_by_id(temp) {
      const category = temp;
      const value = 'category=' + category;
      $.ajax({
        url: "category_menu_ajax.php",
        type: "POST",
        data: value,
        success: function (data) {
          $(".menu_margin").html(data);

          $(".menu-btn").removeClass("color_act");
          $("button[onclick*='" + temp + "']").addClass("color_act");
        },
        error: function (jqXHR, textstatus, errorThrown) {
          console.log(textstatus, errorThrown);
        }
      });
    }

    function get_city_by_state(temp) {
      const state = temp;
      const value = 'state=' + state;
      $.ajax({
        url: "city_ajax.php",
        type: "POST",
        data: value,
        success: function (data) {
          $("#city").html(data);
        },
        error: function (jqXHR, textstatus, errorThrown) {
          console.log(textstatus, errorThrown);
        }
      })
    }

    function add_cart(p_id, catid){
    //$('#preloader').show();

    const menu_id = p_id;
    const category_id = catid;

    const dataString = 'p_id=' + menu_id + '&cat_id=' + category_id;

    $.ajax({
        type: "POST",
        url: "add_cart.php",
        data: dataString,
        success: function(data){
            const response = data.split("|");
            $('#item_cart').text(response[0]);
            $('#fd').html(response[1]);
            $('#preloader').hide();
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus, errorThrown);
        }
    });
}

    // function item_remove2(p_id){
    //   const menu_id = p_id;
    //   const dataString = 'p_id='+ menu_id;

    //   $.ajax({
    //     type: "POST",
    //     url: "ajax_item_remove.php",
    //     data: dataString,
    //     success: function (data){
    //       const response=data.split("|");
    //       $('#item_cart').text(response[0]);
    //       $('#fd').html(response[1]);
    //     }
    //     error: function(jqXHR, textStatus, errorThrown){
    //       console.log(textStatus, errorThrown);
    //     }
    //   });
    // }
  </script>

</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/glenov-brankovic-e4B5AvA7Jqo-unsplash.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">MENU</h3>
      </div>
    </div>
  </div>
  <!--start menu section-->
  <div class="container mhj2 padd_t">
    <div class="row jhg trd" id="ty">
      <div class="col-md-12 col-sm-12 col-xs-12 gfo">
        <h3 class="atar">MENUS</h3>
        <p class="uuu">Featuring the best dishes from our menu</p>
      </div>
    </div>
  </div>
  <style>
    .menu-btn.color_act {
      background-color: skyblue;
      color: black;
      font-weight: bold;
      border: 1px dotted green;
    }
  </style>
  <!--select button section-->
  <div class="container">
    <div class="row sel_but_row" style="margin-top: -130px;">
      <div class="col-md-12 sel_but_col">
        <?php while ($fetch_category = mysqli_fetch_array($run_categories)) { ?>
        <button class="menu-btn <?php if ($fetch_category['id'] == $category_id) echo 'color_act'; ?>"
          data-id="<?php echo $fetch_category['id']; ?>"
          onclick="change_category_color_by_id('<?php echo $fetch_category['id']; ?>')">
          <?php echo $fetch_category['name']; ?>
        </button>
        <?php } ?>
      </div>
    </div>
  </div>
  <!--menu card section-->
  <div class="container mhj">
    <div class="row dgtk">
      <div id="preloader"></div>
      <div class="col-md-12 col-sm-12 col-xs-12 menu_margin" id="ad">
        <?php if(mysqli_num_rows($run_menus) > 0){
            while ($menu = mysqli_fetch_array($run_menus)) { ?>
        <div class="col-md-4 col-sm-12 col-xs-12" id="menu-btn">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
            <div class="col-md-12 col-sm-12 col-xs-12 cbc item1 fix_height pad_rem opb1">
              <?php if($menu['is_new'] == 'y'){ ?>
              <span class="notify-badge1">NEW</span>
              <?php } ?>
              <span class="notify-badge">
                <i class="fa fa-inr jhdqa" aria-hidden="true"></i>
                <?php echo $menu['menu_price']; ?>
              </span>
              <img src="admin/menu_img/<?php echo $menu['menu_image']; ?>" class="img-thumbnail jsd pad_remv"
                alt="<?php echo $menu['name']; ?>">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h5 class="text_c margin_t">
                <?php echo $menu['menu_title']; ?>
              </h5>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <p class="marg_left">
                <?php echo $menu['menu_description']; ?>
              </p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 www">
              <button onclick="add_cart(<?php echo $menu['id'].','.$menu['category_id'];?>);" type="button" class="btn btn-danger bt_style menu1_mar"
              >ADD TO CART</button>
            </div>
          </div>
        </div>
        <?php } } else { ?>
        <p class="text-center" style="font-size:25px !important;">No menus found for this category.</p>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>

</html>