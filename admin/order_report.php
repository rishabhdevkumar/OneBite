<?php
	include("includes/main_init.php");
	/*if(!isset($_POST)&&!isset($_GET))
	{
		//print_r($_POST);
		//exit;
		unset($_SESSION['chw']);
	}*/
	if(!isset($_SESSION['id']))
	{
		header("location:index.php?login");
	}
	$admin_details = find('first',ADMIN,'*', $where_admin_details, $execute_admin_details);
	if($admin_details['act_currency_id']!='')
	{
		$where_currency = 'where currency_id='.$admin_details['act_currency_id'].'';
		$execute_currency = array();
		$currency = find('first',CURRENCY,'currency_id, currency_name, currency_sign', $where_currency, $execute_currency);
		$currency_sign = $currency['currency_sign'];	
	}		
	

		$set_value = "status  = :status"; 
		$execute[':status'] = 'Completed';
		$where_clause="where id='".$_REQUEST['order_id']."'";
		$updt_menu_tbl = update(ORDER_DETAILS, $set_value, $where_clause, $execute);

		$set_value = "status  = :status"; 
		$execute[':status'] = 'Completed';
		$where_clause="where order_id='".$_REQUEST['order_id']."'";
		$updt_menu_order_tbl = update(ORDER_TABLE, $set_value, $where_clause, $execute);

	$row=10;


	$list_user=array();
	$chw="where 1 ";
	$where="GROUP BY O.order_id ORDER BY  OD.id DESC";
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
				$_SESSION['chw']=$chw;
			}
			if($_POST['sel_sear']=='status')
			{			
				$chw="WHERE OD.status='".$_POST['find_status']."'";
				$_SESSION['chw']=$chw;
			}
			if($_POST['sel_sear']=='amount_ser')
			{			
				$chw="WHERE OD.amount between ".$_POST['find_f_amt']." and ".$_POST['find_t_amt']." ";
				$_SESSION['chw']=$chw;
			}
		}
	}
	if(isset($_POST['submit1']))
	{
		unset($_SESSION['chw']);
		$chw="where 1 ";
		$_SESSION['chw']=$chw;
	}
	$where=$_SESSION['chw'].$where;
	$exe_find_user=find('all',ORDER_DETAILS_TABLE." as OD INNER JOIN ".ORDER_TABLE." as O ON OD.id =O.order_id",'OD.*',$where,$list_user);
	
	$value=count($exe_find_user);
	/*print_r($value);
	exit;*/
		$totalpage=ceil($value/$row);

	(isset($_GET['p']) && $_GET['p']!='') ? $currentpage=$_GET['p'] : '';

	$currentpage>$totalpage ? $currentpage=$totalpage : '';

	$currentpage<=0 ? $currentpage=1 : '';
	
	$rowperpage=$row*($currentpage-1);

	$list_user1=array();
	if(isset($_SESSION['chw']))
	{
		$where=$chw."GROUP BY O.order_id ORDER BY  OD.id DESC limit $rowperpage,$row";
	}
	else
	{
		$where=$_SESSION['chw']."GROUP BY O.order_id ORDER BY  OD.id DESC limit $rowperpage,$row";
	}
	$exe_find_user1=find('all',ORDER_DETAILS." as OD INNER JOIN ".ORDER_TABLE." as O ON OD.id =O.order_id",'OD.*',$where,$list_user1);
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
"SELECT order_items,count(quantity) from  mc_orders group by order_items order by count(quantity)" desc
$whereClause = "WHERE sub_menus_id=0 group by order_items order by sum(quantity) desc";
$condition = array();
$menu_item = find('all',ORDER_TABLE,'order_items,sum(quantity) as sum',$whereClause,$condition);
	//$subtotal = 0;
//print_r($menu_item);
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
			$( "#datepicker" ).datepicker();
			});
			$(function() {
			$( "#datepicker1" ).datepicker();
			});
			$(document).ready(function(){
				$('.content-box-content').css({"padding":"0px"});
			});
 </script>


		<script type="text/javascript">
  			$(document).ready(function() {
				$("#dashboard").validationEngine()});
				
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
			
			function search()
			 {
				if(document.getElementById("sel_sear1").checked==false && document.getElementById("sel_sear2").checked==false && document.getElementById("sel_sear3").checked==false)
				{
					showError("Please select any search option.");
					return false;
				}
				if(document.getElementById('sel_sear1').checked==true)
				 {
					if(document.getElementById('datepicker').value=="")
					{

							alert("Please select date range");
							return false;
							
					}
					else if(document.getElementById('datepicker1').value=="")
					{

							alert("Please select date range");
							return false;
					}
				 }
				 if(document.getElementById('sel_sear2').checked==true)
				 {
					if(document.getElementById('status').checked==false && document.getElementById('status1').checked==false)
					{
							alert("Please select Status");
							return false;					
					}					
				 }
				 if(document.getElementById('sel_sear3').checked==true)
				 {
					if(document.getElementById('amt1').value=="")
					{
							alert("Please select Amount From.");
							return false;							
					}
					else if(document.getElementById('amt2').value=="")
					{
							alert("Please select Amount To.");
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

			 function updt_menu_list(order_id)
			  {
				 window.location.href="order.php?order_id="+order_id;
				 
			  }
			  function show(order_id)
			  {
				 window.location.href="menu_details.php?order_id="+order_id;
			  }
		</script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load("visualization", "1", {packages:["corechart"]});
		  google.setOnLoadCallback(drawChart);
		  function drawChart() {
			var data = google.visualization.arrayToDataTable([
			  ['Task', 'Hours per Day'],
				<?php $c=0; foreach($menu_item as $menu){ if($c==11){ break; } $c++; ?>
			  ['<?php echo $menu["order_items"]; ?>',     <?php echo $menu["sum"]; ?>], <?php  } ?>
			  ['Eat',      2],
			  ['Commute',  2],
			  ['Watch TV', 2],
			  ['Sleep',    7]
			]);

			var options = {
			  title: '',				
			  is3D: true,
				   chartArea:{left:'10%',top:"2%",width:"95%",height:"95%"},
			 legend:{position: 'labeled'},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
			chart.draw(data, options);
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
						<h3>Top Sale</h3>
						<ul class="content-box-tabs">
							<li><a href="order_report.php" class="default-tab">Top Sale</a></li>
							<li><a href="comparative_sale.php">Comparative Sale</a></li>
						</ul>						
						<div class="clear"></div>
					</div>
					<div class="content-box-content">
					
				</div>
				<div class="clear"></div>
						<div class="tab-content">
						<div id="piechart_3d" style="width: 1010px; height: 600px;"></div>	
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
	if(isset($_REQUEST['m']) && $_REQUEST['m']=='E')
	{
		unset($_SESSION['SET_FLASH']);
		unset($_SESSION['SET_TYPE']);
	}
?> 
