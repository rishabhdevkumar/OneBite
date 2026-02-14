<?php 
	$url=basename($_SERVER['PHP_SELF']); 
?>
<!-- <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
<a href="#"><h3 style="color:#ffffff !important;padding-left:17px;padding-top:40px;font-size:12px;" align="center;">Mc Gee's Irish Pub & Restaurant</h3></a>
<br><br><br>
<div id="profile-links">
	<b>Hello, <?php echo strtoupper(strlen($_SESSION['adminname'])>10?substr($_SESSION['adminname'],0,10)."..":$_SESSION['adminname']); ?></b>&nbsp;&nbsp;
	<a href="logout.php" title="Sign Out">Sign Out&nbsp;&nbsp;&nbsp;<img src="images/exit.png" width="12" height="12" border="0" alt="" align="absmiddle"></a>
</div>                -->

<ul id="main-nav">
	<li>
		<a href="dashboard.php" class="nav-top-item no-submenu <?php echo $url=='dashboard.php'?'current':'';?>">
			<div>Dashboard</div>
			<div style="float:left;margin-top:-22px;"></div>     
		</a>
	</li>
	
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='add_pages.php' || $url=='list_pages.php' || $url=='edit_pages.php' ?'current':''; ?>">
			<div>Pages</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>	
		<ul>
			<li><a href="add_pages.php" class="<?php echo $url=='add_pages.php'?'current':'';?>">Add pages</a></li>
			<li><a href="list_pages.php" class="<?php echo $url=='list_pages.php'?'current':'';?>">List pages</a></li>						
		</ul>
	</li>	
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='add_categories.php' || $url=='list_categories.php' || $url=='edit_categories.php' || $url=='add_sub_categories.php' || $url=='list_sub_categories.php' || $url=='edit_sub_categories.php' ?'current':''; ?>" id="no_padding">
			<div>Categories/Sub-categories</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>	
		<ul>
			<li><a href="add_categories.php" class="<?php echo $url=='add_categories.php'?'current':'';?>">Add categories</a></li>
			<li><a href="list_categories.php" class="<?php echo $url=='list_categories.php'?'current':'';?>">List categories</a></li>						
		</ul>
	</li>
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='add_online_menu.php' || $url=='list_online_menu.php' || $url=='edit_online_menu.php' ?'current':''; ?>">
			<div>Order Online</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="add_online_menu.php" class="<?php echo $url=='add_online_menu.php'?'current':'';?>">Add menu</a></li>
			<li><a href="list_online_menu.php" class="<?php echo $url=='list_online_menu.php'?'current':'';?>">List menu</a></li>						
		</ul>
	</li>
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='add_menu.php' || $url=='list_menu.php' || $url=='edit_menu.php' ?'current':''; ?>">
			<div>Menu</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="add_menu.php" class="<?php echo $url=='add_menu.php'?'current':'';?>">Add menu</a></li>
			<li><a href="list_menu.php" class="<?php echo $url=='list_menu.php'?'current':'';?>">List menu</a></li>						
		</ul>
	</li>
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='add_galleries.php' || $url=='list_gallery.php' || $url=='edit_galleries.php' || $url=='edit_gallery.php' || $url=='add_gallery_photo.php' || $url=='list_gallery_photo.php' ?'current':''; ?>">
			<div>Gallery</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="add_galleries.php" class="<?php echo $url=='add_galleries.php'?'current':'';?>">Add Album</a></li>
			<li><a href="list_gallery.php" class="<?php echo $url=='list_gallery.php'?'current':'';?>">List Album</a></li>					
		</ul>
	</li>
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='add_events.php' || $url=='list_events.php' || $url=='edit_events.php' || $url=='add_event_photo.php' || $url=='list_event_photo.php' ?'current':''; ?>">
			<div>Events</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="add_events.php" class="<?php echo $url=='add_events.php'?'current':'';?>">Add Event</a></li>
			<li><a href="list_events.php" class="<?php echo $url=='list_events.php'?'current':'';?>">List Events</a></li>					
		</ul>
	</li>
	<li> 
		<a href="#" class="nav-top-item <?php echo $url=='create_newsletter_template.php' || $url=='list_newsletter_template.php' || $url=='edit_newsletter_template.php' || $url=='newsletter_subscribers.php'  || $url=='send_newsletter.php' ?'current':''; ?>">
			<div>Newsletter MGMT</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="create_newsletter_template.php" class="<?php echo $url=='create_newsletter_template.php'?'current':'';?>">Create New Newsletter</a></li>
			<li><a href="list_newsletter_template.php" class="<?php echo $url=='list_newsletter_template.php'?'current':'';?>">List Newsletter</a></li>
			<li><a href="newsletter_subscribers.php" class="<?php echo $url=='newsletter_subscribers.php'?'current':'';?>">List Newsletter Subscribers</a></li>
			<li><a href="send_newsletter.php" class="<?php echo $url=='send_newsletter.php'?'current':'';?>">Send Newsletter</a></li>
		</ul>
	</li>
	<li>
		<a href="address_list.php" class="nav-top-item no-submenu <?php echo $url=='address_list.php'?'current':'';?>">
			<div>Address List</div>
			<div style="float:left;margin-top:-22px;"></div>     
		</a>
		<!-- <ul>
			<li><a href="order_report.php" class="<?php echo $url=='order_report.php' || $url=='comparative_sale.php'?'current':'';?>">Report</a></li>
		</ul> -->
	</li>
	<li>
		<a href="#" class="nav-top-item no-submenu <?php echo $url=='order.php' || $url=='order_report.php' || $url=='comparative_sale.php'|| $url=='menu_details.php'?'current':'';?>">
			<div>Order</div>
			<div style="float:left;margin-top:-22px;"></div>     
		</a>
		<ul>
			<li><a href="order.php" class="<?php echo $url=='order.php' || $url=='menu_details.php'?'current':'';?>">List Orders</a></li>
			<li><a href="order_report.php" class="<?php echo $url=='order_report.php' || $url=='comparative_sale.php'?'current':'';?>">Report</a></li>
		</ul>
	</li>
	<li>
		<a href="#" class="nav-top-item no-submenu <?php echo $url=='add_pincode.php' || $url=='list_pincode.php' || $url=='edit_pincode.php'?'current':'';?>">
			<div>Pincode</div>
			<div style="float:left;margin-top:-22px;"></div>     
		</a>
		<ul>
			<li><a href="add_pincode.php" class="<?php echo $url=='add_pincode.php' || $url=='add_pincode.php'?'current':'';?>">Add Pincode</a></li>
			<li><a href="list_pincode.php" class="<?php echo $url=='list_pincode.php' || $url=='list_pincode.php'?'current':'';?>">List of Pincode</a></li>
		</ul>
	</li>
	<li>
		<a href="review.php" class="nav-top-item no-submenu <?php echo $url=='review.php'?'current':'';?>">
			<div>Reviews</div>
			<div style="float:left;margin-top:-22px;"></div>     
		</a>
	</li>
	<!-- <li>
		<a href="order.php" class="nav-top-item no-submenu <?php echo $url=='order.php'?'current':'';?>">
			<div>Order</div>
			<div style="float:left;margin-top:-22px;"></div>     
		</a>
	</li> -->
	<!-- <li> 
		<a href="#" class="nav-top-item <?php echo $url=='order.php' || $url=='my_orders.php' || $url=='menu_details.php' ?'current':''; ?>">
			<div>Order</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="order.php" class="<?php echo $url=='order.php'?'current':'';?>">view order</a></li>					
		</ul>
	</li> -->
	<!--<li> 
		<a href="#" class="nav-top-item <?php echo $url=='postcode.php'|| $url=='add_postcode.php' ?'current':''; ?>">
			<div>Delivery area</div>
			<div style="float:left;margin-top:-22px;"></div>    
		</a>
		<ul>
			<li><a href="postcode.php" class="<?php echo $url=='postcode.php'?'current':'';?>">Postcode</a></li>					
			<li><a href="add_postcode.php" class="<?php echo $url=='add_postcode.php' && !isset($_GET['eid'])?'current':'';?>">Add Postcode</a></li>					
		</ul>
	</li>-->
	<li> 
		<?php
		//check and active menu if it is current page
		preg_match('`/cms-home.php(.*)$`', $_SERVER['REQUEST_URI'], $matches999);
		preg_match('`/home_slider_image.php(.*)$`', $_SERVER['REQUEST_URI'], $matches71);
		preg_match('`/add_slider.php(.*)$`', $_SERVER['REQUEST_URI'], $matches72);
		preg_match('`/order_online1.php(.*)$`', $_SERVER['REQUEST_URI'], $matches82);
		preg_match('`/list_slider_image.php(.*)$`', $_SERVER['REQUEST_URI'], $matches73);	
		preg_match('`/latest_events.php(.*)$`', $_SERVER['REQUEST_URI'], $matches74);	
		preg_match('`/order_online2.php(.*)$`', $_SERVER['REQUEST_URI'], $matches75);
		preg_match('`/reservation.php(.*)$`', $_SERVER['REQUEST_URI'], $matches77);
		preg_match('`/group_party.php(.*)$`', $_SERVER['REQUEST_URI'], $matches78);	
		preg_match('`/contact_us.php(.*)$`', $_SERVER['REQUEST_URI'], $matches79);
		preg_match('`/common_content.php(.*)$`', $_SERVER['REQUEST_URI'], $matches80);
		preg_match('`/order_online.php(.*)$`', $_SERVER['REQUEST_URI'], $matches81);
		$current7 = ($matches999 ||$matches71 || $matches72 || $matches73 || $matches74 || $matches75 || $matches76 || $matches77 || $matches78 || $matches79 || $matches80 || $matches81 || $matches82 ) ? ' current' : '';
		$sub_current999 = $matches999 ? 'class="current"' : '';
		$sub_current71 = $matches71 ? 'class="current"' : '';
		$sub_current72 = $matches72 ? 'class="current"' : '';
		$sub_current73 = $matches73 ? 'class="current"' : '';
		$sub_current74 = $matches74 ? 'class="current"' : '';
		$sub_current75 = $matches75 ? 'class="current"' : '';
		$sub_current76 = $matches76 ? 'class="current"' : '';
		$sub_current77 = $matches77 ? 'class="current"' : '';
		$sub_current78 = $matches78 ? 'class="current"' : '';
		$sub_current79 = $matches79 ? 'class="current"' : '';
		$sub_current80 = $matches80 ? 'class="current"' : '';
		$sub_current81 = $matches81 ? 'class="current"' : '';
		$sub_current82 = $matches82 ? 'class="current"' : '';
		?>
	</li>
</ul>
<style>
#no_padding
{
 padding-right:3px !important;
}
</style>