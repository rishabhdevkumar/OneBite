<?php
	include("config.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>BURGATORY ADMIN List Catgories</title>

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.configuration.js"></script>

	<script type="text/javascript">

		function change_status(temp, temp1) {
			$.post('change_status.php?id=' + temp + '&status=' + temp1, function (data) {
				if (data) {

					$('#did_' + temp).html(data);
				}
			});
		}

		function chk_cat(temp) {
			window.location = "list_categories.php?cat_id=" + temp;
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
					<h3>Category list</h3>
					<ul class="content-box-tabs">
						<li><a href="add_categories.php">Add category</a></li>
						<li><a href="list_categories.php" class="default-tab">Category list</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" name="dashboard" method="post">
							<p>
								<label>&nbsp;Please Select a Page&nbsp;</label>
								<SELECT NAME="category" id="category" class="medium-input validate[required]"
									onchange="chk_cat(this.value)">
									<option value="">Select</option>
									<?php
										$page = "SELECT * FROM `pages` WHERE 1";
										$run_page = mysqli_query($connect,$page);	
										while($fetch_page = mysqli_fetch_array($run_page))
										 {
									?>
									<option value="<?php echo $fetch_page['id']?>" name="dd" <?php
									  if(isset($_GET['cat_id']) && $_GET['cat_id']==$fetch_page['id'])
										{echo "selected='selected'" ;}?> >
										<?php echo $fetch_page['page_title']?>
									</option>
									<?php
										}
									?>
								</SELECT>
							</p>
							<table>
								<thead>
									<tr>
										<th>Name</th>
										<th>Status</th>
										<th>image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$check_page = "SELECT * FROM `categories` WHERE page_id='".$_GET['cat_id']."'";
										$run_check = mysqli_query($connect,$check_page);
										while($fetch = mysqli_fetch_array($run_check))
										{
									?>
									<tr>
										<td style=" vertical-align: top;">
											<?php echo $fetch['name']?>
										</td>
										<td style="vertical-align: top;">
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
										<td>
											<img src="../admin/menu_img/<?php echo $fetch['banner_image']?>" style=" height: 30px;width:40px">
										</td>
										<td style=" vertical-align: top;">
											<a href="edit_categories.php?cat_id=<?php echo $fetch['id']?>"
												title="Edit"><img src="images/pencil.png" alt="Edit" />
											</a>&nbsp;
											<a href="delete.php?cat_id=<?php echo $fetch['id']?> &page_id1=<?php echo $fetch['page_id']?>"
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
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f4f6f9;
}

.content-box {
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  padding: 20px;
  color: #333;
  background: #fff;
  max-width: 100%;
  margin: 20px auto;
  overflow-x: auto; 
}

.content-box-header {
  padding: 8px 0 15px 0;
  border-radius: 8px 8px 0 0;
  border: none;
}

.content-box-header h3 {
  margin: 0;
  font-size: 20px;
  color: #000;
  font-weight: bold;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
  font-size: 14px;
  background: #fff;
}

thead {
  background: #2c3e50;
  color: #fff;
}

thead th {
  padding: 10px;
  text-align: left;
  font-weight: bold;
}

tbody tr:nth-child(even) {
  background: #f8f8f8;
}

tbody td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  vertical-align: middle;
}

tbody td img {
  vertical-align: middle;
}

td a img {
  width: 20px;
  height: 20px;
  transition: transform 0.2s;
}

td a:hover img {
  transform: scale(1.1);
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

  table {
    font-size: 13px;
  }

  thead {
    display: none; 
  }

  tbody tr {
    display: block;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background: #fff;
    padding: 10px;
  }

  tbody td {
    display: flex;
    justify-content: space-between;
    padding: 8px;
    border: none;
  }

  tbody td:before {
    content: attr(data-label);
    font-weight: bold;
    flex: 1;
    text-transform: capitalize;
  }
}

</style>