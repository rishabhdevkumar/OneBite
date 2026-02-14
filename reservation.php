<?php
  include("config.php");
  $nav = "rev";
  include("header.php"); 
  if(isset($_POST['submit']) && $_POST['submit'] !='')
  {
    echo '<pre>';
    print_r($_POST);
    $first_name = trim($_POST['First']);
    $last_name = trim($_POST['Last']);
    $email = trim($_POST['Email']);
    $phone = trim($_POST['Phone']);
    $dob = trim($_POST['dateof']);
    $seat = trim($_POST['noofseat']);
    $location = trim($_POST['Location']);
    $timing = trim($_POST['Time']);
    $add_info = trim($_POST['Additional']);

    $add_reservation = "INSERT INTO reservation(first_name,last_name,email,phone,dob,total_seat,location,res_timing,information)
    VALUES('$first_name','$last_name','$email','$phone','$dob','$seat','$location','$timing','$add_info')";
    $run_reservation = mysqli_query($connect ,$add_reservation);
    if($run_reservation){
      header('Location: reservation.php');
    } else {
      echo '<script>alert("Reservation Added Error '.mysqli_error($connect).'")</script>';
  }

    echo $mail_body = "Dear ".$first_name." ".$last_name.",<br/><br/>Congratulations! Your Booking is Successfully Done.
    Follow description action details.
    <br/><br/><b>Name:</b>".$first_name." ".$last_name."<br/><b><br/>Email:</b>".$email."
    <br/><br/><b>Phone No:</b>".$phone."<br/><b><br/>Date of Reservation:</b>".$dob."
    <br/><br/><b>No of Seats:</b>".$seat."<br/><b><br/>Restorent Location:</b>".$location."
    <br/><br/><b>Time of Reservation:</b>".$timing."<br/><b><br/>Additional Information:</b>".$add_info."<br/><br/>
    Regards<br/>Administrator";

    echo $mail_body1 = "Dear ".$first_name." ".$last_name.",<br/><br/>Congratulations! Your Booking is Successfully Done.
    Follow description action details.
    <br/><br/><b>Name:</b>".$first_name." ".$last_name."<br/><b><br/>Email:</b>".$email."
    <br/><br/><b>Phone No:</b>".$phone."<br/><b><br/>Date of Reservation:</b>".$dob."
    <br/><br/><b>No of Seats:</b>".$seat."<br/><b><br/>Restorent Location:</b>".$location."
    <br/><br/><b>Time of Reservation:</b>".$timing."<br/><b><br/>Additional Information:</b>".$add_info."<br/><br/>
    Regards<br/>Administrator";

    $Select_mail = "SELECT * FROM `admin_master` WHERE username = 'admin'";
    $run_mail  =  mysqli_query($connect, $Select_mail);
    $admin_details  =  mysqli_fetch_array($run_mail);

   mail($admin_details['email_address'], '', 'Reservation', $mail_body);
   mail($email, '', 'Reservation', $mail_body1);
   echo '<script>("Reservation successfully", "you clicked the button!", "success";)</script>';
  }else{
    echo '<script>("something went wrong")</script>';
  }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <script type="text/javascript">
    $(document).ready(function () {
      var validator = $("#myform").validate({

        rules: {

          First: {
            required: true,
            minlength: 2
          },

          Last: {
            required: true,
            minlength: 2
          },

          Email: {
            required: true,
            email: true
          },
          Phone: {
            required: true,
            minlength: 10
          },

          dateof: "required",
          noofseat: "required",
          Location: "required",
          Time: "required",
          Additional: "required"
        },
        messages: {
          First: {
            required: "Please enter your First Name",
            minlength: "Your name must consist of at least 2 characters"
          },

          Last: {
            required: "Please enter your Last Name",
            minlength: "Your name must consist of at least 2 characters"
          },

          Email: "Please enter a valid email address",

          Phone: {
            required: "Please enter your Phone No",
            minlength: "Your Phone No must consist of at least 10 digits"
          },

          dateof:
          {
            required: "please enter date of reservation"
          },

          noofseat:
          {
            required: "please enter no fo seats"
          },

          Location:
          {
            required: "Please give Location"
          },

          Time:
          {
            required: "Please enter time of reservation"
          },

          Additional:
          {
            required: "Please enter Additional information"
          }

        },

        errorElement: "em",
        errorPlacement: function (error, element) {
          error.addClass("help-block rev_left");
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
      <img src="image/Ego-Mediterranean-Restaurant-Kenilworth-2-1.jpg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">RESERVATION</h3>
      </div>
    </div>
  </div>
  <!--start section element-->
  <div class="container cont_mar">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h4 class="res_text">BOOK YOUR RESERVATION ON TODAY!</h4>
        <p class="res_padd">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet purus consectetur,
          rhoncus urna eget, semper sapien. Integer vehicula, dolor gravida lobortis consectetur, lorem elit mollis
          magna, vitae rutrum velit nulla id dui.</p>
        <p>Morbi eu mattis justo, vitae porta orci. Sed et est a elit ultrices posuere. Fusce nibh enim, sollicitudin
          sed orci vitae, mollis elementum risus. Aliquam hendrerit, dui quis tincidunt ultrices, purus nisl aliquet
          enim, at eleifend nisi ante et justo.</p>
      </div>
      <form data-toggle="validator" role="form" id="myform" method="POST" action="">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
          <div class="col-md-4 col-sm-12 col-xs-12 cap_mar">
            <div class="valid">
              <input type="text" class="form-control input_height input_mar" placeholder="First name *" name="First">
            </div>
            <div class="valid">
              <input type="text" class="form-control input_height input_mar" placeholder="Last name *" name="Last">
            </div>
            <div class="valid">
              <input type="text" class="form-control input_height input_mar" placeholder="Email address *" name="Email">
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-xs-12 cap_mar">
            <div class="valid">
              <input type="text" class="form-control input_height input_mar" placeholder="Phone no *" name="Phone">
            </div>
            <div class="valid">
              <input type="date" class="form-control input_height input_mar" placeholder="Date of Reservation *"
                name="dateof">
            </div>
            <div class="valid">
              <input type="text" class="form-control input_height input_mar" placeholder="No of seats *"
                name="noofseat">
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-xs-12 cap_mar">
            <div class="valid">
              <input type="text" class="form-control input_height input_mar" placeholder="Resturant Location *"
                name="Location">
            </div>
            <div class="valid">
              <input type="text" class="form-control input_height input_mar"
                placeholder="Time of Reservation(ex.7:00pm-9:00pm) *" name="Time">
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 res_text_mar">
            <div class="valid">
              <textarea class="form-control width_c5" placeholder="Additional information *"
                name="Additional"></textarea>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 ress_mar">
            <button style="border: none" type="Submit" name="submit" value="submit" id="save" class="btn btn-danger bt_style pull-left">SUBMIT</button>
          </div>
      </form>
    </div>
  </div>
  </div>
  </div>
  <?php
    include("footer.php"); 
  ?>

</body>

</html>