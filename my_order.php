<?php
  session_start(); 
  include("config.php");
  include("header.php"); 
   
  $user_id = $_SESSION['user_id'];

  $order_q = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC";
  $run_order = mysqli_query($connect,$order_q);
?>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/Samudra Restaurant Mayfair Waves.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">MY ORDER</h3>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="table-responsive">
        <div class="col-md-12 col-sm-12 col-xs-12 border_st order_back ">
          <h2 class="cart_total2 text-center">MY ORDER</h2>
        </div>
        <table class="table table-striped table-hover border_st table_margin">
          <thead>
            <tr>
              <th class="my_order_back">ORDER NUMBER</th>
              <th class="my_order_back">ORDER DATE</th>
              <th class="my_order_back">TOTAL PRICE</th>
              <th class="my_order_back">ORDER ITEMS</th>
              <th class="my_order_back">ORDER TYPE</th>
              <th class="my_order_back">STATUS</th>
            </tr>
          </thead>
          <tbody>
            <?php
             if (mysqli_num_rows($run_order) > 0) {
             while ($order = mysqli_fetch_assoc($run_order)) {
            ?>
            <tr>
              <td class="my_order_back1">
                <?php echo $order['order_no']; ?>
              </td>
              <td class="my_order_back1">
                <?php echo date("d-m-Y (H:i:s)", strtotime($order['date'])); ?>
              </td>
              <td class="my_order_back1">
                ₹<?php echo number_format($order['amount'], 2); ?>
              </td>
              <td class="my_order_back1">
                 <?php
                  $items = explode(",", $order['order_items']);  
                  $qtys  = explode(",", $order['quantity_split']); 

                  foreach ($items as $k => $item) 
                  {
                    echo trim($item) . " (Qty: " . ($qtys[$k] ?? 1) . ")<br>";
                  }
                ?>
              </td>
              <td class="my_order_back1">Online</td>
              <td class="my_order_back1">
                <?php
                  switch ($order['status']) 
                  {
                    case 'pending':
                      echo "<span style='color:orange;'>Pending</span>";
                      break;
                    case 'confirmed':
                      echo "<span style='color:blue;'>Confirmed</span>";
                      break;
                    case 'delivered':
                      echo "<span style='color:green;'>Delivered</span>";
                      break;
                    case 'cancelled':
                      echo "<span style='color:red;'>Cancelled</span>";
                      break;
                    default:
                      echo "<span style='color:gray;'>Unknown</span>";
                  }
                ?>
              </td>
            </tr>
            <?php
              }
                } else {
            ?>
            <tr>
              <td colspan="6" class="text-center my_order_back1">
                NO ORDERS FOUND!
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>

</html>