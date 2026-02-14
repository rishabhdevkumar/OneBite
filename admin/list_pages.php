<?php
	include("config.php");
	$check_page = "SELECT * FROM `pages`";
	$run_check = mysqli_query($connect, $check_page);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Burgatory Admin List pages</title>

	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	<link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/jquery.configuration.js"></script>

	<script type="text/javascript">
		function change_status(temp, temp1) {

			$.post('change_status.php?id=' + temp + '&status=' + temp1 + '&table=1', function (data) {
				if (data) {

					$('#did_' + temp).html(data);
				}
			});
		}

		function chngnslno(temp, temp1) {
			$.post('change_serialno.php?id=' + temp + '&sl_number=' + temp1 + '&table=1', function (data) {
				if (data) {
					var array = data.split("@@");
					var len = array.length;
					for (var i = 0; i < len; i++) {
						var newarr = array[i].split("=");
						document.getElementById(newarr[0]).value = newarr[1];
					}
				}
			});
		}

		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 47 || charCode > 57)) {
				return false;
			}
			return true;
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
					<h3>Page list</h3>
					<ul class="content-box-tabs">
						<li><a href="add_pages.php">Add pages</a></li>
						<li><a href="list_pages.php" class="default-tab">Page list</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" name="dashboard" method="post">
							<table>
								<thead>
									<tr>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										while($fetch_page = mysqli_fetch_array($run_check)) 
											{	
									?>
									<tr>
										<td style="vertical-align: top;">
											<?php echo $fetch_page['page_title']; ?>
										</td>
										<td style="vertical-align: top;">
											<a href="edit_pages.php?eid=<?= $fetch_page['id'] ?>" title="Edit">
												<img src="images/pencil.png" alt="Edit" />
											</a>&nbsp;
											<a href="delete.php?page_id=<?= $fetch_page['id'] ?>"
												onclick="return confirm('Are you sure you want to delete this page title?')"
												title="Delete">
												<img src="images/cross.png" alt="Delete" />
											</a>&nbsp;
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
		overflow: hidden;
	}

	.content-box {
		background: #fff;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
		padding: 10px;
		color: #000;
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