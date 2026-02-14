<?php
	include("config.php");
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>List menu || REDCHILLIES</title>
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

		function change_status(temp, temp1) {

			$.post('change_status1.php?id=' + temp + '&status=' + temp1, function (data) {
				if (data) {

					$('#did_' + temp).html(data);
				}
			});
		}

		function chk_cat(temp) {
			window.location = "list_menu.php?cat_id=" + temp;
		}
		function chk_cat1(temp2, temp3) {
			window.location = "list_menu.php?cat_id1=" + temp2 + "&cat_id=" + temp3;
		}

	</script>
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
					<h3>Menu lists</h3>
					<ul class="content-box-tabs">
						<li><a href="add_menu.php">Add menu</a></li>
						<li><a href="list_menu.php" class="default-tab">List menu</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content" style="position:relative">
						<form action="" id="dashboard" name="dashboard" method="post">
							<p>
								<label>&nbsp;Please Select a page&nbsp;<span style="color:red;">*</span></label>
								<SELECT NAME="page" id="page" class="medium-input validate[required]"
									onchange="chk_cat(this.value)">
									<option value="">Select</option>
									<?php
										$page = "SELECT * FROM `pages` WHERE 1";
										$run_page = mysqli_query($connect,$page);	
										while($fetch_page = mysqli_fetch_array($run_page))
										{
									?>
									<option value="<?php echo $fetch_page['id']?>" <?php if(isset($_GET['cat_id']) &&
										$_GET['cat_id']==$fetch_page['id']) {echo "selected='selected'" ;}?> >
										<?php echo $fetch_page['page_title']?>
									</option>
									<?php
										}
									?>
								</SELECT>
							</p>
							<p>
								<label>&nbsp;Please Select a
									Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</label>
								<div id="cat_drop">
									<SELECT NAME="category" id="category" class="medium-input validate[required]"
										onchange="chk_cat1(this.value,<?php echo $_GET['cat_id']?>)">
										<option value="">Select</option>
										<?php
											$check_page = "SELECT * FROM `categories` WHERE page_id ='".$_GET['cat_id']."'";
											$run_check = mysqli_query($connect,$check_page);
								 			while($fetch = mysqli_fetch_array($run_check))
									 		{
									 	?>
										<option value="<?php echo $fetch['id']?>" <?php if(isset($_GET['cat_id1']) &&
											$_GET['cat_id1']==$fetch['id']) {echo "selected='selected'" ;}?>>
											<?php echo $fetch['name']?>
										</option>
										<?php
											}
										?>
									</SELECT>
								</div>
							</p>
							<table>
								<thead>
									<tr>
										<th>Menu title</th>
										<th>Menu price</th>
										<th>Menu image</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$check_page = "SELECT * FROM `menu` WHERE page_id='".$_GET['cat_id']."' AND category_id='".$_GET['cat_id1']."'";
										$run_check = mysqli_query($connect,$check_page);
										 while($fetch = mysqli_fetch_array($run_check))
										 {
									?>
									<tr>
										<td style=" vertical-align: top;">
											<?php echo $fetch['menu_title']?>
										</td>
										<td style=" vertical-align: top;">
											<?php echo $fetch['menu_price']?>
										</td>
										<td>
											<img src="../admin/menu_img/<?php echo $fetch['menu_image']?>"
												style="height: 30px;width:50px">
										</td>
										<td style=" vertical-align: top;">
											<div id="did_<?=$fetch['id']?>">
												<?php if($fetch['status']=='Y') 
													{ 
                                                ?>
												<a href="javascript:void(0)" style="color:green;"
													Title="Click here to deactivate"><img src="images/act.png"
													width="24" height="24" border="0" alt=""
													onclick="change_status('<?php echo $fetch['id'] ?>', 'yes' )">
												</a>
												<?php 
													}
													else 
												    { 
												?>
												<a href="javascript:void(0)" style="color:red;"
													Title="Click here to activate"><img src="images/deact.png"
													width="24" height="24" border="0" alt=""
													onclick="change_status('<?php echo $fetch['id'] ?>', 'no' )">
												</a>
												<?php
													}	 
												?>
											</div>
										</td>
										<td style=" vertical-align: top;">
											<a href="edit_menu.php?page_id=<?php echo $fetch['page_id']?> & cat_id=<?php echo $fetch['category_id']?> & menu_id=<?php echo $fetch['id']?>"
												title="Edit"><img src="images/pencil.png" alt="Edit" />
											</a>&nbsp;
											<a href="delete.php?menu_id3=<?php echo $fetch['id']?>&page_id3=<?php echo $fetch['page_id']?>&cat_id3=<?php echo $fetch['category_id']?>"
												onclick="return confirm('Are you sure you want to delete this page?')"
												title="Delete"><img src="images/cross.png" alt="Delete" />
											</a> &nbsp;
										</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
						</form>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<style>
	body {
  overflow: hidden;    
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

table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  font-size: 14px;
  background-color: #fff;
  overflow: hidden;
}

thead {
  background: #4798f0ff;
  color: #fff;
  text-align: left;
}

thead th {
  padding: 12px 15px;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 13px;
  letter-spacing: 0.5px;
}

tbody tr {
  border-bottom: 1px solid #ddd;
  transition: background 0.2s ease-in-out;
}

tbody tr:hover {
  background: #f9f9f9; 
}

tbody td {
  color: #333;
}

tbody td img {
  object-fit: cover;
  box-shadow: 0px 1px 3px rgba(0,0,0,0.2);
}

a img {
  cursor: pointer;
  transition: transform 0.2s ease-in-out;
}

a img:hover {
  transform: scale(1.1);
}

td a {
  text-decoration: none;
}

td a[title="Edit"] img {
  filter: hue-rotate(200deg);
}

td a[title="Delete"] img {
  filter: hue-rotate(0deg);
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