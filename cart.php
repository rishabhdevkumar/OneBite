<?php
  session_start();
  include("config.php");
  include("header.php");

  if (isset($_POST['update_cart']) && isset($_POST['qty'])) {

    foreach ($_POST['qty'] as $key => $qty) {

        if ($qty > 0) {
            $_SESSION['add_cart'][$key]['product_qty'] = $qty;
        }
    }

}

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
    <form method="post" action="">
      <div class="table-responsive">
        <table class="table table-hover border_st">
          <thead>
            <tr>
              <th></th>
              <th class="text-center cart_weight">Image </th>
              <th class="text-center cart_weight">Product</th>
              <th class="text-center cart_weight">Price</th>
              <th class="text-center cart_weight">Quantity</th>
              <th class="text-center cart_weight">Total</th>
            </tr>
          </thead>

          <tbody>
            <?php
              $grand_total = 0;
              if (isset($_SESSION['add_cart']) && count($_SESSION['add_cart']) > 0) {

              foreach ($_SESSION['add_cart'] as $key => $item) {
              $subtotal = $item['product_price'] * $item['product_qty'];
              $grand_total += $subtotal;
            ?>
            <tr>
              <td>
                <a href="remove_cart.php?key=<?php echo $key; ?>">
                  <img src="image/cancel1.png" class="cart_padd padd_img1">
                </a>
              </td>
              <td class="td_img">
                <img src="admin/menu_img/<?php echo $item['product_image']; ?>" class="td_img">
              </td>
              <td class="text-center cart_padd">
                <?php echo $item['product_name']; ?>
              </td>
              <td class="text-center cart_padd">
                Rs.
                <?php echo $item['product_price']; ?>
              </td>
              <td class="text-center cart_padd">
                <input type="number" name="qty[<?php echo $key; ?>]" value="<?php echo $item['product_qty']; ?>" min="1"
                  class="cart_input">
              </td>
              <td class="text-center cart_padd">
                Rs.
                <?php echo $subtotal; ?>
              </td>
            </tr>

            <?php
              }
              } else {
            ?>
            <tr>
              <td colspan="6" class="text-center">
                <h4><strong><em>Cart is Empty</em></strong></h4>
              </td>
            </tr>
            <?php } ?>
            <tr>
              <td colspan="6">
                <button type="submit" name="update_cart" class="btn btn-danger cart_btn btn_color">
                  UPDATE CART
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>

    <?php if (isset($_SESSION['add_cart']) && count($_SESSION['add_cart']) > 0) { ?>
    <div class="col-md-6 col-sm-12 col-xs-12 pull-right pad_rem">
      <div class="col-md-12 col-sm-12 col-xs-12 pad_rem">
        <h4 class="cart_total">CART TOTALS</h4>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 border_st pad_rem">
        <div class="col-md-12 col-sm-12 col-xs-12 border_st" style="box-shadow: none;">
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">Subtotal</h5>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">Rs.
              <?php echo $grand_total; ?>
            </h5>
          </div>
        </div>
        <hr>
        <div class="col-md-12 col-sm-12 col-xs-12 border_st" style="box-shadow: none;">
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">Total</h5>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12 pad_rem">
            <h5 class="cart_weight">Rs.
              <?php echo $grand_total; ?>
            </h5>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 pad_rem"> <a href="order_now.php"> <button type="button"
          class="btn btn-danger cart_btn cart_pad btn_color">PROCEED TO CHECKOUT</button></a> 
      </div>
    </div>
  </div>
    <?php } ?>
    <!-- </div> -->
  <?php
    include("footer.php"); 
  ?>

</body>