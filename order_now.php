<?php
  session_start(); 
  include("config.php");
  include("header.php"); 
   
  if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']))
  {
    header("Location: index.php");
  }

  $user_name  = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];

// Cart Items
$cart_items = $_SESSION['add_cart'] ?? [];
$total_price = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <title>My Burgatory</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script> -->


  <script type="text/javascript">

    $.validator.setDefaults({
      submitHandler: function () {
        alert("submitted!");
      }
    });

    $(document).ready(function () {


      $('#check').click(function () {


        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var dob = $('#dob').val();
        var gen = $('#gen').val();
        var State = $('#State').val();
        var City = $('#City').val();
        var Zipcode = $('#Zipcode').val();

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
    <!--start order section-->
    <div class="table-responsive">
      <table class="table table-striped table-hover border_st">
        <thead>
          <tr class="">
            <th colspan="4">
              <h5 class="cart_total">YOUR ORDER <span style="color: #007bff;">(<?php echo $user_name; ?>)</span></h5>
            </th>
          </tr>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
<?php
$total_price = 0;

foreach ($cart_items as $item_id => $item):
    $subtotal = $item['product_price'] * $item['product_qty'];
    $total_price += $subtotal;
?>
    <tr>
        <td><?php echo $item['product_name']; ?></td>
        <td>$<?php echo number_format($item['product_price'], 2); ?></td>
        <td>
            <input type="number"
                   name="qty[<?php echo $item_id; ?>]"
                   value="<?php echo $item['product_qty']; ?>"
                   class="cart_input"
                   min="1">
        </td>
        <td>$<?php echo number_format($subtotal, 2); ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <th colspan="3">Subtotal</th>
        <th>$<?php echo number_format($total_price, 2); ?></th>
    </tr>
    <tr>
        <th colspan="3">Total</th>
        <th>$<?php echo number_format($total_price, 2); ?></th>
    </tr>
</tbody>

      </table>
    </div>

    <!--start billing and shipping section-->
    <div class="col-md-12 col-sm-12 col-xs-12">
      <form data-toggle="validator" role="form" id="myform">
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
                  <input type="text" class="form-control input_height4" placeholder="Enter Name" id="name" name="name">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="">Email</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Email" id="email"
                    name="email">
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="">Phone No</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Phone no" id="phone"
                    name="phone">
                </div>
              </div>
              <div class="form-group">
                <label for="Address" class="">Address</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Address" id="address"
                    name="address">
                </div>
              </div>
              <div class="form-group">
                <label for="sel1" class="">DOB</label>
                <div class="valid">
                  <input type="date" class="form-control input_height4" placeholder="Enter date of birth" id="dob"
                    name="dob">
                </div>
              </div>
              <!-- <div class="form-group">
                            <label for="sel1" class="">Gender</label>
                        </div> 
                        <<div class="form-group radio_top">
                             <label class="radio-inline"><input type="radio" name="optradio" class="radio_top1" id="Male">Male</label>
                              <label class="radio-inline"><input type="radio" name="optradio" class="radio_top1" id="Female">Female</label>
                        </div>  -->

              <div class="form-group">
                <label for="sel1">Gender</label>
                <div class="valid">
                  <select class="form-control input_height4" name="gen" id="gen">
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>

              </div>
              <div class="form-group">
                <label for="sel1">State</label>
                <div class="valid">
                  <select class="form-control input_height4" name="State" id="State">
                    <option value="">Select State</option>
                    <option value="jharkhand">jharkhand</option>
                    <option value="westbengal">westbengal</option>
                    <option value="odisha">odisha</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="sel2">City</label>
                <div class="valid">
                  <select class="form-control input_height4" name="City" id="City">
                    <option value="">Select City</option>
                    <option value="jamshedpur">jamshedpur</option>
                    <option value="kolkata">kolkata</option>
                    <option value="cuttack">cuttack</option>
                  </select>
                </div>
              </div>
              <div class="form-group zip_mar">
                <label for="Zipcode" class="">Zipcode</label>
                <div class="valid">
                  <input type="text" class="form-control input_height4" placeholder="Enter Zipcode" id="Zipcode"
                    name="Zipcode">
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
                <label><input type="checkbox" id="check" onclick="sd1()">&nbsp <h5 class="remb_mar">Same as Billing
                    Address</h5></label>
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
              <!-- <div class="form-group">
                            <label for="sel1" class="">Gender</label>
                        </div> 
                      <div class="form-group radio_top">
                             <label class="radio-inline"><input type="radio" name="optradio" class="radio_top1">Male</label>
                              <label class="radio-inline"><input type="radio" name="optradio" class="radio_top1">Female</label>
                  </div>  -->
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
              <div class="form-group">
                <label for="sel1">State</label>
                <div class="valid">
                  <select class="form-control input_height4" name="State1" id="State1">
                    <option value="">Select State</option>
                    <option value="jharkhand">jharkhand</option>
                    <option value="westbengal">westbengal</option>
                    <option value="odisha">odisha</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="sel2">City</label>
                <div class="valid">
                  <select class="form-control input_height4" name="City1" id="City1">
                    <option value="">Select City</option>
                    <option value="jamshedpur">jamshedpur</option>
                    <option value="kolkata">kolkata</option>
                    <option value="cuttack">cuttack</option>
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
        <!--End shipping section-->
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st text-center pad_rem border_topp">
            <a href="thank_you.php"> <button type="Submit" value="Submit"
              class="btn btn-danger cart_btn cart_pad btn_color" id="save">PROCEED TO CHECKOUT</button></a>
          </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>

</html>