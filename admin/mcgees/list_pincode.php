<?php
	include("includes/main_init.php");
	
	if(!isset($_SESSION['id']))
	{
		header("location:index.php?login");
	}
	
	if(isset($_GET['ins']))
	{
		$_SESSION['SET_TYPE'] = 'success';
	    $_SESSION['SET_FLASH'] = 'Pincode added successfully';
	}
   else if(isset($_GET['upd']))
    {
		$_SESSION['SET_TYPE'] = 'success';
	    $_SESSION['SET_FLASH'] = 'Pincode updated successfully';
	}
	if(isset($_GET['did']))
	{
		$where_clause="where id=".$_GET['did'];
		delete(PINCODE, $where_clause);
		header("location:list_pincode.php?page=".$_GET["page"]);
	}
	$execute=array();
    $exe_find_machine_cat_name=find("all",PINCODE,"*", "where 1 order  by id desc", $execute);

	$maxListed =25;
	$totalPages = 0;
	if($exe_find_machine_cat_name)
	{
		$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
		$bottomCut = ($page-1) * $maxListed;
		$totalPages = intval( ceil(count($exe_find_machine_cat_name) / $maxListed ));
		$exe_find_machine_cat_name = array_slice($exe_find_machine_cat_name , $bottomCut, $maxListed);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>List of Pincode || Mc Gee's Irish Pub & Restaurant</title>	  
		
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	    <link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/jquery.configuration.js"></script>
	
	<script type="text/javascript">
		
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
						<h3>List of Pincode</h3>
						<ul class="content-box-tabs">
								<li><a href="add_pincode.php" >Add Pincode</a></li> 
								<li><a href="list_pincode.php" class="default-tab">List of Pincode</a></li>
							</ul>						
						<div class="clear"></div>
					</div>
					<div class="content-box-content">
						<div class="tab-content">
							<form action="" id="dashboard" name="dashboard" method="post">		
								<table>
									<thead>
										<tr>
										  	
										   <th>Pincode</th>								
										   <th>Minimum Order Amount</th>
										   <th>Action</th>
										</tr>									
									</thead>				 
									<tbody>
										<?php
										if($exe_find_machine_cat_name)
										{
											foreach($exe_find_machine_cat_name as $details)
											{
												
												?>
												<tr>
													<td style=" vertical-align: top;"><?php echo $details['pincode']; ?></td>
													<td style=" vertical-align: top;"><?php echo $details['order_amount']; ?></td>			
													<td style=" vertical-align: top;">
														<a href="edit_pincode.php?eid=<?=$details['id']?>&page=<?php echo $_GET["page"]; ?>"  title="Edit"><img src="images/pencil.png" alt="Edit" /></a>&nbsp;
														<a href="list_pincode.php?did=<?php echo $details['id']; ?>&page=<?php echo $_GET["page"]; ?>" onclick="return confirm('Are you sure you want to delete this pincode?')" title="Delete"><img src="images/cross.png" alt="Delete" /></a> &nbsp;						 
													</td>
												</tr>	
												<?php
											}
										}
								if($totalPages>=1)
								 {
								$PREV = intval($page - 1);
								$NEXT = intval($page  + 1);
										?>
										<div style="width:100%">
					<table width="100%">
							<tfoot>
								<tr>
									<td >
										<div class="bulk-actions align-left"></div>
										<div class="pagination">
										<?php
												if($totalPages>=1)
												{
													if($page>1)
													{
												
												    ?>
													<a href="list_pincode.php?&page=<?php echo($PREV);?>" title="Previous Page">&laquo; Previous</a>
												<?php } 
											  
													else
													{
												?>
												<span class="">&laquo; Previous</span>
												<?php
													}
												}
												for($COUNTER=1; $COUNTER<=$totalPages; $COUNTER++)
														{
															if($page == $COUNTER)
															{

														?>
											<a href="javascript:void(0)" style="text-decoration:none" class="number current" disabled="disabled"><?PHP echo($COUNTER);?></a>
											<?php
													}
													else
													{
												
												 ?>
												<a class="number" href="list_pincode.php?&page=<?php echo($COUNTER);?>"><?PHP echo($COUNTER);?></a>
												
												<?php
													}
												}
												if($page<=$totalPages)
												{
													if($page<$totalPages)
													{
												  ?>
													<a href="list_pincode.php?page=<?php echo($NEXT);?>" title="Previous Page"> Next &raquo;</a>
												
													<?php
														}
														else
														{
													?>
													<span class="next-off">Next &raquo;</span>
													<?php
														}
												   }
													?>
											<!-- <a href="#" class="number" title="1">1</a>
											<a href="#" class="number" title="2">2</a>
											<a href="#" class="number current" title="3">3</a>
											<a href="#" class="number" title="4">4</a>
											<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a> -->
										</div>
										<div class="clear"></div>
									</td>
								</tr>
							</tfoot>
							<?php
							
						  
						}

					else { ?>
					<tr align="center">
			<td colspan="4">
			<div style="color:red;font-size:15px;text-align:center;border:0px solid red;width:100%;">
			Sorry no records found!
			</div>
			</td>
			</tr>
			  <?php
				 }
			   ?>
			</table>
		</div>
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
<?php 
	if(isset($_SESSION['SET_FLASH']))
	{
		if($_SESSION['SET_TYPE']=='success')
		{
			echo "<script type='text/javascript'>showSuccess('".$_SESSION['SET_FLASH']."');</script>";
		}
		else if($_SESSION['SET_TYPE']=='error')
		{
			echo "<script type='text/javascript'>showError('".$_SESSION['SET_FLASH']."');</script>";
		}
	}

	//destroy session flash message
	//if(isset($_REQUEST['m']) && $_REQUEST['m']=='E')
	//{
		unset($_SESSION['SET_FLASH']);
		unset($_SESSION['SET_TYPE']);
	//}
?>