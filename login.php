<?php
  include("config.php");
  include("header.php");
  // $_SESSION['user_id'] = $row['id'];


//  $otp = substr(str_shuffle("0123456789"), 0, 5);
// $activation_code = str_shuffle("abcdefghijklmn".rand(100000,999999));

// if(isset($_POST['save'])){

//     $name     = $_POST['name'];
//     $email    = $_POST['email'];
//     $phone    = $_POST['phone'];
//     $password = md5($_POST['password']);
//     $address  = $_POST['address'];
//     $dob      = $_POST['dob'];
//     $gender   = $_POST['gender'];
//     $state    = $_POST['state'];
//     $city     = $_POST['city'];
//     $zipcode  = $_POST['Zipcode'];

//     /* CHECK EMAIL */
//     $check = mysqli_query($connect,"SELECT id,status FROM user WHERE email='$email'");
    
//     if(mysqli_num_rows($check) > 0){
//         echo "<script>alert('Email already exists');</script>";
//         exit;
//     }

//     /* INSERT USER FIRST */
//     $insert = "INSERT INTO user
//     (name,email,phone_no,password,address,dob,gender,state,city,zip_code,otp,activation_code,status)
//     VALUES
//     ('$name','$email','$phone','$password','$address','$dob','$gender','$state','$city','$zipcode','$otp','$activation_code','inactive')";

//     if(mysqli_query($connect,$insert)){

//         /* SEND MAIL */
//         require 'class/class.phpmailer.php';
//         $mail = new PHPMailer;
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->Port = 587;
//         $mail->SMTPAuth = true;
//         $mail->Username = 'rishabhdevkumar77@gmail.com';
//         $mail->Password = 'tbjjjvmavcsbufjj';
//         $mail->SMTPSecure = 'tls';

//         $mail->setFrom('rishabhdevkumar77@gmail.com','Signup Verification');
//         $mail->addAddress($email);
//         $mail->isHTML(true);
//         $mail->Subject = 'Email Verification';
//         $mail->Body = "<p>Your OTP is <b>$otp</b></p>";

//         if($mail->send()){
//             header("Location: menus.php?code=$activation_code");
//             exit;
//         }else{
//             echo "Mailer Error: ".$mail->ErrorInfo;
//         }

//     }else{
//         echo "DB Error: ".mysqli_error($connect);
//     }
// }

  $user_id = $_SESSION['user_id'];
  $change_profile = "SELECT * FROM `user` WHERE id='".$user_id."'";
  $run_profile = mysqli_query($connect,$change_profile);
  $fetch_profile = mysqli_fetch_array($run_profile);

 if(isset($_POST['save']))
  {
      $Name = $_POST['name'];
      $Email = $_POST['email'];
      $Phone = $_POST['phone'];
      $Password = md5($_POST['password']);
      $Conf_password = $_POST['confirm_password'];
      $Address = $_POST['address'];
      $Dob = $_POST['dob'];
      $Gender = $_POST['gender'];
      $State = $_POST['state'];
      $City = $_POST['city'];
      $code = $_POST['Zipcode'];

      if(!empty($_FILES['img']['name'])){
          $profile = $_FILES['img']['name'];
          $tmp_name = $_FILES['img']['tmp_name'];
          move_uploaded_file($tmp_name, 'profile_image/'.$profile);
      } else {
          $profile = "my_profile.png";  
          copy("image/my_profile.png", "profile_image/".$profile);
      }

      $conf_email = "SELECT * FROM  user WHERE email = '".$Email."'";
      $run_email  =  mysqli_query($connect, $conf_email);
      $num_rows   =  mysqli_num_rows($run_email);

      if($num_rows){
          echo '<script>alert("This Email Already Exists")</script>';
      } else {
          $add = "INSERT INTO user(name,email,phone_no,password,address,dob,gender,state,city,zip_code,profile)
          VALUES('".$Name."','".$Email."','".$Phone."','".$Password."','".$Address."','".$Dob."','".$Gender."','".$State."','".$City."','".$code."','".$profile."')";
          
          $run = mysqli_query($connect ,$add);
          if($run){
              header("Location: index.php");
          } else {
              echo '<script>alert("Something Went Wrong")</script>';
          }
      }
  }

  // ------------- php code of authentication ----------------
   if (isset($_POST['save1'])) {

    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = md5(mysqli_real_escape_string($connect, $_POST['password']));

    $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];

        if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
            $redirect = $_GET['redirect'];
            echo "<script>window.location.href='$redirect';</script>";
        } else {
            echo "<script>window.location.href='index.php';</script>";
        }

        exit();
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    }
}

//     if(isset($_POST['save1']))
// {
//     $email = mysqli_real_escape_string($connect, $_POST['email']);
//     $password = md5(mysqli_real_escape_string($connect, $_POST['password']));

//     $authenticate = "SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."'";
//     $run_rec = mysqli_query($connect, $authenticate);
//     $num = mysqli_num_rows($run_rec);

//     if($num > 0)
//     {
//         $fetch = mysqli_fetch_array($run_rec);

//         $_SESSION['user_id']      = $fetch['id'];
//         $_SESSION['user_name']    = $fetch['name'];
//         $_SESSION['user_email']   = $fetch['email'];
//         $_SESSION['user_phone_no']   = $fetch['phone_no']; 
//         $_SESSION['user_address'] = $fetch['address'];
//         $_SESSION['user_dob']     = $fetch['dob'];
//         $_SESSION['user_gender']  = $fetch['gender'];
//         $_SESSION['user_state']   = $fetch['state'];
//         $_SESSION['user_city']    = $fetch['city'];
//         $_SESSION['user_zip']     = $fetch['zipcode'];

//         $redirect = $_SESSION['redirect_after_login'] ?? 'index.php';
//         unset($_SESSION['redirect_after_login']);

//         echo '<script>window.location.href="'.$redirect.'"</script>';
//         exit;

//     } else {
//         echo '<script>alert("Invalid email or password!")</script>';
//     }
// }

    // $otp_str = str_shuffle("0123456789");
    // $otp = substr($otp_str, 0, 6);

    // echo $act_str = rand(100000, 10000000);
    // echo "</br>";
    // echo $activation_code = str_shuffle("abcdefghijklmn".$act_str)
?>


  <script type="text/javascript">
    $(document).ready(function () {

      var validator = $("#myform1").validate({
        rules: {

          email: {
            required: true,
            email: true
          },

          email2: {
            required: true,
            email: true
          },

          password: {
            required: true,
            minlength: 5
          }
        },

        messages: {

          email: "Please enter a valid email address",
          email2: "Please enter a valid email address",

          password: {
            required: "Please provide  password",
            minlength: "Your password must be at least 5 characters long"
          }
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

      var validator = $("#myform2").validate({

        rules: {

          email2: {
            required: true,
            email: true
          }
        },

        messages: {
          email2: "Please enter a valid email address"
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

      var validator = $("#myform").validate({

        rules: {

          name: {
            required: true,
            minlength: 2
          },

          email: {
            required: true,
            email: true
          },
          phone: {
            required: true,
            minlength: 10,
            maxlength: 10,
            digits: true
          },
          password: {
            required: true,
            minlength: 5
          },
          confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#password"
          },
          address: "required",
          dob: "required",
          gen: "required",
          State: "required",
          City: "required",
          agree: "required",
          Zipcode: "required"
        },
        messages: {
          name: {
            required: "Please enter your name",
            minlength: "Your name must consist of at least 2 characters"
          },

          email: "Please enter a valid email address",

          phone: {
            required: "Please enter your Phone No",
            minlength: "Your Phone No must consist of at least 10 digits"
          },

          password: {
            required: "Please provide  password",
            minlength: "Your password must be at least 5 characters long"
          },
          confirm_password: {
            required: "Please provide confirm password",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
          },
          address:
          {
            required: "please enter address"
          },
          dob:
          {
            required: "please choose date of birth"
          },
          sel1:
          {
            required: "Please select Gender"
          },
          state:
          {
            required: "Please select State"
          },
          city:
          {
            required: "Please select City"
          },
          Zipcode: "please enter Zipcode"
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

    function get_city_by_state(temp) {
      const state = temp;
      const value = 'state=' + state;
      $.ajax({
        url: "city_ajax.php",
        type: "POST",
        data: value,
        success: function (data) {
          $("#city").html(data);
        },
        error: function (jqXHR, textstatus, errorThrown) {
          console.log(textstatus, errorThrown);
        }
      })
    }

  </script>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <div class="container-fluid">
    <div class="row imagd-height">
      <img src="image/2.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">LOGIN AND REGISTER</h3>
      </div>
    </div>
  </div>
  <!--start login section-->
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 map_heihgt4">
        <div class="col-md-6 col-sm-12 col-xs-12 ">
          <div class="col-md-12 col-sm-12 col-xs-12 border_st">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h4 class="text_c1 regis_font">Login</h4>
            </div>
            <form data-toggle="validator" role="form" id="myform1" method="POST" action="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group log_padding">
                  <label for="name" class="">Email Id</label>
                  <div class="valid">
                    <input type="text" class="form-control input_height4" placeholder="Enter Email" id="email1"
                      name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="">Password</label>
                  <div class="valid">
                    <input type="password" class="form-control input_height4" placeholder="Enter Password"
                      id="password1" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="captcha" class="">Captcha</label>
                  <div class="valid">
                    <input type="captcha" class="form-control input_height4" placeholder="Enter captcha code"
                      id="captcha1" name="captcha">
                  </div>
                </div>
                <div class="form-group width_c2">
                  <label><input type="checkbox">&nbsp <h5 class="remb_mar">Rmember me</h5></label>
                </div>
                <div class="form-group">
                  <label for="forget" class="log_padding1" data-toggle="modal" data-target="#myModal">
                    <button style="border: none; background: #fff">Forgot
                      Password?</button></label>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center log_mkh">
                  <button type="submit" value="submit" class="btn label-danger btn_padding" id="save1"
                    name="save1">LOGIN</button>
                </div>
              </div>
            </form>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-3 shadow">
                  <div class="modal-header bg-primary text-white d-flex align-items-center">
                    <button type="button" class="close text-white mr-2" data-dismiss="modal" aria-label="Close"
                      style="opacity:1;">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title font-weight-bold mb-0" id="forgotPasswordLabel">
                      🔑 FORGOT PASSWORD
                    </h5>
                  </div>
                  <div class="modal-body">
                    <form data-toggle="validator" role="form" id="myform1" method="POST" action="">
                      <div class="form-group">
                        <label for="email" class="font-weight-bold">Enter your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                          required>
                      </div>
                      <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 regis_mar">
          <div class="col-md-12 col-sm-12  col-xs-12 border_st">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h4 class="text_c1 regis_font">Register</h4>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <form data-toggle="validator" role="form" id="myform" method="POST" action=""
                enctype="multipart/form-data">
                <input type="hidden" name="otp" value="<?php echo $otp; ?>">
                <input type="hidden" name="activation_code" value="<?php echo $activation_code; ?>">
                <div class="form-group log_padding">
                  <label for="name" class="">Name</label>
                  <div class="valid">
                    <input type="text" class="form-control input_height4" placeholder="Enter Name" id="name"
                      name="name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="">Email</label>
                  <div class="valid">
                    <input type="text" class="form-control input_height4" placeholder="Enter Email" id="email" name=email>
                    <button class="btn send-otp" data-toggle="modal" data-target="#otpModal">SEND OTP</button>
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone" class="">Phone No</label>
                  <div class="valid">
                    <input type="text" class="form-control input_height4" placeholder="Enter Phone no" 
                    id="phone" name="phone">
                  </div>
                </div>
                <div class="form-group pass-top">
                  <label for="password" class="">Password</label>
                  <div class="valid">
                    <input type="password" class="form-control input_height4" placeholder="Enter Password" id="password" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="confirm_password" class="">Confirm Password</label>
                  <div class="valid">
                    <input type="password" class="form-control input_height4" placeholder="Enter confirm Password"
                      id="confirm_password" name="confirm_password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Address" class="">Address</label>
                  <div class="valid">
                    <textarea class="form-control add_heigght" placeholder="Enter Address" id="address"
                      name="address"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sel1" class="">DOB</label>
                  <div class="valid">
                    <input type="date" class="form-control input_height4" placeholder="Enter date" id="dob" name="dob">
                  </div>
                </div>
                <div class="form-group">
                  <label for="sel1">Gender</label>
                  <div class="valid">
                    <select class="form-control input_height4" id="sel1" name="gender">
                      <option value="">Select Gender</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sel1">State</label>
                  <div class="valid">
                    <select class="form-control input_height4" id="state" name="state"
                      onchange="get_city_by_state(this.value)">
                      <option value="">--Select State--</option>
                      <?php
                        $select_state = "SELECT * FROM state WHERE 1";
                        $run_state = mysqli_query($connect, $select_state);
                        while($fetch_state = mysqli_fetch_array($run_state))
                        {
                      ?>
                      <option value="<?php echo $fetch_state['id']?>">
                        <?php echo $fetch_state['state_name']?>
                      </option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sel2">City</label>
                  <div class="valid">
                    <select class="form-control input_height4" id="city" name="city">
                      <option value="">Select City</option>
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
                <div class="col-md-12 col-sm-12 col-xs-12 text-center log_mkh">
                  <button type="reset" value="reset" class="btn label-danger btn_padding">RESET</button>
                  <button type="Submit" value="Submit" class="btn label-danger btn_padding" id="save"
                    name="save">REGISTER</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- ---------- send otp model ----------- -->
        <div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
              <div class="modal-header d-flex justify-content-between align-items-center">
                <button type="button" class="close text-white mr-2" data-dismiss="modal" aria-label="Close"
                  style="opacity:1;">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="otpModalLabel">SEND OTP</h5>
              </div>
              <!------ Modal Body ------>
              <div class="modal-body text-center">
                <div class="d-flex justify-content-center gap-2 mb-3">
                  <input type="text" maxlength="1" class="otp-input" />
                  <input type="text" maxlength="1" class="otp-input" />
                  <input type="text" maxlength="1" class="otp-input" />
                  <input type="text" maxlength="1" class="otp-input" />
                  <input type="text" maxlength="1" class="otp-input" />
                  <input type="text" maxlength="1" class="otp-input" />
                </div><br>
              </div>
              <div class="d-flex justify-content-center gap-3 modal-footer">
                <button class="btn-success">Submit</button>
                <button type="reset" class="btn-secondary">Reset</button>
              </div>
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

<style>
  .modal-header {
    background: #7c88f3ff;
  }

  .modal-title {
    color: #d3d3d3ff;
    font-size: 20px;
  }

  .otp-input {
    width: 50px;
    height: 50px;
    font-size: 20px;
    text-align: center;
    border: 2px solid #ccc;
    border-radius: 6px;
  }

  .otp-input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, .5);
  }

  .modal-footer {
    padding: 8px;
    background: #7c88f3ff;
  }

  .btn-success {
    color: #fff;
    width: 60px;
    padding: 4px;
    border: none;
    border-radius: 4px;
    background: #343435ff;
  }

  .btn-success:hover {
    background: #338d79ff;
    color: #fff;
    cursor: pointer;
  }

  .btn-secondary {
    color: #fff;
    width: 60px;
    padding: 4px;
    border: none;
    border-radius: 4px;
    background: #2f8ca3ff;
  }

  .btn-secondary:hover {
    background: #5438a1ff;
    color: #fff;
    cursor: pointer;
  }
</style>