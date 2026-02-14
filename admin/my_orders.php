<?php
include("includes/main_init.php");
if(isset($_GET['order_id']))
{
	$where_clause="where id = '".$_GET['order_id']."'";
	$condition = array();
	$order_table = find('first',ORDER_DETAILS_TABLE,'*',$where_clause,$condition);
	$_SESSION['set'] = 5;

			$data='<ul>
						<li style="margin-right:26px;margin-top:4px;float:right;font-size: 20px;
						font-weight: bold;"><a href="#!/my_orders1">List Orders</a></li>
					</ul>
					<div> 
						<div>
							<div>
								<h2>Order Details&nbsp(&nbspOrder No&nbsp:&nbsp'.$_GET['order_id'].'&nbsp/&nbspStatus&nbsp:&nbsp'.$order_table['status'].'&nbsp)</h2>
									
							</div>
							<center>
								<TABLE width="80%">
									<TR class="heading_text cart_font">
										
										<TD class="paddding1">'.($_SESSION['language'] == 'en' ? 'Menu Name' : 'Men&uuml;bezeichnung').'</TD>
										<TD class="paddding1">'.($_SESSION['language'] == 'en' ? 'Quantity' : 'Menge').'</TD>
										<TD class="paddding1">'.($_SESSION['language'] == 'en' ? 'Unit Price ('.$_SESSION['currency_id'].')' : 'Einzelpreis ('.$_SESSION['currency_id'].')').'</TD>
										<TD class="paddding1">'.($_SESSION['language'] == 'en' ? 'Amount ('.$_SESSION['currency_id'].')' : 'Betrag ('.$_SESSION['currency_id'].')').'</TD>
										
									</TR>';
			
				 $where_clause="where order_id = '".$_GET['order_id']."'";
				 $condition = array();
				 $order_table1 = find('all',ORDER_TABLE,'order_items,quantity,amount,status',$where_clause,$condition);

				 $total=0;
				 $subtotal=0;
				 foreach($order_table1 as $detail_name)
				 {
					 $price = sprintf('%0.2f', $detail_name['amount']);
			
			
					 $data.='<TR class="desc_text white cart_font">
										<TD class="paddding3">'.$detail_name['order_items'].'</TD>
										<TD class="paddding3">'.$detail_name['quantity'].'</TD>
										<TD class="paddding3">'.$detail_name['amount'].'</TD>
										<TD class="paddding3">'.$detail_name['amount'].'</TD>
									</TR>';
			
					$subtotal=sprintf('%0.2f', $subtotal+$price);
				 }
					$total=sprintf('%0.2f', $subtotal+2.00);
							
							
			$data.='<TR class="desc_text pink cart_font">
										<TD class="paddding1" colspan="2"></TD>
										<TD class="paddding1 text_align">'.($_SESSION['language'] == 'en' ? 'Subtotal' : 'Zwischensumme').'</TD>
										<TD class="paddding1">&euro;&nbsp;'.$subtotal.'</TD>
									</TR>
									<TR class="desc_text pink cart_font">
										<TD class="paddding1" colspan="2"></TD>
										<TD class="paddding1 text_align">'.($_SESSION['language'] == 'en' ? 'Tax' : 'MwSt.').'</TD>
										<TD class="paddding1">&euro;&nbsp;2.00</TD>
									</TR>
									<TR class="desc_text pink cart_font">
										<TD class="paddding1" colspan="2"></TD>
										<TD class="paddding1 text_align">'.($_SESSION['language'] == 'en' ? 'Total Order Amount' : 'Total Order Amount').'</TD>
										<TD class="paddding1">&euro;&nbsp;'.$total.'</TD>
									</TR></TABLE>
						</center>
						<TABLE class="tb_width_1" style="margin-top:20px;">';
			
				  
						$where_clause="where id='".$_GET['order_id']."'";
						$condition = array();
						$order = find('first',ORDER_DETAILS_TABLE,'*',$where_clause,$condition);

						$id = $order['id'];
						
						$order_dt = explode("-",$order['date']);
						$array = array($order_dt[2],$order_dt[1], $order_dt[0]);
						$separator = implode("/", $array);
						
						$amount = $order['amount'];
						$billing_f_name = $order['billing_f_name'];
						$billing_l_name = $order['billing_l_name'];
						$billing_email = $order['billing_email'];
						$billing_phno = $order['billing_phno'];
						$billing_country = $order['billing_country'];
						$billing_add = $order['billing_add'];
						$billing_pstl_cd = $order['billing_pstl_cd'];
						$billing_city = $order['billing_city'];
						$billing_state = $order['billing_state'];
						$shipping_f_name = $order['shipping_f_name'];
						$shipping_l_name = $order['shipping_l_name'];
						$shipping_email = $order['shipping_email'];
						$shipping_phno = $order['shipping_phno'];
						$shipping_country = $order['shipping_country'];
						$shipping_add = $order['shipping_add'];
						$shipping_pstl_cd = $order['shipping_pstl_cd'];
						$shipping_city = $order['shipping_city'];
						$shipping_state = $order['shipping_state'];

						$_SESSION['billing_email'] = $order['billing_email'];
						$_SESSION['billing_f_name'] = $order['billing_f_name'];
							
			$data.='<TR>
							<TD colspan="2" class="tab_3"><center>Billing Address</center></TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'First name' : 'Vorname').'</TD>
												<TD class="tab_1 normal_font">'.$billing_f_name.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Last name' : 'Nachname').'</TD>
												<TD class="tab_1 normal_font">'.$billing_l_name.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Email' : 'Email').'</TD>
												<TD class="tab_1 normal_font">'.$billing_email.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Phone number' : 'Telefonnummer').'</TD>
												<TD class="tab_1 normal_font">'.$billing_phno.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Country' : 'Land').'</TD>
												<TD class="tab_1 normal_font">'.$billing_country.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Street address' : 'Straﬂe').'</TD>
												<TD class="tab_1 normal_font">'.$billing_add.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Postal code' : 'Postleitzahl').'</TD>
												<TD class="tab_1 normal_font">'.$billing_pstl_cd.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'City' : 'Stadt').'</TD>
												<TD class="tab_1 normal_font">'.$billing_city.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'State' : 'Staat').'</TD>
												<TD class="tab_1 normal_font">'.$billing_state.'</TD>
											</TR>
											
											</table>

											<TABLE class="tb_width_1" style="margin-top:20px;">
											<TR>
												<TD colspan="2" class="tab_3"><center>'.($_SESSION['language'] == 'en' ? 'Shipping Address' : 'Liefer-Adresse').'</center></TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'First name' : 'Vorname').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_f_name.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Last name' : 'Nachname').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_l_name.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Email' : 'Email').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_email.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Phone number' : 'Telefonnummer').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_phno.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Country' : 'Land').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_country.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Street address' : 'Straﬂe').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_add.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'Postal code' : 'Postleitzahl').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_pstl_cd.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'City' : 'Stadt').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_city.'</TD>
											</TR>
											<TR>
												<TD class="tab_1">'.($_SESSION['language'] == 'en' ? 'State' : 'Staat').'</TD>
												<TD class="tab_1 normal_font">'.$shipping_state.'</TD>
											</TR>
											<TR>
												
											</TR>
											
											</TABLE>';

}
	echo $data;

?>