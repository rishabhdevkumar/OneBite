<?php
	include("config.php");
	$check_page = "SELECT * FROM `gallery_photo` WHERE 1";
	$run_check = mysqli_query($connect,$check_page);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>BURGATORY ADMIN List pages</title>

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.configuration.js"></script>

	<script type="text/javascript">
		function change_status(temp, temp1) {
			$.post('change_status2.php?id=' + temp + '&status=' + temp1, function (data) {
				if (data) {
					$('#did_' + temp).html(data);
				}
			});
		}

	</script>

</head>

<body style="background: #f8f8f8ff">
	<div id="body-wrapper" style="background: #f8f8f8ff">
		<div id="sidebar">
			<div id="sidebar-wrapper">
				<?php require 'sidebar.php';?>
			</div>
		</div>
		<div id="main-content">
			<div class="content-box" style="box-shadow: 0px 0 12px 5px rgba(128, 122, 122, 0.29);width: 100%;">
				<div class="content-box-header">
					<h3>Photo list</h3>
					<ul class="content-box-tabs">
						<li><a href="add_pages.php">Add pages</a></li>
						<li><a href="list_pages.php" class="default-tab">Photo list</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" name="dashboard" method="post">
							<table>
								<thead>
									<tr>
										<th>Sl.No</th>
										<th>image</th>
										<th>status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 1;
										while($fetch_page=mysqli_fetch_array($run_check))
										{		
									?>
									<tr>
										<td><?php echo $i?></td>
										<td>
											<img src="../admin/menu_img/<?php echo $fetch_page['gallery_image']?>"
											style="height: 30px;width:40px">
										</td>
										<td style=" vertical-align: top;">
											<div id="did_<?=$fetch_page['id']?>">
												<?php if($fetch_page['status']=='Y')
													 { 
                                                ?>
												<a href="javascript:void(0)" style="color:green;"
													Title="Click here to deactivate"><img src="images/act.png" alt="" style="width: 20px; height: 20px;"
													onclick="change_status('<?php echo $fetch_page['id'] ?>', 'yes' )" >
												</a>
												<?php 
													}
													 else 
												    { 
												?>
												<a href="javascript:void(0)" style="color:red;"
													Title="Click here to activate"><img src="images/deact.png"
													width="20" height="20" border="0" alt=""
													onclick="change_status('<?php echo $fetch_page['id'] ?>', 'no' )">
												</a>
												<?php
													 }	 
												?>
											</div>
										</td>
										<td>
											<a href="edit_gallery.php?eid=<?php=$fetch_page['id']?>" title="Edit"><img
													src="images/pencil.png" alt="Edit" style="width: 20px; height: 20px;" /></a>&nbsp;
											<a href="delete.php?gall_id=<?php echo $fetch_page['id']?>"
												onclick="return confirm('Are you sure you want to delete this page?')"
												title="Delete"><img src="images/cross.png" alt="Delete" style="width: 20px; height: 20px;" /></a> &nbsp;
										</td>
									</tr>
									<?php
									$i++;
										}
									?>
								</tbody>
							</table>
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
table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  font-size: 14px;
  background: #fff;
  overflow: hidden;
}

thead {
  background: #1d4c7cff; 
  color: #fff;
  text-align: left;
}

thead th {
  padding: 12px 15px;
  font-size: 13px;
  text-align: center;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

tbody td {
  padding: 10px 15px;
  vertical-align: middle;
  text-align: center;
  color: #333;
}

td a[title="Edit"] img {
  filter: hue-rotate(200deg);
}

td a[title="Delete"] img {
  filter: hue-rotate(0deg); 
}

</style>