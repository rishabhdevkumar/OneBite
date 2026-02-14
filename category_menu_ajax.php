<?php
include("config.php");

$category_id = $_POST['category']; 

$select_menu = "SELECT * FROM `menu` WHERE status='y' AND category_id = '".$category_id."'";
$run_catagory = mysqli_query($connect, $select_menu);

if(mysqli_num_rows($run_catagory) > 0){
    while($fetch_menu = mysqli_fetch_array($run_catagory)) {
        echo '<div class="col-md-4 col-sm-12 col-xs-12" id="menu-btn">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
            <div class="col-md-12 col-sm-12 col-xs-12 cbc item1 fix_height pad_rem opb1">';
              
              if($fetch_menu['is_new'] == 'y'){
                  echo '<span class="notify-badge1">NEW</span>';
              }

              echo '<span class="notify-badge">
                      <i class="fa fa-inr jhdqa" aria-hidden="true"></i> '.$fetch_menu['menu_price'].'
                    </span>
                    <img src="admin/menu_img/'.$fetch_menu['menu_image'].'" 
                         class="img-thumbnail jsd pad_remv" 
                         alt="'.$fetch_menu['name'].'">
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h5 class="text_c margin_t">'.$fetch_menu['menu_title'].'</h5>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <p class="marg_left">'.$fetch_menu['menu_description'].'</p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 www">
              <button onclick="add_cart('.$fetch_menu['id'].','.$fetch_menu['category_id'].');" type="button" class="btn btn-danger bt_style menu1_mar"
              >ADD TO CART</button>
            </div>

          </div>
        </div>';
    }
} else {
    echo '<p class="text-center">No menu found in this category.</p>';
}
?>

