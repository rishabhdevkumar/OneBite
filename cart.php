<?php
  include("config.php");
   include("header.php"); 
  // session_start();  
  // if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
  // {
  //   header("Location: index.php");
  // }
?>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/AtholPlace-Restaurant.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width cart_font">CART</h3>
        <p class="kkk1 cart_marg">READY TO CHECKOUT?</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="table-responsive">
      <table class="table table-hover border_st">
        <thead>
          <tr>
            <th></th>
            <th></th>
            <th class="text-center">Product</th>
            <th class="text-center">Price</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><img src="image/cancel1.png" class="cart_padd padd_img1"></td>
            <td class="td_img"><img src="image/first-1.jpg" class="td_img"></td>
            <td class="text-center cart_padd">Woo Single #4</td>
            <td class="text-center cart_padd">$13.00</td>
            <td class="text-center cart_padd"><input type="number" name="qty" value="1" class="cart_input">
            <td class="text-center cart_padd">$13.00</td>
          </tr>
          <tr>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <td colspan="6"><button type="button" class="btn btn-danger cart_btn btn_color">UPDATE CART</button></td>
            </div>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12  pull-right pad_rem">
      <div class="col-md-12 col-sm-12 col-xs-12 pad_rem">
        <h4 class="cart_total">CART TOTALS</h4>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
        <div class="col-md-12 col-sm-12 col-xs-12 border_st" style="box-shadow: none;">
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">Subtotal</h5>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">$13.00</h5>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 border_st" style="box-shadow: none;">
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">Total</h5>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">$13.00</h5>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 pad_rem">
        <a href="order_now.php"> <button type="button" class="btn btn-danger cart_btn cart_pad btn_color">PROCEED TO
            CHECKOUT</button></a>
      </div>
    </div>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>