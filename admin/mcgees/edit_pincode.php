<?php
	include("includes/main_init.php");
	if(!isset($_SESSION['id']))
	{
		header("location:index.php?login");
	}
	
	if(isset($_GET["eid"]))
	{
		$execute=array(':id'=>$_GET["eid"]);
		$find_pincode=find("first",PINCODE,"*", "where id=:id", $execute);
	}
	if(isset($_POST['add']))
	{
		$pincode=stripslashes(trim($_POST['pincode']));
		$execute=array(':id'=>$_GET["eid"], ':pincode'=>$pincode);
        $exe_find_machine_pincode=find("first", PINCODE, "id", "where id!=:id AND pincode=:pincode", $execute);
		
		if(empty($exe_find_machine_pincode))
		{
				$pincode=stripslashes(trim($_POST['pincode']));
				$fields11="pincode=:pincode,order_amount=:order_amount";
				$values11="where id =:id";
				$execute11=array(':pincode'=>$pincode,':order_amount'=>trim($_POST["amount"]),':id'=>$_GET['eid']);
				$sv_mchne1=update(PINCODE, $fields11, $values11, $execute11);

				if(isset($sv_mchne1))
				{
					header('location:list_pincode.php?upd&page='.$_GET["page"]);
				}
		 
		}	
		else
		{
		  $_SESSION['SET_TYPE'] = 'error';
	      $_SESSION['SET_FLASH'] = 'Same pincode already exists';
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Edit Pincode || Mc Gee's Irish Pub & Restaurant</title>	  
		
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	    <link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/jquery.configuration.js"></script>
		
		
		
	<script type="text/javascript" language="javascript" src="js/jquery.validationEngine.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
	<script type="text/javascript">
  			$(document).ready(function() {
				$("#dashboard").validationEngine()});	

				function noNumbers(e,validchars)
				{
					 var key='', keychar='';
					 key = getKeyCode(e);
					 if (key == null) return true;
					 keychar = String.fromCharCode(key);
					 keychar = keychar.toLowerCase();
					 validchars = validchars.toLowerCase();
					 if (validchars.indexOf(keychar) != -1)
					  return true;
					 if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
					  return true;
					 return false;
				}
				function getKeyCode(e) {
					 if (window.event)
						return window.event.keyCode;
					 else if (e)
						return e.which;
					 else
						return null;
				}
	</script>
	</head>  
  
	<body>
		<div id="body-wrapper">		
			<div id="sidebar">
				<div id="sidebar-wrapper">
					<?php require 'sidebar.php'; ?>
				</div>
			</div>
			<div id="main-content"> 
				<div class="content-box">
					<div class="content-box-header">
						<h3>Edit Pincode</h3>
							<ul class="content-box-tabs">
								<li><a href="add_pincode.php">Add Picode</a></li> 
								<li><a href="list_pincode.php">List of Pincode</a></li>
							</ul>						
						<div class="clear"></div>
					</div>
					<div class="content-box-content">
						<div class="tab-content">
							<form action="" id="dashboard" method="post">
								<fieldset> 	
									
									<p>
										<label>&nbsp;Pincode&nbsp;<span style="color:red;">*</span></label>
										<input class="text-input medium-input validate[required]" type="text" id="pincode" name="pincode" value="<?php if(isset($_POST["pincode"])) { echo $_POST["pincode"]; } else { if(isset($find_pincode['pincode'])) {echo $find_pincode['pincode'];} } ?>" maxlength="255"/>
									</p>
									<p>
										<label>&nbsp;Minimum Order Amount&nbsp;<span style="color:red;">*</span></label>
										<input class="text-input medium-input validate[required,custom[number]]" type="text" id="amount" name="amount" value="<?php if(isset($_POST["amount"])) { echo $_POST["amount"]; } else { if(isset($find_pincode['order_amount'])) {echo $find_pincode['order_amount'];} } ?>" maxlength="255" onkeydown="return noNumbers(event,'1234567890')"/>
									</p>
								
									<p>
										<input class="button" type="submit" value="Update" id="add" name="add"/>
									</p>									
								</fieldset>
								<div class="clear"></div>
							</form>							
						</div>
					</div> 
				</div> 
				<div class="clear"></div>
			</div>
		</div>
	</body> 
</html>
<?php 
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
?>