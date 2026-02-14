<?php
	include("config.php");
	$cat_id=$_GET['cat_id'];
	$Select_cat = "SELECT * FROM `categories` WHERE id='".$cat_id."'";
	$run_select = mysqli_query($connect,$Select_cat);
	$fetch_cat = mysqli_fetch_array($run_select);
   
	if(isset($_POST['add']))
	{
		$name = $_POST['name'];
		$page_id = $_POST['page'];
		$status = $_POST['status'];
		$add_home = $_POST['add_home'];
		$desp = $_POST['desp'];
		$image = ($_FILES['img']['name']);
		$type=explode('/',$_FILES['img']['type']);
		$types = array('jpeg','jpg','png','gif');
	  	if(in_array($type[1],$types))
	  	{
		  $filename = basename($_FILES['img']['name']);
		  $extension = pathinfo($filename,PATHINFO_EXTENSION);
		  $new = md5($filename).'_'.rand(0000,999).'.'.$extension;
		  $IMAGE = $new;
		  $update_category = "UPDATE `categories` SET page_id='".$page_id."',name='".$name."',status='".$status."',
		  add_home='".$add_home."',description='".$desp."',banner_image='". $IMAGE."' WHERE id='".$cat_id."'";
		  $run_update = mysqli_query($connect,$update_category);
		   move_uploaded_file(($_FILES['img']['tmp_name']),'menu_img/'.$IMAGE);
		   if($run_update)
			{
				header("location:list_categories.php?cat_id=".$page_id);	
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
		<title>Edit catgories || Burgatory</title>	  
		
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
				function checkname(e)
				{
					if(document.getElementById("name").value.length==0 && e.which==32)
					{
						return false;
					}
				}
			function chk_valid_img(input)
			{
				const ext = document.getElementById("img").value.match(/\.([^\.]+)$/)[1];
				switch(ext)
				{	
					case 'jpg':
					case 'jpeg':
					case 'bmp':
					case 'png':
					case 'JPG':
					case 'JPEG':
					case 'BMP':
					case 'PNG':
					//$("#preview1").html('<img src="images/loader.gif" alt="Uploading...."/>');
					if (input.files && input.files[0]) {
					const reader = new FileReader();
					reader.onload = function(e) {

					document.getElementById('blah').style.display="block";
					/*document.getElementById('ed_img').style.display="none";
					document.getElementById('preview1').style.display="none";
					document.getElementById('delete_link').style.display="none";*/
					$('#blah').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
					}

					return true;
					break;
					default:
					showError('Invalid file format');
					document.getElementById("img").value='';
					return false;
				}
			}
		</script>
		<script>
			function toogle_table()
			{
			 if(document.getElementById("size_chk").checked==true)
				{
			  		document.getElementById("mk_table").style.display="block";
				}
		 		else
				{
			  		document.getElementById("mk_table").style.display="none";
				}
			}

			$(document).ready(function() {
		
        	$('#new_ele_btn').click(function(event){
			const i=document.getElementById("hid_total_ele").value;	
			<?php
				$ds = '';
				foreach($exe_find_language as $lang_text_arr) { 
											
				$ds=$ds.'<td><input type="text" name="extra_'.$lang_text_arr['id'].'[]" class="text-input medium-input validate[required]" 
				id="lang_name_XID'.$lang_text_arr['id'].'" style="width: 200px !important;"> Description: <textarea class="text-input small-input"  id="extdes_'.$lang_text_arr['id'].'" name="extdes_'.$lang_text_arr['id'].'[]" 
				style="min-width:200px !important;"/><?php echo isset($_POST["extdes_'.$lang_text_arr['id'].'"])?$_POST["extdes_'.$lang_text_arr['id'].'"]:"";?></textarea></td>';
				}
			?>

				const newRow ='<tr>';
				newRow=newRow+'<td><input type="text" name="slno[]" class="text-input medium-input" style="width: 60px !important;" id="sl_no_1" onkeypress="return isNumber(event)"></td>';
				newRow=newRow+'<?php echo $ds; ?>';
				newRow=newRow+'<td><input type="text" name="price_new[]" class="text-input medium-input" style="width: 60px !important;" id="lang_price_1" onkeypress="return isNumber(event)"></td>';
				newRow=newRow+'<td><input type="checkbox" id="special_XID" value="1" name="special_XID"></td>';
				newRow=newRow+'<td><img src="images/delete_row.png" width="20" height="20" border="0"  alt="add" name="add_lang" class="RemoveRow" style="cursor:pointer"></td>';
				newRow=newRow+'</tr>';	
				newRow=newRow.replace(/XID/g,i);
				i++;								
				$('#tbl').append(newRow);
        		document.getElementById("hid_total_ele").value=i;
		    	});
        	});
		 
		 	$('.RemoveRow').live('click', function() {
			
				$(this).closest('tr').remove();
				document.getElementById("hid_total_ele").value=Number(document.getElementById("hid_total_ele").value)-1;
				if(document.getElementById("hid_total_ele").value==1)
			 	{
					document.getElementById("size_chk").checked=false;
					document.getElementById("mk_table").style.display="none";
					document.getElementById("hid_total_ele").value=2;
			 	}
			});
			function valid_chk_size1()
			{
				if(document.getElementById("size_chk").checked==true)
					{		  
					const bound=document.getElementById("hid_total_ele").value;
					const flag = true;
					const myArray =new Array(); 
					<?php
						foreach($exe_find_language as $lang_text_arr) { ?>
						for(var i=1;i<bound;i++)
						{
							const searchTerm=document.getElementById("lang_name_"+i+"<?php echo $lang_text_arr['id']; ?>").value;
							if(myArray.indexOf(searchTerm)==-1)
							{
								myArray.push(searchTerm);					 
							}
							else
							{					 
							const flag = false;
							break;
							}
						}
						<?php 
							}  
						?>
					if(flag ==false)
					{
						showError('Same extra already exists');
						return false;
					}
				}
				else
				{
					return true;
				}
			}

			function isNumber(evt) {
				evt = (evt) ? evt : window.event;
				const charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 45 || charCode > 57)) {
				return false;
				}
				return true;
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
						<h3>Edit Categories</h3>
							<ul class="content-box-tabs">
								<li><a href="add_categories.php">Add Category</a></li> 
								<li><a href="list_categories.php" >Category List</a></li>
							</ul>						
						<div class="clear"></div>
					</div>
					<div class="content-box-content">
						<div class="tab-content">
							<form action="" id="dashboard" method="post" enctype="multipart/form-data">
								<fieldset> 	
									<div style="background-color:#e7e7e7;border:0px solid red;padding:8px;">
										<p style="float:left;width:50%;">
											<label>&nbsp;Page&nbsp;<span style="color:red;">*</span></label>
											<SELECT NAME="page" id="page" class="medium-input validate[required]">		
												<option value="">Select</option>
												<?php
													$page = "SELECT * FROM `pages` WHERE 1";
													$run_page = mysqli_query($connect,$page);	
													while($fetch_page = mysqli_fetch_array($run_page))
													{
												?>
												<option value="<?php echo $fetch_page['id']?>" <?php if(isset($_GET['cat_id']) && 
													$fetch_cat['page_id']==$fetch_page['id']) {echo "selected='selected'";}?>><?php echo $fetch_page['page_title']?>
												</option>
												<?php
													}
												?>
											</SELECT>
										</p>
										<p style="float:left;width:50%;">
											<label>&nbsp;Status&nbsp;<span style="color:red;">*</span></label>
											<input class="validate[required]" type="radio" id="status" name="status" value="Y" <?php if(isset($_GET['cat_id']) && $fetch_cat['status'] =="Y") {echo "checked='checked'";}?>/>Active
											<input class="validate[required]" type="radio" id="status" name="status" value="N" <?php if(isset($_GET['cat_id']) && $fetch_cat['status'] =="N") {echo "checked='checked'";}?>/>Inactive
										</p>
										<p style="width:50%;float:left;">
											<label>&nbsp;Add Home&nbsp;<span style="color:red;">*</span></label>
											<input class="validate[required]" type="radio" id="add_home" name="add_home" value="Y" <?php if(isset($_GET['cat_id']) && $fetch_cat['add_home'] =="Y") {echo "checked='checked'";}?>/>Yes
											<input class="validate[required]" type="radio" id="add_home" name="add_home" value="N" <?php if(isset($_GET['cat_id']) && $fetch_cat['add_home'] =="N") {echo "checked='checked'";}?> />No
										</p>
										<p style="padding-top:14px;border:0px solid red;float:left;width:100%;position:relative;">									
											<label>&nbsp;Banner image&nbsp;</label>
											<input class="text-input medium-input file1" type="file" id="img" name="img" value="<?php echo $fetch_cat['banner_image']?>" onchange="chk_valid_img(this)" />	
											<div style="width:65px;height: 59px;margin-top: 177px;margin-left: 521px;">
												<img src="menu_img/<?php echo $fetch_cat['banner_image'];?>" style="margin-top: -48px;" width="100%" height="100%">
											</div>		
										</p>
									
										<p style="float:left;width:100%;">
											<img id="blah" src="#" alt="Preview" width="400" height="150" style="display:none;"/>
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
												<input class=" text-input medium-input <?=$validate?>" type="text" id="name" name="name" value="<?php echo $fetch_cat['name']?>" onkeypress="return checkname(event);" maxlength="255" style="width:170px !important;" placeholder="Name"/>
											</div>
										</div>
									</p>
									 <p style="padding-top:10px;border:0px solid red;float:left;width:100%;">									
										<label >&nbsp;Description&nbsp;</label>
										<div style="float:left;border:0px solid red;margin-top:-10px;">
											<div  style="float:left;margin-left:-4px;">
												&nbsp;&nbsp;
											</div>
											<div style="float:left">
												<textarea class="text-input"  id="desp" name="desp" maxlength="255" style="width:170px !important;" placeholder="Description"/><?php echo $fetch_cat['description']?></textarea>
											</div>
										</div>	
									</p>
									<p style="float:left;width:100%;">
										<label>&nbsp;Notes&nbsp;</label>
										<div style="float:left;border:0px solid red;margin-top:-10px;">
											<div style="float:left;margin-left:-4px;">
												&nbsp;&nbsp;
											</div>
											<div style="float:left;">
												<input class="text-input" type="text" id="notes" name="notes" value="<?php echo $fetch_cat['category_notes']?>"  maxlength="255" style="width:170px !important;" placeholder="Notes"/>
											</div>
										</div>				
									</p>
									<p style="float:left;width:100%;margin-top: 11px;margin-left: 5px;">
										<button class="button" type="submit" value="Update" id="add" name="add">Update</button>
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
  background: #ffffff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  overflow: hidden;
}
.content-box-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #2c3e50; 
  padding: 10px 15px;
  border-radius: 6px 6px 0 0;
  color: #fff;
}
.content-box-header h3 {
  margin: 0;
  font-size: 16px;
  font-weight: 600;
}
.content-box-tabs {
  list-style: none;
  display: flex;
  gap: 10px;
  margin: 0;
  padding: 0;
}
.content-box-tabs li a {
  display: inline-block;
  background: #ffffff;
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 14px;
  text-decoration: none;
  transition: background 0.3s, color 0.3s;
}
.content-box-tabs li a:hover {
  background: #ffffffd3;
  color: #fff;
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
}
.button:hover {
  background: #1abc9c;
  text-decoration: none;
}

</style>