<?php
  session_start(); 
  date_default_timezone_set('Asia/Kolkata');
  include("config.php");
  include("header.php");

 $total1 = 0;
 $total_spl = '';
 $dg = '';
 $qty_spl = '';
 $total_qty = 0;

foreach ($_SESSION['add_cart'] as $key => $item)
{
  $dd = $item['product_price'] * $item['product_qty'];
  $total_spl .= $dd . ",";
  $total1 += $dd;
  $total_qty += $item['product_qty'];
  $dg .= $item['product_name'] . ",";
  $qty_spl .= $item['product_qty'] . ",";
}

if (isset($_POST['save'])) 
{
    if (!isset($_SESSION['user_id'])) die("User not logged in!");
    $user_id = $_SESSION['user_id'];

    $today = date("ymd");
    $order_no = 'ORD_' . $today . strtoupper(substr(uniqid(), -3));
    $date = date('Y-m-d');  
    $order_items = rtrim($dg, ",");
    $quantity = $total_qty;
    $quantity_split = rtrim($qty_spl, ",");
    $amount = $total1;
    $amount_split = rtrim($total_spl, ",");
    $Name   = trim($_POST['name']);
    $Email  = trim($_POST['email']);
    $Phone  = trim($_POST['phone']);
    $Address= trim($_POST['address']);
    $DOB    = trim($_POST['dob']);
    $State  = trim($_POST['state']);
    $City   = trim($_POST['city']);
    $Zipcode= trim($_POST['Zipcode']);

    $Name1   = trim($_POST['name1']);
    $Email1  = trim($_POST['email1']);
    $Phone1  = trim($_POST['phone1']);
    $Address1= trim($_POST['address1']);
    $DOB1    = trim($_POST['dob1']);
    $State1  = trim($_POST['State1']);
    $City1   = trim($_POST['City1']);
    $Zipcode1= trim($_POST['Zipcode1']);

    $bill_name = explode(" ", $Name, 2);
    $billing_f_name = $bill_name[0];
    $billing_l_name = $bill_name[1] ?? '';

    $ship_name = explode(" ", $Name1, 2);
    $shipping_f_name = $ship_name[0];
    $shipping_l_name = $ship_name[1] ?? '';
   
    $insert_order = "INSERT INTO `orders`(order_no,user_id,order_items,date,quantity,quantity_split,amount,amount_split)
    VALUES('$order_no','$user_id','$order_items','$date','$quantity','$quantity_split','$amount','$amount_split')";
    $run_order = mysqli_query($connect,$insert_order);
    $real_order_id = mysqli_insert_id($connect);
    $enc_order_id  = base64_encode($real_order_id);

    echo $insert_details = "INSERT INTO orders_details  (orders_id,user_id,amount,billing_f_name,billing_l_name,billing_email,billing_phno,billing_add,billing_zipcode,billing_city,
    billing_state,shipping_f_name,shipping_l_name,shipping_email,shipping_phno,shipping_add,shipping_zipcode,shipping_city,shipping_state) 
    VALUES('$real_order_id','$user_id','$amount','$billing_f_name','$billing_l_name','$Email','$Phone','$Address','$Zipcode','$City','$State','$shipping_f_name','$shipping_l_name',
    '$Email1','$Phone1','$Address1','$Zipcode1','$City1','$State1')";
    $run_details = mysqli_query($connect, $insert_details);

    if ($run_order && $run_details) 
      {
        echo "<script>window.location.href='thank_you.php?oid=".$enc_order_id."';</script>";
      } else {
        die("DB ERROR: " . mysqli_error($connect));
    }
}

  $user_id = $_SESSION['user_id'];
  $query = "SELECT * FROM user WHERE id='$user_id'";
  $result = mysqli_query($connect, $query);
  $user = mysqli_fetch_assoc($result);

?>

<head>
  <script type="text/javascript">

    $(document).ready(function () {

      $('#check').click(function () {
        const name = $('#name').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        const address = $('#address').val();
        const dob = $('#dob').val();
        const gen = $('#gen').val();
        const State = $('#State').val();
        const City = $('#City').val();
        const Zipcode = $('#Zipcode').val();

        if ($('#check').prop('checked') == true) {
          $('#name1').val(name);
          $('#email1').val(email);
          $('#phone1').val(phone);
          $('#address1').val(address);
          $('#dob1').val(dob);
          $('#gen1').val(gen);
          $('#State1').val(State);
          $('#City1').val(City);
          $('#Zipcode1').val(Zipcode);
        }
        else {
          $('#name1').val('');
          $('#email1').val('');
          $('#phone1').val('');
          $('#address1').val('');
          $('#dob1').val('');
          $('#gen1').val('');
          $('#State1').val('');
          $('#City1').val('');
          $('#Zipcode1').val('');
        }

      });

      $('#name1').keyup(function () {
        if ($('#name').val() != $('#name1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });

      $('#email1').keyup(function () {
        if ($('#email').val() != $('#email1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });

      $('#phone1').keyup(function () {
        if ($('#phone').val() != $('#phone1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });

      $('#address1').keyup(function () {
        if ($('#address').val() != $('#address1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });

      $('#dob1').change(function () {
        if ($('#dob').val() != $('#dob1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });

      $('#gen1').change(function () {
        if ($('#gen').val() != $('#gen1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });


      $('#State1').change(function () {
        if ($('#State').val() != $('#State1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });


      $('#City1').change(function () {
        if ($('#City').val() != $('#City1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });


      $('#Zipcode1').keyup(function () {
        if ($('#Zipcode').val() != $('#Zipcode1').val()) {
          $('#check').prop('checked', false)
        }
        else {
          $('#check').prop('checked', true)
        }
      });

      var validator = $("#myform").validate({

        rules: {

          name: {
            required: true,
            minlength: 2
          },
          name1: {
            required: true,
            minlength: 2
          },

          email: {
            required: true,
            email: true
          },
          email1: {
            required: true,
            email: true
          },
          phone: {
            required: true,
            minlength: 10
          },
          phone1: {
            required: true,
            minlength: 10
          },
          address: "required",
          dob: "required",
          gen: "required",
          State: "required",
          City: "required",
          Zipcode: "required",

          address1: "required",
          dob1: "required",
          gen1: "required",
          State1: "required",
          City1: "required",
          Zipcode1: "required"
        },
        messages: {
          name: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 2 characters"
          },
          name1: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 2 characters"
          },

          email: "Please enter a valid email address",
          email1: "Please enter a valid email address",

          phone: {
            required: "Please enter your Phone No",
            minlength: "Your Phone No must consist of at least 10 digits"
          },
          phone1: {
            required: "Please enter your Phone No",
            minlength: "Your Phone No must consist of at least 10 digits"
          },
          address:
          {
            required: "please enter address"
          },
          address1:
          {
            required: "please enter address"
          },
          dob:
          {
            required: "please choose date of birth"
          },
          dob1:
          {
            required: "please choose date of birth"
          },
          gen:
          {
            required: "Please select Gender"
          },
          gen1:
          {
            required: "Please select Gender"
          },
          State:
          {
            required: "Please select State"
          },
          State1:
          {
            required: "Please select State"
          },
          City:
          {
            required: "Please select City"
          },
          City1:
          {
            required: "Please select City"
          },
          Zipcode: "please enter Zipcode",
          Zipcode1: "please enter Zipcode"
        },

        errorElement: "em",
        errorPlacement: function (error, element) {
          error.addClass("help-block");
          element.parents(".valid");
          if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
          } else {
            error.insertAfter(element);
          }
        },

        highlight: function (element, errorClass, validClass) {
          $(element).parents(".valid").addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).parents(".valid").addClass("has-success").removeClass("has-error");
        }

      });

    });

    $(document).ready(function () {

      if ($('#check').is(':checked')) {
        fillShipping();
        $('#shipping_form').show();
      } else {
        $('#shipping_form').hide();
      }

      $('#check').on('change', function () {
        if ($(this).is(':checked')) {
          fillShipping();
          $('#shipping_form').slideDown();
        } else {
          $('#shipping_form').slideUp();
        }
      });

      function fillShipping() {
        $('#name1').val($('#name').val());
        $('#email1').val($('#email').val());
        $('#phone1').val($('#phone').val());
        $('#address1').val($('#address').val());
        $('#dob1').val($('#dob').val());
        $('#gen1').val($('#gen').val());
        $('#State1').val($('#state').val());
        $('#City1').val($('#city').val());
        $('#Zipcode1').val($('#Zipcode').val());
      }

    });

  </script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/parpr-restaurant-0039-hor-feat.jpg" class="pos_re">
      <div class="carousel-caption abt_marparpr-restaurant-0039-hor-featgin">
        <h3 class="abt_width cart_font">ORDER NOW</h3>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="table-responsive">
      <table class="table table-striped table-hover border_st">
        <thead>
          <tr class="">
            <th colspan="4">
              <h5 class="cart_total">YOUR ORDER <span style="color: #007bff;">(<?php echo $user['name']; ?>)</span></h5>
            </th>
          </tr>
          <tr>
            <th style="font-weight: 800; color:#222831">SL.No</th>
            <th style="font-weight: 800; color:#222831">PRODUCT</th>
            <th style="font-weight: 800; color:#222831">PRICE</th>
            <th style="font-weight: 800; color:#222831">QUANTITY</th>
            <th style="font-weight: 800; color:#222831">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            $total = 0;
            foreach ($_SESSION['add_cart'] as $key => $item)
              {
          ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo ucwords($item['product_name']);?></td>
            <td><?php echo ucwords($item['product_price']);?></td>
            <td><?php echo ucwords($item['product_qty']);?></td>
            <td><?php echo number_format($dd=$item['product_price'] * $item['product_qty'],2);?></td>
          </tr>
          <?php $total += $dd; $i++; } ?>
          <tr>
            <th colspan="4" style="font-weight: 800; color:#222831">SUBTOTAL</th>
            <td><?php echo number_format($total, 2);?></td>
          </tr>
          <tr>
            <th colspan="4" style="font-weight: 800; color:#222831">TOTAL</th>
            <th><?php echo number_format($total, 2); ?></th>
          </tr>
        </tbody>
      </table>
    </div>

    <!--start billing and shipping section-->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <form method="POST" action="" data-toggle="validator" role="form" id="myform">
        <!--start billing section-->
        <div class="col-md-6 col-sm-12 col-xs-12 regis_mar">
          <div class="col-md-12 col-sm-12  col-xs-12 border_st">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h4 class="regis_font">Billing details</h4>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="form-group log_padding2">
                <label for="name" class="">Name</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Name" id="name" 
                  name="name" value="<?php echo $user['name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="">Email</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Email" id="email"
                    name="email" value="<?php echo $user['email']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="">Phone No</label>
                <div class="valid">
                  <input type="number" class="form-control input_height4" placeholder="Enter Phone no" id="phone"
                    name="phone" value="<?php echo $user['phone_no']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="Address" class="">Address</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Address" id="address"
                    name="address" value="<?php echo $user['address']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="sel1" class="">DOB</label>
                <div class="valid">
                  <input type="date" class="form-control input_height4" placeholder="Enter date of birth" id="dob"
                    name="dob" value="<?php echo $user['dob']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="sel1">Gender</label>
                <div class="valid">
                  <select class="form-control input_height4" name="gen" id="gen">
                    <option value="">Select Gender</option>
                    <option value="Male" <?= ($user['gender']=="Male")?"selected":"" ?>>Male</option>
                    <option value="Female" <?= ($user['gender']=="Female")?"selected":"" ?>>Female</option>
                  </select>
                </div>
              </div>
              <?php
                $select = "SELECT * FROM state";
                $state_query = mysqli_query($connect, $select);
              ?>
              <div class="form-group">
                <label for="sel1">State</label>
                <div class="valid">
                  <select class="form-control input_height4" name="state" id="state">
                    <option value="">Select State</option>
                      <?php while($row = mysqli_fetch_assoc($state_query)) { ?>
                    <option value="<?php echo $row['id']; ?>"
                      <?php echo ($user['state'] == $row['id']) ? 'selected' : ''; ?>>
                      <?php echo $row['state_name']; ?>
                    </option>
                    <?php } ?>
                  </select>       
                </div>
              </div>
              <?php
                $city_select = "SELECT * FROM city";
                $city_query = mysqli_query($connect, $city_select);
              ?>
              <div class="form-group">
                <label for="sel2">City</label>
                <div class="valid">
                  <select class="form-control input_height4" name="city" id="city">
                    <option value="">Select City</option>
                      <?php while($row = mysqli_fetch_assoc($city_query)) { ?>
                      <option value="<?php echo $row['id']; ?>"
                      <?php echo ($user['city'] == $row['id']) ? 'selected' : ''; ?>>
                      <?php echo $row['city_name']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group zip_mar">
                <label for="Zipcode" class="">Zipcode</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Zipcode" id="Zipcode"
                    name="Zipcode" value="<?php echo $user['zip_code']; ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End billing section-->
        <!--start shipping section-->
        <div class="col-md-6 col-sm-12 col-xs-12 regis_mar">
          <div class="col-md-12 col-sm-12  col-xs-12 border_st">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h5 class="regis_font">Shipping details</h5>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label><input type="checkbox" id="check" name="same_address" checked>&nbsp <h5 class="remb_mar">Same as Billing Address</h5></label>
              </div>
            </div>
            
            <div class="col-md-12 col-sm-12 col-xs-12 shipp_marg">
              <div class="form-group log_padding">
                <label for="name" class="">Name</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Name" name="name1"
                    id="name1">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="">Email</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Email" name="email1"
                    id="email1">
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="">Phone No</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Phone no" name="phone1"
                    id="phone1">
                </div>
              </div>
              <div class="form-group">
                <label for="Address" class="">Address</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Address" id="address1"
                    name="address1">
                </div>
              </div>
              <div class="form-group">
                <label for="sel1" class="">DOB</label>
                <div class="valid">
                  <input type="date" class="form-control input_height4" placeholder="Enter date" name="dob1" id="dob1">
                </div>
              </div>
              <div class="form-group">
                <label for="sel1">Gender</label>
                <div class="valid">
                  <select class="form-control input_height4" id="gen1" name="gen1">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <?php
                $select = "SELECT * FROM state";
                $state_query = mysqli_query($connect, $select);
              ?>
              <div class="form-group">
                <label for="sel1">State</label>
                <div class="valid">
                  <select class="form-control input_height4" name="State1" id="State1">
                    <option value="">Select State</option>
                    <?php while($row = mysqli_fetch_assoc($state_query)) { ?>
                    <option value="<?php echo $row['id']; ?>">
                      <?php echo $row['state_name']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
               <?php
                $city_select = "SELECT * FROM city";
                $city_query = mysqli_query($connect, $city_select);
              ?>
              <div class="form-group">
                <label for="sel2">City</label>
                <div class="valid">
                  <select class="form-control input_height4" name="City1" id="City1">
                    <option value="">Select City</option>
                    <?php while($row = mysqli_fetch_assoc($city_query)) { ?>
                    <option value="<?php echo $row['id']; ?>">
                      <?php echo $row['city_name']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group zip_mar">
                <label for="Zipcode" class="">Zipcode</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Zipcode" name="Zipcode1"
                    id="Zipcode1">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" name="save" id="save" 
              class="btn btn-danger cart_btn cart_pad btn_color">
              PROCEED TO CHECKOUT
            </button>
        </div>
      </form>
    </div>
  </div>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>
