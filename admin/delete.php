<?php
	include("config.php");
	if(isset($_GET['page_id']))
	{
	  $page_id = $_GET['page_id'];
	  $del = "DELETE  FROM `pages` WHERE id='".$page_id."'";
	  $run = mysqli_query($connect,$del);
	  if($run)
	  {
		header("location:list_pages.php");  
	  }
	}

	else if(isset($_GET['cat_id']) && isset($_GET['page_id1']))
	{
	  $cat_id=$_GET['cat_id'];
	  $page_id=$_GET['page_id1'];
	  $del = "DELETE FROM categories WHERE id='".$cat_id."'";
	  $run = mysqli_query($connect,$del);
	  if($run)
	  {
		header("location:list_categories.php?cat_id=".$page_id."");  
	  }

	}

	else if(isset($_GET['menu_id3']) && isset($_GET['page_id3']) && isset($_GET['cat_id3']))
	{
		 $menu_id=$_GET['menu_id3'];
		 $page_id=$_GET['page_id3'];
		 $cat_id=$_GET['cat_id3'];
		$del="DELETE  FROM `dosa_menu` WHERE id='".$menu_id."'";
	  	$run=mysql_query($del);
		if($run)
	 	 {
			header("location:list_menu.php?cat_id1=".$cat_id."&cat_id=".$page_id."");  
	  	}

	}

	else if(isset($_GET['gall_id']))
	{
		 $gall_id=$_GET['gall_id'];
		
		$del="DELETE  FROM dosa_gallery_photo WHERE id='".$gall_id."'";
	  	$run=mysql_query($del);
		if($run)
	 	 {
			header("location:list_gallery_photo.php");  
	  	}

	}
?>