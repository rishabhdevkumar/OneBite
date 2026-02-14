<?php
	include("config.php");
		if(isset($_POST['insert']))
		{
			$status=$_POST['status'];
			$img_caption=$_POST['img_caption'];
			$image = ($_FILES['img']['name']);
	  
			$type=explode('/',$_FILES['img']['type']);
			$types = array('jpeg','jpg','png','gif');
			if(in_array($type[1],$types))
	  		{
		  		$filename=basename($_FILES['img']['name']);
		  		$extension= pathinfo($filename,PATHINFO_EXTENSION);
		  		$new= md5($filename).'_'.rand(0000,999).'.'.$extension;
		  		$IMAGE= $new;
		  		$insert_gallery = "INSERT INTO `gallery_photo`(gallery_image,img_caption,status)VALUES('".$IMAGE."','".$img_caption."','".$status."')";
		  		$run_gallery = mysqli_query($connect,$insert_gallery);
		   		move_uploaded_file(($_FILES['img']['tmp_name']),'menu_img/'.$IMAGE);
		   		if($run_gallery)
		   		{
		   			header("location:list_gallery_photo.php");
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
	<title>Add Gallery Photo</title>

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.configuration.js"></script>

	<script type="text/javascript" language="javascript" src="js/jquery.validationEngine.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckeditor/_samples/sample.js"></script>
	<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
	<script type="text/javascript">
		$(document).ready(function () {
			$("#dashboard").validationEngine()
		});

		function chk_valid_img(input) {
			var file = document.getElementById("img").value;
			if (file) {
				var ext = file.match(/\.([^\.]+)$/)[1];
				switch (ext) {
					case 'jpg':
					case 'jpeg':
					case 'bmp':
					case 'png':
					case 'JPG':
					case 'JPEG':
					case 'BMP':
					case 'PNG':
						$("#preview1").html('<img src="images/loader.gif" alt="Uploading...."/>');
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							reader.onload = function (e) {

								document.getElementById('blah').style.display = "block";
								document.getElementById('preview1').style.display = "none";
								$('#blah').attr('src', e.target.result);
							}

							reader.readAsDataURL(input.files[0]);
						}
						return true;
						break;
					default:
						showError('Invalid file format');
						document.getElementById("img").value = '';
						return false;
				}
			}
			else {
				document.getElementById("menu_p").style.display = "block";
				document.getElementById("image_p1").style.display = "block";
			}
		}
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
					<h3>Add Photo</h3>
					<ul class="content-box-tabs">
						<li><a href="add_gallery_photo.php" class="default-tab">Add Photo</a></li>
						<li><a href="list_gallery_photo.php">Photo List</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" enctype="multipart/form-data" method="post">
							<p>
								<label></label>
							</p>
							<fieldset>
								<p id="image_p">
									<label>&nbsp;Gallery image&nbsp;<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[required]" type="file" id="img"
										name="img" onchange="chk_valid_img(this)" />
								</p>
								<div id="preview1">

								</div>
								<p>
									<img id="blah" src="#" alt="Preview" width="400" height="300"
										style="display:none;" />
								</p>
								<p id="image_p">
									<label>&nbsp;Image caption&nbsp;</label>
									<textarea class="text-input medium-input" id="img_caption"
										name="img_caption" /></textarea>
								</p>
								<p>
									<label>&nbsp;Status&nbsp;<span style="color:red;">*</span></label>
									<input class="validate[required]" type="radio" id="status" name="status" value="Y"
										<?php if(isset($_POST['status']) && ($_POST['status']=="Y" ) )
										{echo "checked='checked'" ;} ?>/>Active
									<input class="validate[required]" type="radio" id="status" name="status" value="N"
										<?php if(isset($_POST['status']) && ($_POST['status']=="N" ) )
										{echo "checked='checked'" ;} ?>/>Inactive
								</p>
								<p>
									<input class="button" type="submit" value="Save" id="insert" name="insert" />
								</p>
							</fieldset>
							<fieldset style="">
								<p id="preview"></p>
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