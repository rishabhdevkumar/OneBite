<?php
	include("config.php");
	if(isset($_GET['eid']))
	{
    	$select_page="SELECT * FROM `pages` WHERE id='".$_GET['eid']."'";
    	$run_page = mysqli_query($connect,$select_page);
    	$exe_find_cat = mysqli_fetch_array($run_page);

    	if(isset($_POST['add']))
		{
			$page_title=$_POST['name'];
			$update_page = "UPDATE `pages` SET page_title='".$page_title."' WHERE id='".$_GET['eid']."'";
			$run_update = mysqli_query($connect,$update_page);
			if($run_update)
			{
				header("location:list_pages.php");
			}
			else
			{
				echo'<script>alert("ERROR")</script>';
			}	
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Edit pages || Dosa Restaurant</title>

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
					<h3>Edit Pages</h3>
					<ul class="content-box-tabs">
						<li><a href="add_pages.php">Add Pages</a></li>
						<li><a href="list_pages.php">Page List</a></li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="content-box-content">
					<div class="tab-content">
						<form action="" id="dashboard" method="post">
							<fieldset>
								<p>
									<label>&nbsp;Page Title&nbsp;<span style="color:red;">*</span></label>
									<input class="text-input medium-input validate[required]" type="text" id="name"
										name="name" value="<?php echo $exe_find_cat['page_title'] ?>" maxlength="255" />
								</p>
								<p>
									<input class="button" type="submit" value="Update" id="add" name="add" />
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
body 
{
	overflow: hidden;
}
.content-box {
  width: 500px;
  background: #ffffff;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}
.content-box-header {
  background: #2c3e50;
  color: #fff;
  padding: 15px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.content-box-header h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
}
.content-box-tabs {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  gap: 30px;
}
.content-box-tabs li a {
  text-decoration: none;
  font-size: 14px;
  padding: 6px 12px;
  border-radius: 4px;
  background: #1abc9c;
}

.content-box-tabs li a:hover {
  background: #fdfdfdff;
}
.content-box-content {
  padding: 20px;
}
#dashboard fieldset {
  border: none;
  padding: 0;
  margin: 0;
}
#dashboard p {
  margin-bottom: 18px;
}
#dashboard label {
  display: block;
  font-weight: 600;
  margin-bottom: 6px;
  font-size: 14px;
}
#dashboard input.text-input {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 14px;
  transition: border 0.3s;
}

#dashboard input.text-input:focus {
  border-color: #1abc9c;
  outline: none;
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

.clear {
  clear: both;
}
@media (max-width: 600px) {
  #main-content {
    margin: 20px auto;
    padding: 10px;
  }

  .content-box-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  .content-box-tabs {
    flex-wrap: wrap;
 }
}}

</style>