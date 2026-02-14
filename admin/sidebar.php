<?php 
	$url=basename($_SERVER['PHP_SELF']); 
?>
<div class="sidebar-header">
	<img src="../admin/images/noImage.jpg" alt="Profile">
	<h2 style="display: flex; justify-content: center; margin-top: -50px">
		<span style="background: linear-gradient(135deg, #184e5ea2, #1edf7598); color: #fff; padding: 6px 15px; margin-left: 70px;
     		border-radius: 25px; box-shadow: 0 4px 10px rgba(24, 24, 24, 0.2); font-size: 12px; font-weight: 600;
      		letter-spacing: 1px;">Admin
		</span>
	</h2>
	<span style="font-weight: 500; color: #c0c0c0; margin-left: 70px;">
		<?php echo $_SESSION['adminname']; ?>
	</span>
</div>
<br><br>

<ul id="main-nav">
	<li>
		<a href="dashboard.php" class="nav-top-item no-submenu <?php echo $url=='dashboard.php'?'current':'';?>">
			<div>Dashboard</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
	</li>
	<li>
		<a href="#"
			class="nav-top-item <?php echo $url=='add_pages.php' || $url=='list_pages.php' || $url=='edit_pages.php' ?'current':''; ?>">
			<div>Pages</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
		<ul>
			<li><a href="add_pages.php" class="<?php echo $url=='add_pages.php'?'current':'';?>">Add pages</a></li>
			<li><a href="list_pages.php" class="<?php echo $url=='list_pages.php'?'current':'';?>">List pages</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#"
			class="nav-top-item <?php echo $url=='add_categories.php' || $url=='list_categories.php' || $url=='edit_categories.php' || $url=='add_sub_categories.php' || $url=='list_sub_categories.php' || $url=='edit_sub_categories.php' ?'current':''; ?>"
			id="no_padding">
			<div>Categories</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
		<ul>
			<li><a href="add_categories.php" class="<?php echo $url=='add_categories.php'?'current':'';?>">Add
					categories</a></li>
			<li><a href="list_categories.php" class="<?php echo $url=='list_categories.php'?'current':'';?>">List
					categories</a></li>
		</ul>
	</li>
	<li>
		<a href="#"
			class="nav-top-item <?php echo $url=='add_menu.php' || $url=='list_menu.php' || $url=='edit_menu.php' ?'current':''; ?>">
			<div>Menu</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
		<ul>
			<li><a href="add_menu.php" class="<?php echo $url=='add_menu.php'?'current':'';?>">Add menu</a></li>
			<li><a href="list_menu.php" class="<?php echo $url=='list_menu.php'?'current':'';?>">List menu</a></li>
		</ul>
	</li>
	<li>
		<a href="#"
			class="nav-top-item <?php echo $url=='add_galleries.php' || $url=='list_gallery.php' || $url=='edit_galleries.php' || $url=='edit_gallery.php' 
				|| $url=='add_gallery_photo.php' || $url=='list_gallery_photo.php' || $url=='add_banner.php' ?'current':''; ?>">
			<div>Gallery</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
		<ul>
			<li><a href="add_gallery_photo.php" class="<?php echo $url=='add_gallery_photo.php'?'current':'';?>">Add
					Photo</a></li>
			<li><a href="add_banner.php" class="<?php echo $url=='add_banner.php'?'current':'';?>">Add
					Banner Photos</a></li>
			<li><a href="list_gallery_photo.php" class="<?php echo $url=='list_gallery_photo.php'?'current':'';?>">List
					Photos</a></li>
		</ul>
	</li>
	<li>
		<a href="#"
			class="nav-top-item no-submenu <?php echo $url=='order.php' || $url=='order_report.php' || $url=='comparative_sale.php'|| $url=='menu_details.php'?'current':'';?>">
			<div>Order</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
		<ul>
			<li><a href="order.php"
					class="<?php echo $url=='order.php' || $url=='menu_details.php'?'current':'';?>">List Orders</a>
			</li>
			<li><a href="order_report.php"
					class="<?php echo $url=='order_report.php' || $url=='comparative_sale.php'?'current':'';?>">Report</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="cont_about_us.php"
			class="nav-top-item no-submenu <?php echo $url=='cont_about_us.php'?'current':'';?>">
			<div>About Us</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
	</li>
	<li>
		<a href="#"
			class="nav-top-item <?php echo $url=='user_details.php' || $url=='notification.php' ?'current':''; ?>">
			<div>Users</div>
			<div style="float:left;margin-top:-22px;"></div>
		</a>
		<ul>
			<li><a href="user_details.php" class="<?php echo $url=='user_details.php'?'current':'';?>">Users Details</a></li>
			<li><a href="logout.php" class="<?php echo $url=='logout.php'?'current':'';?>">Logout</a></li>
		</ul>
	</li>
</ul>

<style>
	#sidebar {
		width: 230px;
		background: #060e30ff;
		color: #fff;
		min-height: 100vh;
		display: flex;
		flex-direction: column;
		justify-content: space-between;
		position: fixed;
		top: 0;
		left: 0;
		padding-top: 5px;
		z-index: 1000;
	}

	.sidebar-header {
		text-align: center;
		border-bottom: 1px solid rgba(212, 212, 212, 0.64);
		margin-bottom: 10px;
		padding-bottom: 20px;
	}

	.sidebar-header img {
		width: 60px;
		height: 60px;
		border-radius: 50%;
		margin: 10px 0px 0px -140px;
	}

	.sidebar-header h2 {
		font-size: 16px;
		margin: 0;
		color: #f1f1f1;
	}

	#main-nav {
		list-style: none;
		margin: 0;
		padding: 0;
		flex-grow: 1;
	}

	#main-nav li {
		background: transparent;
	}

	#main-nav li a {
		display: block;
		padding: 12px 20px;
		color: #cfcfcf;
		text-decoration: none;
		transition: all 0.3s ease;
	}

	#main-nav li a:hover {
		margin-left: 13px;
		background: #09102be8;
		color: #fff;
		border-radius: 5px 0 0 5px;
	}

	#main-nav li a.current {
		margin-left: 10px;
		border-radius: 5px 0 0 5px;
		background: #09102be8;
		color: #000;
	}

	#main-nav ul {
		list-style: none;
		padding: 0;
		margin: 0;
		display: none;
	}

	#main-nav li:hover>ul,
	#main-nav li.active>ul {
		display: block;
	}

	#main-nav ul li a {
		padding: 10px 35px;
		font-size: 13px;
		color: #b8b8b8;
	}

	#main-nav ul li a:hover {
		color: #fff;
	}

	#main-nav ul li a.current {
		background: transparent;
		color: #fff;
	}

	#main-content {
		margin-left: 230px;
		padding: 30px;
		background: #f5f5f5;
		min-height: 100vh;

		display: flex;
		justify-content: center;
		align-items: flex-start;
	}

	@media (max-width: 992px) {
		#sidebar {
			width: 200px;
		}

		#main-content {
			margin-left: 200px;
			padding: 20px;
		}
	}

	@media (max-width: 768px) {
		#sidebar {
			position: relative;
			width: 100%;
			min-height: auto;
		}

		#main-content {
			margin-left: 0;
			padding: 15px;
		}
	}
</style>