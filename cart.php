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

<script>
function remove_cart(key) {
    $.ajax({
        url: "remove_cart.php",
        type: "POST",
        data: { key: key },
        dataType: "json",
        success: function(response) {

            $("#cart_table_body").html(response.table);

            $("#dd").text(response.total);
            $("#dd1").text(response.total);
            $("#item_cart").text(response.count);
            $("#header_cart_items").html(response.html);
            if (response.count == 0) {
                $("#item_cart").hide();
            }
        }
    });
}

function update_cart_qty(p_id) {

    let qty = $("#qty_" + p_id).val();

    // 🔴 If quantity is ZERO → remove item completely
    if (qty == 0) {
        remove_cart(p_id);
        return;
    }

    // ✅ Otherwise update quantity
    $.ajax({
        url: "update_cart_qty.php",
        type: "POST",
        dataType: "json",
        data: {
            p_id: p_id,
            qty: qty
        },
        success: function (res) {

            // Update row subtotal
            $("#subtotal_" + p_id).text("Rs. " + res.subtotal);

            // Update totals
            $("#dd").text(res.total);
            $("#dd1").text(res.total);

            // Update cart count
            $("#item_cart").text(res.count);

            // Update header mini cart
            $("#header_cart_items").html(res.html);
        }
    });
}



</script>

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
          <tbody id="cart_table_body">
            <?php
              $grand_total = 0;
              if (isset($_SESSION['add_cart']) && count($_SESSION['add_cart']) > 0) {

              foreach ($_SESSION['add_cart'] as $key => $item) {
              $subtotal = $item['product_price'] * $item['product_qty'];
              $grand_total += $subtotal;
            ?>
            <tr>
              <td>
                <a href="#" onclick="remove_cart(<?php echo $key; ?>)">
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
                Rs. <?php echo $item['product_price']; ?>
              </td>
              <td class="text-center cart_padd">
                <input type="number" id="qty_<?php echo $key; ?>" value="<?php echo $item['product_qty']; ?>"
                  onchange="update_cart_qty(<?php echo $key; ?>)">
              </td>
              <td class="text-center cart_padd" id="subtotal_<?php echo $key; ?>">
                Rs. <?php echo $item['product_price'] * $item['product_qty']; ?>
              </td>   
            </tr>
            <?php
              }
              } else {
            ?>
            <tr>
              <td colspan="6" class="text-center">
                <h5 class="empty-cart-text"><strong><em>Cart is Empty</em></strong></h5>
              </td>
            </tr>
            <?php } ?>
            <!-- <tr>
              <td colspan="6">
                <button type="submit" name="update_cart" class="btn btn-danger cart_btn btn_color">
                  UPDATE CART
                </button>
              </td>
            </tr> -->
          </tbody>
        </table>
      </div>
    </form>
    <?php if (isset($_SESSION['add_cart']) && count($_SESSION['add_cart']) > 0) { ?>
    <div class="col-md-6 col-sm-12 col-xs-12 pull-right pad_rem" id="cart_total_area">
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
              <span id="dd"><?php echo number_format($grand_total,2); ?></span>
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
              <span id="dd1"><?php echo number_format($grand_total,2); ?></span>
            </h5>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12 pad_rem">
        <?php if(isset($_SESSION['user_id'])) { ?>
          <a href="order_now.php">
            <button type="button" class="btn btn-danger cart_btn cart_pad btn_color">PROCEED TO CHECKOUT</button>
          </a> 
        <?php } else { ?>
          <a href="login.php?redirect=order_now.php">
            <button type="button" class="btn btn-danger cart_btn cart_pad btn_color">
              PROCEED TO CHECKOUT
            </button>
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
    <?php } ?>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>

<style>
  .empty-cart-text {
    font-size: 20px;
    animation: colorBlink 0.9s infinite;
}

@keyframes colorBlink {
    0%   { color: blue; }
    25%  { color: orange; }
    100% { color: red; }
}

</style>