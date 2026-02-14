<?php
include("config.php");
if(isset($_POST['add']))
{
	$page_id = $_POST['category'];
	$name = $_POST['name'];
	$description = $_POST['desp'];
	$status = $_POST['status'];
	$add_home = $_POST['add_home'];
	$image = ($_FILES['img']['name']);
	$type = explode('/',$_FILES['img']['type']);
	$types = array('jpeg','jpg','png','gif');
	  if(in_array($type[1],$types))
	  {
		  $filename = basename($_FILES['img']['name']);
		  $extension = pathinfo($filename,PATHINFO_EXTENSION);
		  $new = md5($filename).'_'.rand(0000,999).'.'.$extension;
		  $IMAGE = $new;
		  $insert_category = "INSERT INTO `categories`(page_id,name,description,banner_image,status,add_home)
		  VALUES('".$page_id."','".$name."','".$description."','".$IMAGE."','".$status."','".$add_home."')";
		  $run_insert = mysqli_query($connect,$insert_category);
		   move_uploaded_file(($_FILES['img']['tmp_name']),'menu_img/'.$IMAGE);
		   if($run_insert)
		{
			header("Location:add_categories.php");
		}
		else
		{
			echo'<script> alert("INSERT ERROR")</script>';
		}
	  }
	  else
	  {
		 echo'<script>alert("IMAGE Error")</script>'; 
	  }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Burgatory Admin Add Categories</title>

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
	<div id="body-wrapper">
		<div id="sidebar">
			<div id="sidebar-wrapper">
				<?php require 'sidebar.php';?>
			</div>
		</div>
		<div id="main-content">
			<div class="content-box" style="box-shadow: 0px 0 12px 5px rgba(128, 122, 122, 0.29);width: 100%;">
				<div class="content-box-header">
					<h3>Add categories</h3>
					<ul class="content-box-tabs">
						<li><a href="add_categories.php" class="default-tab">Add category</a></li>
						<li><a href="list_categories.php">Category list</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" method="post" enctype="multipart/form-data">
							<fieldset>
								<div style="border:0px solid red;padding:8px;">
									<p style="width:50%;float:left;">
										<label>&nbsp;Page&nbsp;<span style="color:red;">*</span></label>
										<SELECT NAME="category" id="category" class="medium-input validate[required]">
											<option value="">Select</option>
											<?php
											   $page = "SELECT * FROM `pages` WHERE 1";
											   $run_page = mysqli_query($connect,$page);	
											   while($fetch_page = mysqli_fetch_array($run_page))
											  {
											?>
											<option value="<?php echo $fetch_page['id']?>">
												<?php echo $fetch_page['page_title']?>
											</option>
											<?php
											  }
										    ?>
										</SELECT>
									</p>
									<p style="width:50%;float:left;">
										<label>&nbsp;Status&nbsp;<span style="color:red;">*</span></label>
										<input class="validate[required]" type="radio" id="status" name="status"
											value="Y" />Active
										<input class="validate[required]" type="radio" id="status" name="status"
											value="N" />Inactive
									</p>
									<p style="width:50%;float:left;">
										<label>&nbsp;Add Home&nbsp;<span style="color:red;">*</span></label>
										<input class="validate[required]" type="radio" id="add_home" name="add_home"
											value="Y" />Yes
										<input class="validate[required]" type="radio" id="add_home" name="add_home"
											value="N" />No
									</p>
									<p style="padding-top:14px;border:0px solid red;float:left;width:100%;">
										<label>&nbsp;Image&nbsp;</label>
										<input class="text-input medium-input file1" type="file" id="file1"
											name="img" />
									</p>
									<div style="clear:both"></div>
								</div>
								<p>
									<label>&nbsp;Name&nbsp;</label>
									<div style="float:left;border:0px solid red;margin-top:-10px;">
										<div style="float:left;margin-left:-4px;">
											<span style="color:red;"></span>&nbsp;&nbsp;
										</div>
										<div style="float:left;">
											<input class=" text-input medium-input <?=$validate?>" type="text" id="name"
											name="name" value="" onkeypress="return checkname(event);" maxlength="255"
											style="width:170px !important;" placeholder="Name" />
										</div>
									</div>
								</p>
								<p style="padding-top:10px;border:0px solid red;float:left;width:100%;">
									<label>&nbsp;Description&nbsp;</label>
									<div style="float:left;border:0px solid red;margin-top:-10px;">
										<div style="float:left;margin-left:-4px;">
											&nbsp;&nbsp;
										</div>
										<div style="float:left">
											<textarea class="text-input" id="desp" name="desp" maxlength="255"
											style="width:170px !important;" placeholder="Description" /></textarea>
										</div>
									</div>
								</p>
								<p style="float:left;width:100%;margin-top: 11px;margin-left: 5px;">
									<button class="button" type="submit" value="Save" id="add" name="add">Add</button>
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
<style>
	.content-box {
		background: #fff;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
		padding: 10px;
		height: auto;
		overflow: visible;
	}
	.content-box-header {
		background: #ddd9d975;
		padding: 8px 12px;
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
		margin-bottom: 6px;
		color: #181818ff;
	}
	.button {
  		background: #000;
  		color: #fff;
  		padding: 10px 18px;
  		border: none;
  		border-radius: 6px;
  		font-size: 14px;
  		font-weight: bold;
  		cursor: pointer;
  		transition: background 0.3s;
  		text-decoration: none;
	}
	.button:hover {
  		color: #000;
  		background: #1abc9c;
  		text-decoration: none;
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