<?php
	include("config.php");
	$selct_admin = "SELECT * FROM `admin_master` WHERE 1";
	$run_admin = mysqli_query($connect,$selct_admin);
	$fetch = mysqli_fetch_array($run_admin);

	if(isset($_POST['update']))
	{
		$Name = $_POST['name'];
		$Email = $_POST['email'];
		$Address = $_POST['address'];
		$Phone = $_POST['phone'];
		$Password = $_POST['password'];
		$Confirm = $_POST['confirm'];

		if($Password == "") {
			$update_rec = "UPDATE admin_master SET username='".$Name."', email_address='".$Email."',
			address='".$Address."', Phone_no='".$Phone."'";
			$run_update = mysqli_query($connect,$update_rec);
		  
		} else if($Password == $Confirm)
			{
				$Pass=md5($Password);
				 $update_rec = "UPDATE admin_master SET username='".$Name."', email_address='".$Email."',
				address='".$Address."', Phone_no='".$Phone."', password='".$Pass."'";
				$run_update = mysqli_query($connect,$update_rec);
		}
		else
		{
			echo '<script>alert("password and confirm password do not match")</script>';
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Dashboard</title>
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

		$('.RemoveRow').live('click', function () {

			$(this).closest('tr').remove();

		});

	</script>
</head>

<body>
	<div id="body-wrapper" style="background: #f8f8f8ff;">
		<div id="sidebar">
			<div id="sidebar-wrapper">
				<?php require 'sidebar.php'; ?>
			</div>
		</div>
		<div id="main-header">
			<div class="notification">
				<a href="notifications.php">
					<img src="../admin/images/alarm.png" alt="">
					<span class="badge">3</span>
				</a>
			</div>
			<div class="profile">
				<img src="" alt="" class="profile-img">
				<span class="profile-name">John Doe</span>
			</div>
		</div>
		<div id="main-content">
			<div class="content-box" style="box-shadow: 0px 0 12px 5px rgba(128, 122, 122, 0.29);width: 100%;">
				<div class="content-box-header">
					<h3>Admin Details</h3>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" method="post">
							<fieldset>
								<p>
									<label>Username<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[required,custom[onlyLetterSp]]"
										placeholder="name" type="text" id="name" name="name"
										value="<?php echo $fetch['username']; ?>"
										onkeypress="return checkname(event);" />
								</p>
								<p>
									<label>Email Address<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[required,custom[email]]" type="text"
										placeholder="email" id="email" name="email"
										value="<?php echo $fetch['email_address']; ?>" />
								</p>
								<p>
									<label>Address<span style="color:red;">*</span></label>
									<textarea class="text-input medium-input validate[required]" placeholder="address"
										id="address" name="address" value=""><?php echo $fetch['address']; ?>
									</textarea>
								</p>
								<p>
									<label>Phone No<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[required]" type="text"
										placeholder="phone no" id="phone" name="phone"
										value="<?php echo $fetch['phone_no']; ?>" />
								</p>
								<p>
									<label>Password<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[equals[confirm]]" type="password"
										id="password" name="password" />
								</p>
								<p>
									<label>Confirm password<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[equals[password]]" type="password"
										id="confirm" name="confirm" />
								</p>
								<button class="button" type="submit" value="update" id="update"
									name="update">Update</button>
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
 
<style>
	.content-box {
		background: #fff;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
		padding: 10px;
		margin-top: 4%;
		color: #fff;
		height: auto;
		min-height: 600px;
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

	form input[type="text"],
	form input[type="password"],
	form textarea {
		width: 100%;
		border: 1px solid #5e5e5ed8;
		border-radius: 5px;
		font-size: 14px;
		color: #2b2b2bff;
	}

	form textarea {
		min-height: 50px;
		resize: none;
	}

	.button {
		background: #000;
		border: none;
		padding: 5px;
		border-radius: 5px;
		color: #fff;
		cursor: pointer;
		transition: background 0.3s ease;
	}

	.button:hover {
		background: #069e39;
		text-decoration: none;
	}

	#main-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 15px 20px;
		position: relative;
		gap: 30px;
	}

	.notification {
		position: relative;
		cursor: pointer;
	}

	.notification img {
		width: 30px;
		height: 30px;
	}

	.badge {
		position: absolute;
		top: -5px;
		right: -5px;
		background: red;
		color: white;
		border-radius: 50%;
		padding: 2px 6px;
		font-size: 12px;
		margin: 4px 0px 0px 10px;
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

	#main-header {
		background-color: #0c1741ff;
		padding: 8px 10px;
		display: flex;
		align-items: center;
		justify-content: flex-end;
		color: #fff;

		position: fixed;
		top: 0;
		left: 230px;
		width: calc(100% - 200px);
		z-index: 1000;
	}

	.profile {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-right: 7%;
	}

	.profile-img {
		width: 30px;
		height: 30px;
		border-radius: 50%;
		border: 2px solid #fff;
	}

	.profile-name {
		font-size: 16px;
		font-weight: 500;
		margin-left: 10px;
	}

	#sidebar {
		width: 230px;
		position: fixed;
		top: 0;
		left: 0;
		bottom: 0;
		z-index: 999;
	}
</style>
