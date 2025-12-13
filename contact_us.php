<?php
  include("config.php");
  $nav = "contact";
  include("header.php"); 
  if(isset($_POST['submit']) && isset($_POST['submit'])!='')
  {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['sub']);
    $enquiry = trim($_POST['enq']);
    $phone = trim($_POST['phone']);

    $add_enquiry = "INSERT INTO enquiry(name,email,subject,enquiry,phone)
    VALUES('".$name."','".$email."','".$subject."','".$enquiry."','".$phone."')";
    $run_enquiry = mysqli_query($connect ,$add_enquiry);
    if($run_enquiry){
     header('location: contact_us.php');
    } else {
      echo '<script>alert("Enquiry Added Error")</script>';
    }

    $mail_body = "Dear" .$name.",<br/><br/>Congratulations! We got your enquiry details.
    we will processing It as soon As Possible .... Thank You...
    <br/><br/> Following your enquiry Details
    <br/><br/><b>Name:</b>".$name."<br/><b><br/>Email:</b>".$email.";
    <br/><br/><b>Subject:</b>".$subject."<br/><b><br/>Enquiry Message:</b>".$enquiry."<br/><br/>Regards<br/>Administrator";

    $mail_body1 = "Dear" .$name.",<br/><br/>Congratulations! We got your enquiry details.
    we will processing It as soon As Possible .... Thank You...
    <br/><br/> Following your enquiry Details
    <br/><br/><b>Name:</b>".$name."<br/><b><br/>Email:</b>".$email.";
    <br/><br/><b>Subject:</b>".$subject."<br/><b><br/>Enquiry Message:</b>".$enquiry."<br/><br/>Regards<br/>resturent name";

    $Select_mail = "SELECT * FROM `admin_master` WHERE username = 'admin'";
    $run  =  mysqli_query($connect, $Select_mail);
    $admin_details  =  mysqli_fetch_array($run);

    mail($email, '', 'enquiry', $mail_body1);
    mail($admin_details['email_address'], '', 'enquiry', $mail_body);
    echo '<script> alert("your enquiry send successfully", "you clicked the button!", " success")</script>';
    }else{
      echo '<script> swal("something went wrong")</script>';
    }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript">

    $(document).ready(function () {
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

          sub: "required",
          enq: "required"
        },
        messages: {

          name: {
            required: "Please enter your Last Name",
            minlength: "Your name must consist of at least 2 characters"
          },

          email: "Please enter a valid email address",

          phone: {
            required: "Please enter your Phone No",
            minlength: "Your Phone No must consist of at least 10 digits"
          },

          sub:
          {
            required: "please enter Subject"
          },

          enq:
          {
            required: "Please enter enquiry"
          }

        },

        errorElement: "em",
        errorPlacement: function (error, element) {
          error.addClass("help-block rev_left1");
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
      <img src="image/41993-das-loft-sofitel-19to1.jpeg" class="pos_re">
      <div class="carousel-caption abt_margin">
        <h3 class="abt_width">CONTACT US</h3>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 map_heihgt1 u_map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14736.2936651799!2d88.42520676582065!3d22.57635731172786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0275b020703c0d%3A0xece6f8e0fc2e1613!2sSector+V%2C+Salt+Lake+City%2C+Kolkata%2C+West+Bengal!5e0!3m2!1sen!2sin!4v1524148893398"
          frameborder="0" style="border:0" allowfullscreen class="regs"></iframe>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-4 col-sm-12 col-xs-12 cap_mar">
          <h5 class="cont_add">ADDRESS</h5>
          <p class="pad_add">Balrampur, Gamharia</p>
          <p>Jamshedpur, Jharkhand</p>
          <p>832108</p>
          <p class="undr_line1"></p>
          <h5 class="cont_add1">TELEPHONES</h5>
          <p class="pad_add">Restaurant : 6566757677766</p>
          <p> Fax : 7467658908676</p>
          <p class="undr_line1"></p>
          <h5 class="cont_add1">LET’S STAY IN TOUCH</h5>
          <p class="pad_add">Lorem ipsum dotlor
            sit amet,consectetur
            adipiscing elit.
            Vivamus sit amet purus consectetur,rhoncus
            urna eget,semper sapien.Integer vehicula,
            dolor gravida lobortis consectetur,lorem
            elit mollis magna,vitae rutrum velit nulla
            id dui.Morbi eu mattis justo,vitae porta orci.</p>
        </div>
        <div class="col-md-8 col-sm-12 col-xs-12">
          <form class="form_pad" form data-toggle="validator" role="form" id="myform" method="POST" action="">
            <div class="form-group">
              <p class="p_marg">Your email address will be held strictly confidential. Required fields are marked *</p>
              <div class="valid">
                <input type="text" class="form-control width_c3" placeholder="Name *" name="name">
              </div>
            </div>
            <div class="form-group">
              <div class="valid">
                <input type="text" class="form-control width_c3" placeholder="Email *" name="email">
              </div>
            </div>
            <div class="form-group">
              <div class="valid">
                <input type="number" class="form-control width_c3" placeholder="Phone no *" name="phone">
              </div>
            </div>
            <div class="form-group">
              <div class="valid">
                <input type="text" class="form-control width_c3" placeholder="Subject *" name="sub">
              </div>
            </div>
            <div class="form-group">
              <div class="valid">
                <textarea class="form-control width_c4" placeholder="Inquiry *" name="enq"></textarea>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 pad_add1">
              <button style="border: none" type="Submit" name="submit" value="submit" class="btn btn-danger bt_style">SUBMIT INQUIRY</button>
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