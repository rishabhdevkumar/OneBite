<?php
  session_start();
  include("config.php");
  include("header.php");

  if (!isset($_GET['order_no'])) {
      die("Order number missing");
  }
  if (!isset($_SESSION['user_id'])) 
  {
    die("Login required");
  }

  $user_id  = $_SESSION['user_id'];

  $order_no = $_GET['order_no'];

  $order_q = mysqli_query($connect,"SELECT * FROM orders WHERE order_no = '".$order_no."'");

  if (mysqli_num_rows($order_q) == 0) {
      die("Order not found");
  }

  $order_main = mysqli_fetch_assoc($order_q); 
  $order_id   = $order_main['id'];

  $details_q = mysqli_query($connect,"SELECT * FROM orders_details WHERE orders_id = '".$order_id."'");

  if (mysqli_num_rows($details_q) == 0) {
      die("No order details found");
  }

  $order = mysqli_fetch_assoc($details_q);
?>

<body id="myPage">

<div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/goa-dining-banner.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">ORDER DETAILS</h3>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 map_heihgt4">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
          <h4 class="text_c1 regis_font">ORDER DETAILS</h4>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="panel panel-default mar_bot">
            <div class="panel-heading pad_remv">
              <ul class="order_details_padd my_order_ul">
                <li class=" my_order_ui panal_mar1">
                  <img src="image/list.png" class="order_height_1">
                  <span class="order_details_font">Order No :</span>
                  <span class="order_details_font text-primary"> <?php echo $order_main['order_no']; ?></span>
                </li>
                <li class=" panal_mar  my_order_ui">
                  <img src="image/tag1.png" class="order_height_1">
                  <span class="order_details_font">Total Price :</span>
                  <span class="order_details_font text-primary">₹<?php echo number_format($order['amount'], 2); ?></span>
                </li>
                <li class=" panal_mar  my_order_ui">
                  <img src="image/calendar.png" class="order_height_1">
                  <span class="order_details_font">Order Date :</span>
                  <span class="order_details_font text-primary"> <?php echo date("d/m/Y", strtotime($order['date'])); ?></span>
                </li>
                <li class="panal_mar my_order_ui">
                  <img src="image/pie-chart-in-a-rounded-square.png" class="order_height_1">
                  <span class="order_details_font">Status :</span>
                  <span class="order_details_font text-primary"> <?php echo $order['status']; ?></span>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 thank_you_margin1">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="order_back">
                  <th colspan="3">
                    <h5 class="cart_total1">Order Details</h5>
                  </th>
                </tr>
                <tr>
                  <th class="thank_padd2">PRODUCT</th>
                  <th class="thank_padd2">QUANTITY</th>
                  <th class="thank_padd2">PRICE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $items = explode(",", $order_main['order_items']);
                  $qtys  = explode(",", $order_main['quantity_split']);
                  $amounts = explode(",", $order_main['amount_split']);

                  for ($i = 0; $i < count($items); $i++) {
                  $item_name = trim($items[$i]);
                  $qty = isset($qtys[$i]) ? (int)$qtys[$i] : 1;
                  $price = isset($amounts[$i]) ? (float)$amounts[$i] : 0;
                ?>
                <tr>
                  <td><p class="order_weight thank_padd"><?php echo $item_name; ?></p></td>
                  <td class="thank_padd1"><?php echo $qty; ?></td>
                  <td class="thank_padd1">₹<?php echo number_format($price, 2); ?></td>
                </tr>
                <?php } ?>
                <tr rowspan="2">
                  <th colspan="2" class="order_weight thank_padd text_thank">SUB TOTAL</th>
                  <td class="thank_padd2">
                    ₹<?php echo $order_main['amount']; ?>
                  </td>
                </tr>
                <tr rowspan="2">
                  <th colspan="2" class="order_weight thank_padd text_thank">TOTAL</th>
                  <td class="thank_padd2">
                    ₹<?php echo $order_main['amount']; ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 thank_you_margin">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <h5 class="thank_font">Billing Address</h5>
            <p>
              <img src="image/user-name1.png">&nbsp 
              <?php echo $order['billing_f_name']." ".$order['billing_l_name']; ?>
            </p>
            <p>
              <i class="fa fa-address-book" aria-hidden="true"></i>&nbsp 
              <?php echo $order['shipping_add']." ".$order['shipping_zipcode']; ?>
            </p>
            <p class="">
              <i class="fa fa-phone" aria-hidden="true"></i>&nbsp
              <?php echo $order['billing_phno']; ?>
            </p>
            <p>
              <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp 
              <?php echo $order['billing_email']; ?>
            </p>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12">
            <h5 class="thank_font">Shipping Address</h5>
            <p>
              <img src="image/user-name1.png">&nbsp 
              <?php echo $order['shipping_f_name']." ".$order['shipping_l_name']; ?>
            </p>
            <p>
              <i class="fa fa-address-book" aria-hidden="true"></i>&nbsp 
              <?php echo $order['shipping_add']." ".$order['shipping_zipcode']; ?>
            </p>
            <p>
              <i class="fa fa-phone" aria-hidden="true"></i>&nbsp
              <?php echo $order['shipping_phno']; ?>
            </p>
            <p>
              <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp 
              <?php echo $order['shipping_email']; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

<?php include("footer.php"); ?>
</body>

