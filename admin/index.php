<?php
include("config.php");

if(isset($_SESSION['id']))
	{
		header("location:dashboard.php");
	}
if(isset($_GET['logout']))
	{
		$_SESSION['SET_TYPE'] = 'success';
	    $_SESSION['SET_FLASH'] = 'You have logged out successfully';
	}
else if(isset($_GET['login']))
    {
		$_SESSION['SET_TYPE'] = 'error';
	    $_SESSION['SET_FLASH'] = 'You have to loggin for view this page';
	}
if(isset($_POST['login']))
	{
		$execute=trim($_POST['username']);
		$password=md5($_POST['password']);
        $chk_for_login="SELECT * FROM `admin_master` WHERE username='".$execute."' AND password='".$password."'";
		$check_run=mysqli_query($connect,$chk_for_login);
		$fetch_add=mysqli_fetch_array($check_run);
		if($fetch_add)
		{
			$_SESSION['adminname']=$fetch_add['username'];
			$_SESSION['email']=$fetch_add['email_address'];
			$_SESSION['id']=$fetch_add['id'];
			if(isset($_SESSION['admin_last_page']))
			{
				echo '<script>window.location.href="'.$_SESSION['admin_last_page'].'"</script>';
			}
			else
			{
				echo '<script>window.location.href = "dashboard.php"</script>';
			}			
		}
		else
		{			
			$_SESSION['SET_TYPE'] = 'error';
	        $_SESSION['SET_FLASH'] = 'Invalid username or password';
		}
	}
?>
<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Admin Panel </title>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	<script type="text/javascript" src="js/jquery.configuration.js"></script>
	<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function () {
			$("#login_form").validationEngine({ scroll: true })
		});
	</script>
</head>

<body style="background-image: url(../admin/images/secure.jpg); background-repeat: no-repeat; background-size: cover;">
	<div id="login-wrapper" class="png_bg">
		<div id="login-top" style="margin-top:-30px;;">&nbsp;</div>
		<div id="login-content" style="width:400px; max-width:90%; padding:30px; background:transparent; 
			border-radius:10px; box-shadow: 0 2px 4px 5px rgba(230, 229, 229, 0.45);
			 text-align:center;">
			<h4 style="margin-bottom:20px; color: #e0dedeff; font-size:25px;">Admin Login Panel</h4>
			<form method="post" id="login_form">
				<div class="input-group"
					style="display:flex; align-items:center; margin-bottom:10px; background:#f1f1f1; border-radius:5px; padding:5px 5px;">
					<img src="images/user.png" alt="Username" style="width:20px; margin-right:10px;">
					<input type="text" name="username" placeholder="Username"
						value="<?php if(isset($_POST['username'])) {echo $_POST['username'];} ?>"
						style="width:100%; margin: 8px; border:none; background:transparent;font-size: 12px;">
				</div>
				<div class="input-group"
					style="display:flex; align-items:center; margin-bottom:15px; background:#f1f1f1; border-radius:5px; padding:5px 10px;">
					<img src="images/password.png" alt="Password" style="width:24px; margin-right:10px;">
					<input type="password" name="password" placeholder="Password"
						style="width:100%; margin: 8px; border:none; background:transparent; outline:none; font-size:14px;">
				</div>
				<div style="display: flex;align-items: center;justify-content: center;gap: 10px;">
					<button type="submit" value="Sign In" name="login" style="background:#28a745; border:none; color:#fff; padding: 8px 16px;border-radius:5px;
						 cursor:pointer; font-weight:bold; transition:0.3s;">sign in</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>

<style>
	body {
	overflow: hidden;    
	}
	#login-wrapper {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh; 
	padding: 20px;
	}

	#login-content {
	width: 400px;
	max-width: 100%;
	background: #ffffff;
	border-radius: 12px;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
	padding: 30px 25px;
	text-align: center;
	}

	#login-content h4 {
	margin-bottom: 20px;
	color: #333;
	font-size: 22px;
	}

	.input-group {
	display: flex;
	align-items: center;
	margin-bottom: 15px;
	background: #f5f5f5;
	border-radius: 6px;
	padding: 8px 12px;
	}

	.input-group img {
	width: 22px;
	margin-right: 10px;
	}

	.input-group input {
	width: 100%;
	border: none;
	outline: none;
	background: transparent;
	font-size: 14px;
	padding: 8px 4px;
	}

	.form-actions {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-top: 20px;
	}

	.form-actions a {
	text-decoration: none;
	color: #007bff;
	font-size: 14px;
	}

	.form-actions a:hover {
	text-decoration: underline;
	}

	button[name="login"] {
	background: #28a745;
	border: none;
	color: #fff;
	padding: 8px 18px;
	border-radius: 6px;
	cursor: pointer;
	font-weight: bold;
	transition: 0.3s;
	}

	button[name="login"]:hover {
	background: #218838;
	}

	

</style>
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
	// if(isset($_REQUEST['m']) && $_REQUEST['m']=='E')
	// {
	// 	unset($_SESSION['SET_FLASH']);
	// 	unset($_SESSION['SET_TYPE']);
	// }
?>