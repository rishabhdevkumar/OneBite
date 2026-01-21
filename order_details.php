<?php
session_start();
include("config.php");
include("header.php");

$order_id = $_GET['order_id'];
$order_details = mysqli_query($connect, "SELECT * FROM orders_details WHERE order_id='$order_id'");
$order = mysqli_fetch_assoc($order_details);


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
                <li class=" my_order_ui panal_mar1"><img src="image/list.png" class="order_height_1">&nbsp <span
                    class="order_details_font">Order No</span><span>:&nbsp W2333GF</span></li>
                <li class=" panal_mar  my_order_ui"><img src="image/tag1.png" class="order_height_1">&nbsp <span
                    class="order_details_font">Total Price</span><span>:&nbsp $544</span></li>
                <li class=" panal_mar  my_order_ui"><img src="image/calendar.png" class="order_height_1"> &nbsp<span
                    class="order_details_font">Order Date</span><span>:&nbsp 02/05/2018</span></li>
                <li class=" panal_mar  my_order_ui"><img src="image/pie-chart-in-a-rounded-square.png"
                    class="order_height_1"> &nbsp<span class="order_details_font">Status</span><span>:&nbsp In
                    Stock</span></li>
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
                  <th class="thank_padd2">Product</th>
                  <th class="thank_padd2">Quantity</th>
                  <th class="thank_padd2">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <p class="order_weight thank_padd">SONY LED 32 inch</p>
                  </td>
                  <td class="thank_padd1">1</td>
                  <td class="thank_padd1">$199.00</td>
                </tr>
                <tr>
                  <td>
                    <p class="order_weight thank_padd">SONY XPERIA XA ULTRA</p>
                  </td>
                  <td class="thank_padd1">2</td>
                  <td class="thank_padd1">$299.00</td>
                </tr>
                <tr>
                  <td>
                    <p class="order_weight thank_padd">RENULT DUSTER</p>
                  </td>
                  <td class="thank_padd1">3</td>
                  <td class="thank_padd1">$1199.00</td>
                </tr>
                <tr rowspan="2">
                  <th colspan="2" class="order_weight thank_padd text_thank">Sub Total</th>
                  <td class="thank_padd2">$1699.00</td>
                </tr>
                <tr rowspan="2">
                  <th colspan="2" class="order_weight thank_padd text_thank">Total</th>
                  <td class="thank_padd2">$1699.00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 thank_you_margin">
          <div class="col-md-6 col-sm-12 col-xs-12 ">
            <h5 class="thank_font">Billing Address</h5>
            <p><img src="image/user-name1.png">&nbsp Tapan Paul</p>
            <p><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp jamshedpur 832108</p>
            <p class=""><i class="fa fa-phone" aria-hidden="true"></i>&nbsp +1 (0) 000 0000 001
            </p>
            <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp subhodippaul9@gmail.com</p>
          </div>
          <div class="col-md-6 col-sm-12 col-xs-12">
            <h5 class="thank_font">Shipping Address</h5>
            <p><img src="image/user-name1.png">&nbsp Tapan Paul</p>
            <p><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp jamshedpur 832108</p>
            <p class=""><i class="fa fa-phone" aria-hidden="true"></i>&nbsp +1 (0) 000 0000 001
            </p>
            <p><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp subhodippaul9@gmail.com</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

<?php include("footer.php"); ?>
</body>
</html>
