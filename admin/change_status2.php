<?php
include("config.php");
/*if(!isset($_SESSION['id']))
{
 header("location:index.php?login");
}*/


if(isset($_GET['id']) && $_GET['id']!='' && $_GET['status']=='yes')
{
  
 
 
 $data1='<a href="javascript:void(0)" style="color:red;" Title="Click here to activate"><img src="images/deact.png" width="24" height="24" border="0" alt="" onclick=\'change_status("'.$_GET['id'].'","no")\'></a>';

 

 $update_staus="UPDATE `dosa_gallery_photo` SET status='N' WHERE id='".$_GET['id']."'";
 $run_stauts=mysql_query($update_staus);


}
if(isset($_GET['id']) && $_GET['id']!='' && $_GET['status']=='no')
{
  
 $data1='<a href="javascript:void(0)" style="color:red;" Title="Click here to deactivate"><img src="images/act.png" width="24" height="24" border="0" alt="" onclick=\'change_status("'.$_GET['id'].'","yes")\'></a>';

 

 $update_staus="UPDATE `dosa_gallery_photo` SET status='Y' WHERE id='".$_GET['id']."'";
 $run_stauts=mysql_query($update_staus);

}

echo $data1;
exit;
?> 