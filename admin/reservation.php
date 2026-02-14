<?php include_once("admin/includes/main_init.php"); 
	
?>
<?php
//print_r($_SESSION);
//echo($_POST['search_name']);
$admin_details=find('first',ADMIN,'*','where 1',array());
//print_r($admin_details);
if(isset($_POST['reserv']))
{   //print_r($_POST);
   // exit;
    if($_SESSION['lang_id']=='1')
    {
        $mail_body_for_admin = "Dear Administrator,<br/><br/>
        A new reservation have been done through your website. Following describe the submitted details.<br/><br/><b>Name: </b>"
        .$_POST['name'].
        "<br/><b>E-mail: </b>".trim($_POST['email']).
        "<br/><b>Reservation Date: </b>".$_POST['date'].
        "<br/><b>Time: </b>".$_POST['time_hour'].':'.$_POST['time_min'].
        "<br/><b>Name: </b>".trim($_POST['name']).
        "<br/><b>Address: </b>".trim($_POST['add']).
        "<br/><b>City: </b>".trim($_POST['city']).
        "<br/><b>Phone no.: </b>".trim($_POST['phone']).
        "<br/><b>Number of person: </b>".trim($_POST['nop']).
        "<br/><b>Message: </b>".nl2br($_POST['s_request'])."".'<br><br><br>'.'Regards,'.'<br>Administrator,<br>Dosa Indian Restaurant';
    }
    else
    {
		$mail_body_for_admin = "Dear Administrator,<br/><br/>
        A new reservation have been done through your website. Following describe the submitted details.<br/><br/><b>Name: </b>"
        .$_POST['name'].
        "<br/><b>E-mail: </b>".trim($_POST['email']).
        "<br/><b>Reservation Date: </b>".$_POST['date'].
        "<br/><b>Time: </b>".$_POST['time_hour'].':'.$_POST['time_min'].
        "<br/><b>Name: </b>".trim($_POST['name']).
        "<br/><b>Address: </b>".trim($_POST['add']).
        "<br/><b>City: </b>".trim($_POST['city']).
        "<br/><b>Phone no.: </b>".trim($_POST['phone']).
        "<br/><b>Number of person: </b>".trim($_POST['nop']).
        "<br/><b>Message: </b>".nl2br($_POST['s_request'])."".'<br><br><br>'.'Regards,'.'<br>Administrator,<br>Dosa Indian Restaurant';
	}
    if($_SESSION['lang_id']=='1')
    {
		$mail_body_for_user = "Dear ".$_POST['name'].",<br/><br/>
        Your reservation have been confirmed successfully. Following describe the submitted details.<br/><br/><b>Name: </b>"
        .$_POST['name'].
        "<br/><b>E-mail: </b>".trim($_POST['email']).
        "<br/><b>Reservation Date: </b>".$_POST['date'].
        "<br/><b>Time: </b>".$_POST['time_hour'].':'.$_POST['time_min'].
        "<br/><b>Name: </b>".$_POST['name'].
        "<br/><b>Address: </b>".$_POST['add'].
        "<br/><b>City: </b>".$_POST['city'].
        "<br/><b>Phone no.: </b>".$_POST['phone'].
        "<br/><b>Number of person: </b>".$_POST['nop'].
        "<br/><b>Message: </b>".nl2br($_POST['s_request'])."".'<br><br><br>'.'Regards,'.'<br>Administrator,<br>Dosa Indian Restaurant';
	}
	else
	{
		$mail_body_for_user = "Dear Administrator,<br/><br/>
        A new reservation have been done through your website. Following describe the submitted details.<br/><br/><b>Name: </b>"
        .$_POST['name'].
        "<br/><b>E-mail: </b>".$_POST['email'].
        "<br/><b>Reservation Date: </b>".$_POST['date'].
        "<br/><b>Time: </b>".$_POST['time_hour'].':'.$_POST['time_min'].
        "<br/><b>Name: </b>".$_POST['name'].
        "<br/><b>Address: </b>".$_POST['add'].
        "<br/><b>City: </b>".$_POST['city'].
        "<br/><b>Phone no.: </b>".$_POST['phone'].
        "<br/><b>Amount of people: </b>".$_POST['nop'].
        "<br/><b>Message: </b>".nl2br($_POST['s_request'])."".'<br><br><br>'.'Regards,'.'<br>Administrator,<br>Dosa Indian Restaurant';
	}
    $mail_subject="New Reservation";
    $mailcc="";
    $mail_user=$_POST['email'];
    $where_clause="where 1";
    //echo $where_clause;
    $condition = array();
    $find_name = find('first',ADMIN,'*',$where_clause,$condition);
    $mail_to=$find_name['reservation_email'];
    $mail_from=$find_name['email_address'];
    
    $admin_mailing = @Send_HTML_Mail($mail_to, $mail_from, $mailcc, $mail_subject, $mail_body_for_admin);
    $user_mailing = @Send_HTML_Mail($mail_user, $mail_to, $mailcc, $mail_subject, $mail_body_for_user);
    if($admin_mailing)
    {
        $_SESSION['SET_TYPE'] = 'success';
        if(isset($_SESSION['lang_id']) && $_SESSION['lang_id']==1){$_SESSION['SET_FLASH'] = 'Thank you for contacting us. We will get back to you within next 24 hours';}
        else{$_SESSION['SET_FLASH'] = 'Grazie per averci contattato. Vi risponderemo a voi entro 24 ore successive';}
    }
    else
    {
		 $_SESSION['SET_TYPE'] = 'error';
		 $_SESSION['SET_FLASH'] =  'Something went wrong! Please try again!';
	}
	
}

$execute=array(':id'=>($_SESSION['SESS_USER_ID']));
$fetch=find("first",ADMIN,"*", "where id=:id", $execute);	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" 
<html>
<?php include_once('head.php'); ?>
<body onLoad="reloadIt()">
<div id="wrap" style="position:relative">
	<?php include_once('header_other.php') ?>
		<!-- -------------------------orderonline---------------------------------------------- -->
    <?php include_once('open_cart.php') ?>
    <!-- -------------------------orderonline end---------------------------------------------- -->


<section class="contant-foto no-padding">	
	<div class="container nopadd">
		<div class="row">
			<div class="col-md-12">
			<div style="height:40px;position:relative;">
			<div style="" class="rangoli"><img src="img/rangoli2.png" style="width:100%"></div>
			<div style="" class="dosa"><img src="img/dosa3.png" style="width:100%"></div>
			</div>
				<div class="light1">
					<div class="row">
		<h1 class='title'><span class="head_menu">Reservation</span> <span class="head_menu2">Here</span></h1>
		<div class="contact_form">
		  <div style="" class="reservation_text">Reservation Form</div>
		   <form action="" id="contact" method="post" enctype="multipart/form-data">
			  		  	<div class="name_field_1">
				<span class="name_field3_1">Date</span><span class="form_span">:</span><input type="text" name="date" id="datepicker"  >
				<div style="clear:both;"></div>
			</div>

		  	<div class="name_field_1">
			  <span class="name_field3_1">Reservation Time</span><span style="" class="form_span">:</span>
			  <span>
			  <div  class="reservation_time">
			  <select name="time_hour" class="vfb-select">
			  <option value="00">00</option>
			  <option value="01">01</option>
			  <option value="02">02</option>
			  <option value="03">03</option>
			  <option value="04">04</option>
			  <option value="05">05</option>
			  <option value="06">06</option>
			  <option value="07">07</option>
			  <option value="08">08</option>
			  <option value="09">09</option>
			  <option value="10">10</option>
			  <option value="11">11</option>
			  <option value="12">12</option>
			  <option value="13">13</option>
			  <option value="14">14</option>
			  <option value="15">15</option>
			  <option value="16">16</option>
			  <option value="17">17</option>
			  <option value="18">18</option>
			  <option value="19">19</option>
			  <option value="20">20</option>
			  <option value="21">21</option>
			  <option value="22">22</option>
			  <option value="23">23</option>
			  </select>
			  <label style='color:white'>HH</label>
			  <span class="vfb-time">
			  <select name="time_min" id="vfb-6-min" class="vfb-select">
			  <option value="00">00</option>
			  <option value="05">05</option>
			  <option value="10">10</option>
			  <option value="15">15</option>
			  <option value="20">20</option>
			  <option value="25">25</option>
			  <option value="30">30</option>
			  <option value="35">35</option>
			  <option value="40">40</option>
			  <option value="45">45</option>
			  <option value="50">50</option>
			  <option value="55">55</option>
			  </select>
			  <label style='color:white'>MM</label></span>
			  </div>
			  </span>
			  <div style="clear:both;"></div>
			</div>
			<div class="name_field_1">
			  <span class="name_field3_1">Name</span>
			  <span style="" class="form_span">:</span>
			  <input type="text" id="name" name="name" maxlength="40" class="validate[required]"  placeholder="Enter Your Name" >
			  <div style="clear:both;"></div>
			</div>
			<div class="name_field_1">
			<span class="name_field3_1">Address</span><span class="form_span">:</span>
			<textarea name="add" rows="2" cols="1" maxlength="255" class="validate[required]" id="add" placeholder="Enter Your Address"></textarea>
				 <div style="clear:both;"></div>
			</div>
			<div class="name_field_1">
			  <span class="name_field3_1">City</span><span style="" class="form_span">:</span>
			  <input type="text" class="validate[required]" id="city" maxlength="40" name="city" placeholder="Enter Your City">
			  <div style="clear:both;"></div>
			</div>

			<div class="name_field_1">
				<span class="name_field3_1">Phone no.</span><span class="form_span">:</span>
				<input type="text" maxlength="20" class="validate[required]" id="phone"  name="phone" placeholder="Enter Your Phone No.">
				<div style="clear:both;"></div>
			</div>
			<div class="name_field_1">
				<span class="name_field3_1">E-mail</span><span class="form_span">:</span>
				<input type="text" maxlength="40" id="email" name="email" class="validate[required,custom[email]]" placeholder="Enter Your E-mail">
				<div style="clear:both;"></div>
			</div>
			<div class="name_field_1">
				<span class="name_field3_1">No. of person</span><span class="form_span">:</span>
				<input type="text" maxlength="3" id="no_of_people" name="nop" placeholder="Enter the no of person" class="validate[required]">
				<div style="clear:both;"></div>
			</div>
			<div class="name_field_1">
				<span class="name_field3_1">Special Request</span><span class="form_span">:</span>
				<textarea name="s_request" placeholder="Enter Your Comment"  rows="2" cols="1" ></textarea>
				 <div style="clear:both;"></div>
			</div>
			<div class="name_field01">
			  <input type="submit" value="Submit" name='reserv' id="submit" class="reset">
			  <input type="button" value="Reset"  class="reset">
				<div style="clear:both;"></div>
			</div>
			</form>

			</div>
			<div id="contuct_pic">
				<div class="col-md-4 col-sm-4 col-xs-6">
				<img src='img/slide1.jpg' class="img-circle" style="border:3px solid #fff"/>
			</div>
			</div>

			
		</div>
		</div>
	</div>
</section>




   <div class="footerbuttons">
   		<div class="container">
   <div class="spacer"></div>
	<div class="copyright">Website Design & Developed By: <a href="http://www.earthtechnology.co.in/" target="_blank" style="text-decoration:none;color:#a06015;font-size:18px;">Earth Technology Pvt. Ltd. </a></div>
		</div>	
	</div>		
</div> 

</body>
<script src="admin/date_picker/ui/jquery.ui.core.js"></script>
		<script src="admin/date_picker/ui/jquery.ui.widget.js"></script>
		<script src="admin/date_picker/ui/jquery.ui.datepicker.js"></script>
		<link rel="stylesheet" href="admin/date_picker/base/jquery.ui.all.css">
 <script type="text/javascript">
        
		    $(function() {
			$( "#datepicker" ).datepicker({
				minDate: 'today',
				showOn: 'both', 
				buttonImageOnly: true,
				buttonImage: 'images/calendar_icon.png' });
			});
			
 </script>
<script>
	
			$(document).ready(function() {
				       $("#contact").validationEngine();
			});
	       </script>
<!-- <?php 
	if(isset($_SESSION['SET_FLASH']))
	{
		if($_SESSION['SET_TYPE']=='success')
		{
			echo "<script type='text/javascript'>showSuccess('".$_SESSION['SET_FLASH']."');</script>";
		}
		else if($_SESSION['SET_TYPE']=='error')
		{
			echo "<script type='text/javascript'>showError('".$_SESSION['SET_FLASH']."');</script>";
		}
	}

	//destroy session flash message
	//if(isset($_REQUEST['m']) && $_REQUEST['m']=='E')
	//{
		unset($_SESSION['SET_FLASH']);
		unset($_SESSION['SET_TYPE']);
	//}
?> -->

</html>
