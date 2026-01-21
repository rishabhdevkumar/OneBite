<?php
  session_start(); 
  include("config.php");
  include("header.php"); 
   
  // if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
  // {
  //   header("Location: index.php");
  // }
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
                    <h5 class="cart_total1">Order Summary</h5>
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
  <?php
    include("footer.php"); 
  ?>

</body>

</html>