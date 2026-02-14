<?php
	include("config.php");
	if(isset($_POST['add']))
	{
		$page = $_POST['name'];
		$check_page = "SELECT * FROM `pages` WHERE page_title='".$page."'";
		$check_run = mysqli_query($connect,$check_page);
		$num_rows = mysqli_num_rows($check_run);
		if($num_rows>0)
		{
			echo'<script>alert("This Page Already Exist")</script>';
		}
		else
		{
			echo $insert_page = "INSERT INTO pages(page_title)VALUES('".$page."')";
			$run = mysqli_query($connect,$insert_page);
			if($run)
			{
				header("location: add_pages.php");
			}
			else
			{
				echo'<script>alert("INSERT ERROR")</script>';
			}
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Burgatory Admin || Add Pages</title>

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
		$(document).ready(function () {
			$("#dashboard").validationEngine()
		});
		function checkname(e) {
			if (document.getElementById("name").value.length == 0 && e.which == 32) {
				return false;
			}
		}
	</script>
</head>

<body style="background: #f8f8f8ff">
	<div id="body-wrapper" style="background: #f8f8f8ff">
		<div id="sidebar">
			<div id="sidebar-wrapper">
				<?php require 'sidebar.php'; ?>
			</div>
		</div>
		<div id="main-content">
			<div class="content-box" style="box-shadow: 0px 0 12px 5px rgba(128, 122, 122, 0.29);width: 100%;">
				<div class="content-box-header">
					<h3>Add pages</h3>
					<ul class="content-box-tabs">
						<li><a href="add_pages.php" class="default-tab">Add pages</a></li>
						<li><a href="list_pages.php">Page list</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" method="post">
							<fieldset>
								<p>
									<label>&nbsp;Page title&nbsp;<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[required]" type="text" id="name"
										name="name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>"
										onkeypress="return checkname(event);" maxlength="255" placeholder="Enter page title" />
								</p>
								<button class="button" type="submit" value="Save" id="add" name="add">Add Page</button>
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

	if(isset($_REQUEST['m']) && $_REQUEST['m']=='E')
	{
		unset($_SESSION['SET_FLASH']);
		unset($_SESSION['SET_TYPE']);
	}
?>
<style>
	body {
		overflow: hidden;
	}
	#main-content{
		margin-top: 50px;
	}
	.content-box {
		background: #fff;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
		padding: 10px;
		color: #fff;
		height: auto;
		overflow: hidden;
	}
	.content-box-header {
		background: #ddd9d975;
		padding: 5px;
		border-radius: 8px 8px 0 0;
		border: none;
	}

	.content-box-header h3 {
		margin: 0;
		font-size: 20px;
		color: #000;
		font-weight: bold;
	}

	form label {
		font-weight: 500;
		display: block;
		color: #181818ff;
	}

	.button {
	color: #000;
	padding: 5px;
	border-radius: 5px;
	background: #ddd9d975;
	text-decoration: none;  
	border: none;           

	&:hover {
	color: #fff;
	border: none;          
	text-decoration: none; 
	background: #058899ff;
	}
	}
	@media (max-width: 768px) {
		#main-content {
			padding: 10px;
			align-items: flex-start;
		}

		.content-box {
			max-width: 100%;
			padding: 15px;
		}

		.content-box-header h3 {
			font-size: 18px;
		}
	}
</style>