<?php
	include("includes/main_init.php");
	if(/*!isset($_POST)&&*/!isset($_GET['p']))
	{
		//print_r($_POST);
		//exit;
		unset($_SESSION['chw']);
		unset($_SESSION['ser']);
		unset($_SESSION['f_d']);
		unset($_SESSION['t_d']);
		unset($_SESSION['st']);
		unset($_SESSION['f_amt']);
		unset($_SESSION['t_amt']);
	}
	if(!isset($_SESSION['id']))
	{
		header("location:index.php?login");
	}
	$execute_admin_details = array();
	$admin_details = find('first',ADMIN,'*', 'Where 1', $execute_admin_details);
	if($admin_details['act_currency_id']!='')
	{
		$where_currency = 'where currency_id='.$admin_details['act_currency_id'].'';
		$execute_currency = array();
		$currency = find('first',CURRENCY,'currency_id, currency_name, currency_sign', $where_currency, $execute_currency);
		$currency_sign = $currency['currency_sign'];	
	}
	
	$detail_order = find('all',ORDER_DETAILS_TABLE,'id','where status = "Pending" AND CURDATE() >date', array());
	if(isset($detail_order))
	{
		foreach($detail_order as $due_ord)
		{
			delete(ORDER_TABLE,'where order_id ='.$due_ord['id']);
		}
		delete(ORDER_DETAILS_TABLE,'where status = "Pending" AND CURDATE() >date');
	}
	
	if(isset($_REQUEST['order_id']))
	{
		$set_value = "status  = :status"; 
		$execute[':status'] = 'Completed';
		$where_clause="where id='".$_REQUEST['order_id']."'";
		$updt_menu_tbl = update(ORDER_DETAILS_TABLE, $set_value, $where_clause, $execute);

		$set_value = "status  = :status"; 
		$execute[':status'] = 'Completed';
		$where_clause="where order_id='".$_REQUEST['order_id']."'";
		$updt_menu_order_tbl = update(ORDER_TABLE, $set_value, $where_clause, $execute);
	}

	$row=10;


	$list_user=array();
	$chw="where 1 ";
	$where=" AND OD.status='Confirmed' GROUP BY O.order_id ORDER BY  OD.id DESC";
	if(isset($_POST['submit']))
	{
		if(isset($_POST['sel_sear']))
		{
			if($_POST['sel_sear']=='date_ser')
			{
				$objdate=new DateTime($_POST['find']);
				$from_date=$objdate->format('Y-m-d');
				$objdate1=new DateTime($_POST['find1']);
				$to_date=$objdate1->format('Y-m-d');
				//echo $from_date;
				//exit;
				$chw="WHERE OD.date BETWEEN '".$from_date."' AND '".$to_date."' ";
				if($_POST['pin_code']!='')
				{
					$value=addslashes($_POST['pin_code']);
					$chw="WHERE OD.date BETWEEN '".$from_date."' AND '".$to_date."' and OD.shipping_pstl_cd='".$value."' ";
				}
				$_SESSION['chw']=$chw;
				$_SESSION['ser']='date_ser';
				$_SESSION['f_d']=$_POST['find'];
				$_SESSION['t_d']=$_POST['find1'];
				unset($_GET['p']);
			}
			if($_POST['sel_sear']=='status')
			{	
				$value=addslashes($_POST['company']);
				$chw="WHERE OD.shipping_country='".$value."' ";
				$_SESSION['chw']=$chw;
				$_SESSION['ser']='status';
				$_SESSION['st']=$_POST['company'];
				unset($_GET['p']);
			}
			if($_POST['sel_sear']=='amount_ser')
			{			
				$chw="WHERE OD.amount between ".$_POST['find_f_amt']." and ".$_POST['find_t_amt']." ";
				$_SESSION['chw']=$chw;
				$_SESSION['ser']='amount_ser';
				$_SESSION['f_amt']=$_POST['find_f_amt'];
				$_SESSION['t_amt']=$_POST['find_t_amt'];
				unset($_GET['p']);
			}
		}
	}
	if(isset($_POST['submit1']))
	{
		unset($_SESSION['chw']);
		//$chw="where 1 ";
		//$_SESSION['chw']=$chw;
		unset($_SESSION['ser']);
		unset($_SESSION['f_d']);
		unset($_SESSION['t_d']);
		unset($_SESSION['st']);
		unset($_SESSION['f_amt']);
		unset($_SESSION['t_amt']);
		unset($_GET['p']);

	}
	if(isset($_SESSION['chw']))
	{
		$where=$_SESSION['chw'].$where;
	}
	$exe_find_user=find('all',ORDER_DETAILS_TABLE." as OD INNER JOIN ".ORDER_TABLE." as O ON OD.id =O.order_id",'OD.*',$where,$list_user);
	
	$value=count($exe_find_user);
	/*print_r($value);
	exit;*/
	$totalpage=ceil($value/$row);
	
	$currentpage = 1;
	(isset($_GET['p']) && $_GET['p']!='') ? $currentpage=$_GET['p'] : '';

	$currentpage>$totalpage ? $currentpage=$totalpage : '';

	$currentpage<=0 ? $currentpage=1 : '';
	
	$rowperpage=$row*($currentpage-1);

	$list_user1=array();
	if(isset($_SESSION['chw']))
	{
		$where=$_SESSION['chw']." AND OD.status='Confirmed' GROUP BY O.order_id ORDER BY  OD.id DESC limit $rowperpage,$row";
	}
	else
	{
		$where=" AND OD.status='Confirmed' GROUP BY O.order_id ORDER BY  OD.id DESC limit $rowperpage,$row";
	}
	$exe_find_user1=find('all',ORDER_DETAILS_TABLE." as OD INNER JOIN ".ORDER_TABLE." as O ON OD.id =O.order_id",'OD.*',$where,$list_user1);
	$value1=count($exe_find_user1);
	$tot_amt=0;
	foreach($exe_find_user1 as $amt_tot)
	{
		$tot_amt=sprintf('%0.2f', ($tot_amt+$amt_tot['amount']),2,'.','');
	}

	$page_link=5;
	$page_loop=ceil($page_link/2);
	$page_loop1=ceil(($page_link+$page_loop)/2);
	$drc=$page_link-$page_loop;
	$t=$totalpage-$drc;
	$page_loop2=$page_link-1;

	$incr = ($page_link%2==0)? $drc-1 : $drc;

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		
		<title>List Items || Dosa Restaurant</title>	  
		
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.notifyBar.js"></script>
	    <link rel="stylesheet" href="css/notifyBar.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<script type="text/javascript" src="js/jquery.configuration.js"></script>
		
		<script type="text/javascript" language="javascript" src="js/jquery.validationEngine.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.validationEngine-en.js"></script>
		<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css">
		<script src="date_picker/ui/jquery.ui.core.js"></script>
		<script src="date_picker/ui/jquery.ui.widget.js"></script>
		<script src="date_picker/ui/jquery.ui.datepicker.js"></script>
		<link rel="stylesheet" href="date_picker/base/jquery.ui.all.css">
 <script type="text/javascript">
        
		    $(function() {
			$( "#datepicker" ).datepicker({
				maxDate: 'today',
				showOn: 'both', 
				buttonImageOnly: true,
				buttonImage: 'images/calendar_icon.png' });
			});
			$(function() {
			$( "#datepicker1" ).datepicker({
			maxDate: 'today',
				showOn: 'both', 
				buttonImageOnly: true,
				buttonImage: 'images/calendar_icon.png'
			});
			});
 </script>


		<script type="text/javascript">
  			$(document).ready(function() {
				$("#dashboard").validationEngine()
				$('.ui-datepicker-trigger').css({"width":"20px"});	
				$('.ui-datepicker-trigger').css({"cursor":"pointer"});
				$('.ui-datepicker-trigger').css({"margin-bottom":"-5px"});
				});			 	
			function open_colorbox(id)
			{
				$.colorbox({href:"product_details.php?id="+id, width:"400", height:"340", iframe:true});
			}
			function open_image(id)
			{
				$.colorbox({href:"view_image.php?id="+id, width:"560", height:"490", iframe:true});
			}
			function open_edit(id,p)
			{				
				window.location.href="edit_product.php?id="+id+"&p="+p;
			}
			function changecategory(value)
			{				
				document.dashboard.submit();
			}	

			function cl_all()
			{
				if(document.getElementById('sel_sear1').checked==true)
				{										
					document.getElementById("amt1").value='';
					document.getElementById("amt2").value='';
					document.getElementById("company").value='';
					/*document.getElementbyid("amt1").readonly=true;
					document.getElementById("amt2").readonly=true;*/
				}
				else if(document.getElementById('sel_sear2').checked==true)
				{					
					document.getElementById("datepicker").value='';
					document.getElementById("datepicker1").value='';
					document.getElementById("amt1").value='';
					document.getElementById("amt2").value='';
				}
				else if(document.getElementById('sel_sear3').checked==true)
				{
					document.getElementById("datepicker").value='';
					document.getElementById("datepicker1").value='';
					document.getElementById("company").value='';
				}
			}
			
			
			function search()
			 {
				if(document.getElementById("sel_sear1").checked==false && document.getElementById("sel_sear2").checked==false && document.getElementById("sel_sear3").checked==false)
				{
					showError("Please select any search option");
					return false;
				}
				if(document.getElementById('sel_sear1').checked==true)
				{				
					document.getElementById("amt1").value='';
					document.getElementById("amt2").value='';					
					if(document.getElementById('datepicker').value=="")
					{							
							showError("Please select Date From");
							return false;							
					}
					else if(document.getElementById('datepicker1').value=="")
					{
							showError("Please select Date To");
							return false;
					}
					var d_f = new Date(document.getElementById('datepicker').value);
					var d_t= new Date(document.getElementById('datepicker1').value);
					if(d_f>d_t)
					 {
						showError("Please select valid Date Range");
						return false;
					 }
				 }
				 if(document.getElementById('sel_sear2').checked==true)
				 {
					document.getElementById("datepicker").value='';
					document.getElementById("datepicker1").value='';
					document.getElementById("amt1").value='';
					document.getElementById("amt2").value='';
					if(document.getElementById("company").value=='')
					{
							showError("Please write Company Name");
							return false;					
					}					
				 }
				 if(document.getElementById('sel_sear3').checked==true)
				 {	
					document.getElementById("datepicker").value='';
					document.getElementById("datepicker1").value='';					
					if(document.getElementById('amt1').value=="")
					{
							showError("Please insert Amount From");
							return false;							
					}
					else if(document.getElementById('amt2').value=="")
					{
							showError("Please insert Amount To");
							return false;
					}
					var amt_f=document.getElementById("amt1").value;
					var amt_t=document.getElementById("amt2").value;					
					if(eval(amt_f)>eval(amt_t))
					{
						showError("Please insert valid Amount Range");
						return false;
					}
					if(amt_f=='.' || amt_t=='.')
					{
						showError("Only '.' sign not allowed inside Amount field");
						return false;
					}
				 }
				else
				{
						document.getElementById('h1').value='searching';
				}
			 }
			 function all()
				{
					
						document.getElementById('h2').value='all';
						
				}

			 function updt_menu_list(order_id,page)
			  {
				 //alert(page);
				 if(page!='')
				  {
					window.location.href="order.php?order_id="+order_id+"&p="+page;
				  }
				  else
				  {
					window.location.href="order.php?order_id="+order_id;
				  }
			  }
			  function show(order_id)
			  {
				 window.location.href="menu_details.php?order_id="+order_id;
			  }
			   function valid_phone(x)
				{
				//alert(x.which);
				if(x.which>=48 && x.which<=57 || x.which==8 || x.which==0 ||x.which==46)
					{
						return true;
					}		
					return false;
				 }
				

		</script>
	
	</head>   
	<body>
		<div id="body-wrapper">		
			<div id="sidebar">
				<div id="sidebar-wrapper">
					<?php require 'sidebar.php';?>
				</div>
			</div>
			<div id="main-content"> 
			
			<div><input type="hidden" id="h1" name="s"></div>
			<div><input type="hidden" id="h2" name="s1"></div>		
				
				<div class="content-box">
					<div class="content-box-header">
						<h3>Orders</h3>
						<ul class="content-box-tabs">
							<li><a href="#" class="default-tab">Order Items</a></li>
						</ul>						
						<div class="clear"></div>
					</div>
					<div class="content-box-content">
					<form id="frm" method="POST" action="">
					<div><b><h5 style="margin-bottom:10px;">Search orders by:</h5></b></div>
						<div style="width:738px;height:47px;"><b><input type="radio" name="sel_sear" onClick="cl_all();" id="sel_sear1" value="date_ser"<?php echo($_POST['sel_sear']=='date_ser'?'checked':''); if(isset($_POST['submit']) && $_POST['sel_sear']=='date_ser') { echo "checked";} else{ if(isset($_SESSION['ser']) && $_SESSION['ser']=='date_ser'){ echo "checked"; } else{ echo ""; } }?>/>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From:&nbsp;
			<!-- <input style="width:66px; cursor:pointer" type="text" autocomplete="off" id="datepicker" name="find" value="<?php if(isset($_POST['submit'])){echo ($_POST['find']);} else {if(isset($_SESSION['f_d'])){echo ($_SESSION['f_d']);} else { echo "";}}?>" readonly>&nbsp;&nbsp;&nbsp;To:&nbsp;
			<input style="width:66px; cursor:pointer" type="text" autocomplete="off" id="datepicker1" name="find1" value="<?php if(isset($_POST['submit'])){echo ($_POST['find1']);} else {if(isset($_SESSION['t_d'])){echo ($_SESSION['t_d']);} else { echo "";}}?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;Pincode:&nbsp;
			<input style="width:86px;" type="text" autocomplete="off" id="pin_code" name="pin_code" value="<?php if(isset($_POST['submit'])){echo ($_POST['pin_code']);} else {if(isset($_SESSION['pin_code'])){echo ($_SESSION['pin_code']);} else { echo "";}} ?>">
			<br/>
			<br/><input type="radio" name="sel_sear" onClick="cl_all();" id="sel_sear2" value="status" <?php echo($_POST['sel_sear']=='status'?'checked':'');if(isset($_POST['submit']) && $_POST['sel_sear']=='status') { echo "checked";} else{ if($_SESSION['ser']=='status'){ echo "checked"; } else{ echo ""; } } ?>/>Company &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input style="width:86px;" type="text" autocomplete="off" id="company" name="company" value="<?php if(isset($_POST['submit'])){echo ($_POST['company']);} else {if(isset($_SESSION['st'])){echo ($_SESSION['st']);} else { echo "";}} ?>" > -->

			<input type="radio" id="status" name="find_status" value="Pending" <?php echo($_SESSION['st']=='Pending'?'checked':''); ?>/>Pending
			
			&nbsp;<input type="radio" id="status1" name="find_status" value="Completed" <?php echo($_SESSION['st']=='Completed'?'checked':''); ?>/>Completed
			<br/>
			<br/><input type="radio" name="sel_sear" onClick="cl_all();" id="sel_sear3" value="amount_ser" <?php echo($_POST['sel_sear']=='amount_ser'?'checked':''); if(isset($_POST['submit']) && $_POST['sel_sear']=='amount_ser') { echo "checked";} else{ if(isset($_SESSION['ser']) && $_SESSION['ser']=='amount_ser'){ echo "checked"; } else{ echo ""; } } ?>/>Amount &nbsp;&nbsp;&nbsp;&nbsp;From:&nbsp;
			<input style="width:86px;" type="text" autocomplete="off" onKeyPress="return valid_phone(event);" id="amt1" name="find_f_amt" value="<?php if(isset($_POST['submit'])){echo ($_POST['find_f_amt']);} else {if(isset($_SESSION['f_amt'])){echo ($_SESSION['f_amt']);} else { echo "";}} ?>">&nbsp;&nbsp;&nbsp;To:&nbsp;
			<input style="width:86px;" type="text" autocomplete="off" id="amt2" onKeyPress="return valid_phone(event);" name="find_t_amt" value="<?php if(isset($_POST['submit'])){echo ($_POST['find_t_amt']);} else {if(isset($_SESSION['t_amt'])){echo ($_SESSION['t_amt']);} else { echo "";}} ?>"> -->
				<div style="width:49%;float:right;"><input type="submit" name="submit" value="Search" onclick="return search()"/>&nbsp;&nbsp;<input type="submit" name="submit1" value="Show all Orders" onclick="all()"/></div></b>
				</form>
				<div style="width:12%;float:right;margin-right:12px;"></div>
				<div class="clear"></div>
						<div class="tab-content">
							<form action="" id="dashboard" name="dashboard" method="post">
								
								<table>
									<thead>
										<tr>
										   
										   <th>Order No</th>
										   <th>Date</th>
										   <th>Amount (<?php echo(isset($currency_sign)?$currency_sign:''); ?>)</th>
										  <!-- <th>Restaurant Name</th> -->
										   <th>Status</th>
										   <th><!-- Action --></th>
										</tr>
										<tr>
										<!-- <?php	if(!$exe_find_user1)
												{ ?>
													<tr align="center">
												<td colspan="5">
													<div style="color:red;font-size:15px;text-align:center;border:0px solid red;width:100%;">
														Sorry no records found!
													</div>
												</td>
											</tr>
										<?php		}
										?> -->
										</tr>
									</thead>
<!-- <?php
	
    if(empty($_REQUEST['PageNo']))
	{
		if(isset($StartRow) && $StartRow == 0)
			{
			 $PageNo = $StartRow + 1;
	        }
	}
	else
	{
		$PageNo = $_REQUEST['PageNo'];
		$StartRow = ($PageNo - 1) * $PageSize;
		
	}
	//$whereClause = "WHERE 1=1 order by id desc limit $StartRow,$PageSize";
	if($_POST['s']=='searching')
	 {

		  $date_from = explode("/",$_POST['find']);
		  $array = array($date_from[2], $date_from[0], $date_from[1]);
		  $separator = implode("-", $array);
		  $_POST['find'] = $separator;
		  $date_from_value=($_POST['find']);

		  $date_to = explode("/",$_POST['find1']);
		  $array1 = array($date_to[2], $date_to[0], $date_to[1]);
		  $separator1 = implode("-", $array1);
		  $_POST['find1'] = $separator1;
		  $date_to_value=($_POST['find1']);

		  $whereClause = "WHERE date between '$date_from_value' and '$date_to_value' limit $StartRow,$PageSize";
	 }
	
    
	
	if(!$exe_find_user1)
		 {
		//echo "Sorry!...No record found";
		exit;
		 }
	else
		 {
    foreach($exe_find_user1 as $menu_order)	
		{
	
?>			 -->
									<tbody>
									<tr>
										<td><a style="cursor:pointer;" onclick="show(
											 
											 <?php 
											   
											   $order_id = $menu_order['id'];
											   echo $order_id;
												
											 ?>
											 )"><?php echo($menu_order['id']);?></a></td>
										<td><?php 
												
												$strt_dob = explode("-",$menu_order['date']);
												$array = array($strt_dob[1],$strt_dob[2],$strt_dob[0]);
												$separator = implode("/", $array);
												echo $separator;
											?>
										</td> 
										<td><?php echo sprintf('%0.2f', ($menu_order['amount']+$menu_order['total_tax']));?></td>
										<td><?php echo($menu_order['restaurant_name']);?></td>
										<td><?php echo($menu_order['status']);?></td>
										<td id="st">
										     <a href="#" title="Update" onclick="updt_menu_list(
											 
											 <?php 
											   
											   $order_id = $menu_order['id'];
											   echo $order_id;
												
											 ?>,<?php echo $currentpage;?>
											 )"><?php if($menu_order['status']=='Completed')
													{
														echo "Complete";
													}
												 else
													{
													    echo "Update";
													}
												?></a>
										</td> 
									</tr>
									
								</tbody>
<?php
			}
		 }
?>																	 -->
								<tfoot>
								<tr>
								<td></td><td style="text-align:right; padding-right:0px !important;""><b>Total:</b></td>
									<td colspan="" style="text-align:left;"><b><?php echo $tot_amt; ?></b><div style="margin-left: 0px; width: 82%;"></div></td>
									<td></td><td></td>
								</tr>
									<tr>								  
										  <td colspan="7">
											<div class="bulk-actions align-left"></div>
											<div class="pagination">
											<?php if($totalpage>1) { if($currentpage>1) { ?>
												<a href="order.php?p=<?php echo $currentpage-1; ?>&id=<?php echo $_GET['id'];?>" title="Previous Page">&laquo; Previous</a>
												<?php } if($totalpage<$page_link) { for($i=1;$i<=$totalpage;$i++) { ?>
												<a href="order.php?p=<?php echo $i; ?>&id=<?php echo $_GET['id'];?>"<?php if($i==$currentpage) { ?>class="number current"<?php } else ?> class="number" title="paging"><?php echo $i;
												?></a>
												<?php } } else if($currentpage<=$page_loop) { for($i=1;$i<=$page_link;$i++) { ?>
												<a href="order.php?p=<?php echo $i; ?>&id=<?php echo $_GET['id'];?>"<?php if($i==$currentpage) { ?>class="number current"<?php } else ?> class="number" title="paging"><?php echo $i; ?></a>
												<?php } } else if($currentpage>$t) { for($i=$totalpage-$page_loop2;$i<=$totalpage;$i++) { ?>

												<a href="order.php?p=<?php echo $i; ?>&id=<?php echo $_GET['id'];?>"<?php if($i==$currentpage) { ?>class="number current"<?php } else ?> class="number" title="paging"><?php echo $i; ?></a>


												<?php } } else { for($i=$currentpage-$drc;$i<=$currentpage+$incr;$i++) { ?>

												<a href="order.php?p=<?php echo $i; ?>&id=<?php echo $_GET['id'];?>"<?php if($i==$currentpage) { ?>class="number current"<?php } else ?> class="number" title="paging"><?php echo $i; ?></a>
												<?php } } ?>

												<?php if($currentpage!=$totalpage) { ?>
												<a href="order.php?p=<?php echo $currentpage+1; ?>&id=<?php echo $_GET['id'];?>" title="Next Page">Next &raquo;</a>
												<?php } } ?>											
											</div>
											<div class="clear"></div>
									
										</td>
										  
									</tr>
								</tfoot>

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
