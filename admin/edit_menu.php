<?php
	include("config.php");
	$page_id=$_GET['page_id'];
	$category_id=$_GET['cat_id'];
	$sub_category_id=$_GET['sub_cat_id'];
	$menu_id=$_GET['menu_id'];

	$check_menu = "SELECT * FROM `menu` WHERE id='".$menu_id."'";
	$run_menu = mysqli_query($connect,$check_menu);
	$fetch_menu = mysqli_fetch_array($run_menu);
	

if(isset($_POST['insert']))
{
	$page_id=$_POST['page'];
	$catogory_id=$_POST['category'];
	/*$sub_category_id=$_POST['sub_category'];*/
	$menu_no=$_POST['menu_no'];
	$menu_price=$_POST['price'];
	$status=$_POST['status'];
	$add_home=$_POST['add_home'];
	$menu_title=$_POST['menu_name'];
	$menu_description=$_POST['desp'];
	$image = ($_FILES['img']['name']);
	  
		$type=explode('/',$_FILES['img']['type']);
		$types = array('jpeg','jpg','png','gif');
	  if(in_array($type[1],$types))
	  {
		  $filename=basename($_FILES['img']['name']);
		  $extension= pathinfo($filename,PATHINFO_EXTENSION);
		  $new= md5($filename).'_'.rand(0000,999).'.'.$extension;
		  $IMAGE= $new;
		  $path='menu_img/'.$fetch_menu['menu_image'].'';
		  $update_menu = "UPDATE `menu` SET page_id='".$page_id."',category_id='".$catogory_id."',menu_title='".$menu_title."',menu_description='".$menu_description."',menu_image='".$IMAGE."',
		  menu_price='".$menu_price."',menu_no='".$menu_no."',status='".$status."',add_home='".$add_home."' WHERE id='".$menu_id."'";
		  $run_update = mysqli_query($connect,$update_menu);
		  unlink($path);
		   move_uploaded_file(($_FILES['img']['tmp_name']),'menu_img/'.$IMAGE);
		   if($run_update)
		{
			
			header("location:list_menu.php?cat_id=".$page_id."&cat_id1=".$category_id."");
		}
		else
		{
			echo'<script> alert("UPDATE ERROR")</script>';
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

	<title>BURGATORY Admin Edit menu</title>

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	<script type="text/javascript" src="js/jquery.preimage.js"></script>
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
					<h3>Add menu</h3>
					<ul class="content-box-tabs">
						<li><a href="add_menu.php" class="default-tab">Add menu</a></li>
						<li><a href="list_menu.php">List menu</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" enctype="multipart/form-data" method="post">
							<fieldset>
								<div style="background-color:#e7e7e7;border:0px solid red;padding:8px;">
									<p style="width:50%;float:left;">
										<label>&nbsp;Page&nbsp;<span style="color:red;">*</span></label>
										<SELECT NAME="page" id="page" class="medium-input validate[required]"
											onchange="chk_cat(this.value)">
											<option value="">Select</option>
											<?php
													$page = "SELECT * FROM `pages` WHERE 1";
													$run_page = mysqli_query($connect,$page);	
													while($fetch_page=mysqli_fetch_array($run_page))
													{
												?>
											<option value="<?php echo $fetch_page['id']?>" <?php
												if(isset($_GET['page_id']) && $fetch_menu['page_id']==$fetch_page['id'])
												{echo "selected='selected'" ;}?>>
												<?php echo $fetch_page['page_title']?>
											</option>
											<?php
												}
											?>
										</SELECT>
									</p>
									<p style="width:50%;float:left;border:0px solid red;">
										<label>&nbsp;Category&nbsp;<span style="color:red;">*</span></label>
									<div id="cat_drop">
										<SELECT NAME="category" id="category" class="small-input validate[required]"
											onchange="chk_cat1(this.value,<?php echo $_GET['cat_id']?>)"
											style="width:260px !important;">
											<option value="">Select</option>
											<?php
													$check_page = "SELECT * FROM `categories` WHERE page_id='".$_GET['page_id']."'";
													$run_check=mysqli_query($connect,$check_page);
											 		while($fetch=mysqli_fetch_array($run_check))
												 	{
												?>
											<option value="<?php echo $fetch['id']?>" <?php if(isset($_GET['cat_id']) &&
												$fetch_menu['category_id']==$fetch['id']) {echo "selected='selected'"
												;}?>>
												<?php echo $fetch['name']?>
											</option>
											<?php
														}
													?>
										</SELECT>
									</div>
									</p>
									<p style="float:left;width:50%;padding-top:17px;border:0px solid red;">
										<label>&nbsp;Menu number&nbsp;<span style="color:red;">*</span></label>
										<input class="text-input medium-input validate[required]" type="text"
											id="menu_no" name="menu_no" value="<?php echo $fetch_menu['menu_no']?>" />
									</p>
									<div
										style="float:left;height:auto;width:100%;border:0px solid red;position:relative;padding-bottom:20px;">
										<p style="width:51%;float:left;border:0px solid red;height:auto;">
										<div style="width:50%;height:auto;float:left;">
											<div id="single_price">
												<label>&nbsp;Menu price&nbsp;<span style="color:red;">*</span></label>
												<input class="text-input medium-input validate[required]" type="text"
													id="price" name="price"
													value="<?php echo $fetch_menu['menu_price']?>" />
											</div>
											<p style="width:50%;float:left;">
												<label>&nbsp;Status&nbsp;<span style="color:red;">*</span></label>
												<input class="validate[required]" type="radio" id="status" name="status"
													value="Y" <?php if(isset($_GET['menu_id']) &&
													$fetch_menu['status']=="Y" ) {echo "checked='checked'" ;}?>/>Active
												<input class="validate[required]" type="radio" id="status" name="status"
													value="N" <?php if(isset($_GET['menu_id']) &&
													$fetch_menu['status']=="N" ) {echo "checked='checked'"
													;}?>/>Inactive
											</p>
											<p style="width:50%;float:left;">
												<label>&nbsp;Add Home&nbsp;<span style="color:red;">*</span></label>
												<input class="validate[required]" type="radio" id="add_home"
													name="add_home" value="Y" <?php if(isset($_GET['menu_id']) &&
													$fetch_menu['add_home']=="Y" ) {echo "checked='checked'" ;}?>/>YES
												<input class="validate[required]" type="radio" id="add_home1"
													name="add_home" value="N" <?php if(isset($_GET['menu_id']) &&
													$fetch_menu['add_home']=="N" ) {echo "checked='checked'" ;}?>/>NO
											</p>
											<div style="clear:both"></div>
										</div>
										</p>
										<p style="float:left;width:100%;">
											<label>&nbsp;Menu title&nbsp;<span style="color:red;">*</span><label>
													<div style="float:left;">
														<input class="text-input medium-input validate[required]"
															type="text" id="menu_title" name="menu_name" maxlength="255"
															value="<?php echo $fetch_menu['menu_title']?>"
															style="width:250px !important;" />
													</div>
										</p>
									</div>
									<!-- </p> -->
									<p style="padding-top:14px;border:0px solid red;float:left;width:100%;">
										<label>&nbsp;Menu image&nbsp;<span style="color:red;">*</span></label>
										<input class="text-input medium-input file1 validate[required]" type="file"
											id="file1" name="img" value="<?php echo $fetch_menu['menu_image']?>"
											onchange="chk_valid_img(this)" />
									<div style="width:65px;height: 59px;margin-top: 109px;margin-left: 521px;">
										<img src="menu_img/<?php echo $fetch_menu['menu_image'];?>"
											style="margin-top: -48px;" width="100%" height="100%">
									</div>
									</p>
									<p style="padding-top:10px;border:0px solid red;float:left;width:100%;">
										<label>
											&nbsp;Menu description&nbsp;<span style="color:red;">*</span>
										</label>
									<div style="float:left">
										<textarea style="width: 250px ! important;"
											class="text-input small-input validate[required]" id="desp" name="desp"
											style="width:170px !important;" />
										<?php echo $fetch_menu['menu_description']?>
										</textarea>
									</div>
									</p>
									<p style="width:100%;float:left;">
										<input class="button" type="submit" value="Save" id="insert" name="insert" />
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