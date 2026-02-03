<?php
  session_start();
  include("config.php");
  include("header.php");

  if (!isset($_SESSION['user_id'])) 
  {
    die("Login required");
  }

  $user_id  = $_SESSION['user_id'];
  // if (!isset($_GET['oid'])) {
  //   die("Order ID missing");
  // }

  $order_id = (int) base64_decode($_GET['oid']);

  $order_q = "SELECT * FROM orders WHERE id = '".$order_id."' AND user_id = '".$user_id."'";
  $run_order = mysqli_query($connect,$order_q);
  $order = mysqli_fetch_assoc($run_order);

  if (!$order) 
  {
    die("Invalid Order");
  }
  $details_q = "SELECT * FROM orders_details WHERE orders_id = '".$order_id."' AND user_id = '".$user_id."'";
  $run_details = mysqli_query($connect,$details_q);
  $details = mysqli_fetch_assoc($run_details);

  $products  = explode(",", $order['order_items']);
  $qtys      = explode(",", $order['quantity_split']);
  $prices    = explode(",", $order['amount_split']);
  $ordered_cart = $_SESSION['ordered_cart'] ?? [];

?>


<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/Flooka1.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">THANK YOU</h3>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 map_heihgt4">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
          <h4 class="text_c1 regis_font">Thank You For Your Order</h4>
          <p>We are processing it now.You will receive an email confirmation shortly.</p>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 thank_you_margin">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="order_back">
                  <th colspan="3">
                    <h5 class="cart_total1 text-center">Order Summary</h5>
                  </th>
                </tr>
                <tr>
                  <th class="thank_padd2" style="font-weight:800;">PRODUCT</th>
                  <th class="thank_padd2" style="font-weight:800;">QUANTITY</th>
                  <th class="thank_padd2" style="font-weight:800;">PRICE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $subtotal = 0;
                  for ($i = 0; $i < count($products); $i++) {
                  $subtotal += $prices[$i];
                ?>
                <tr>
                  <td>
                    <p class="order_weight thank_padd"><?php echo htmlspecialchars($products[$i]); ?></p>
                  </td>
                  <td class="thank_padd1"> <?php echo (int)$qtys[$i]; ?></td>
                  <td class="thank_padd1"> ₹<?php echo number_format($prices[$i], 2); ?></td>
                </tr>
                <?php } ?>
                <tr rowspan="2">
                  <th colspan="2" class="order_weight thank_padd text_thank">SUB TOTAL</th>
                  <td class="thank_padd2">₹<?php echo number_format($subtotal, 2); ?></td>
                </tr>
                <tr rowspan="2">
                  <th colspan="2" class="order_weight thank_padd text_thank">TOTAL</th>
                  <td class="thank_padd2">₹<?php echo number_format($subtotal, 2); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 thank_you_margin">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <h5 class="thank_font">Billing Address</h5>
            <p><img src="image/user-name1.png">&nbsp 
              <?php echo $details['billing_f_name']." ".$details['billing_l_name']; ?>
            </p>
            <p><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp 
              <?php echo $details['billing_add']." ".$details['billing_zipcode']; ?>
            </p>
            <p class=""><i class="fa fa-phone" aria-hidden="true"></i>&nbsp
              <?php echo $details['billing_phno']; ?>
            </p>
            <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp
              <?php echo $details['billing_email']; ?>
            </p>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12">
            <h5 class="thank_font">Shipping Address</h5>
            <p><img src="image/user-name1.png">&nbsp 
              <?php echo $details['shipping_f_name']." ".$details['shipping_l_name']; ?>
            </p>
            <p><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp 
              <?php echo $details['shipping_add']." ".$details['shipping_zipcode']; ?>
            </p>
            <p class=""><i class="fa fa-phone" aria-hidden="true"></i>&nbsp 
              <?php echo $details['shipping_phno']; ?>
            </p>
            <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp
             <?php echo $details['shipping_email']; ?>
            </p>
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