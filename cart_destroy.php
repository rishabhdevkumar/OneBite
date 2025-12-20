<?php   
   include("config.php");
   if(isset($_SESSION['uid']) && $_SESSION['uid']!='')
   {
    unset($_SESSION['add_cart']);
    $_SESSION['item_count']=0;
    echo $_SESSION['item_count'].'|'.'
    <h5 class="text-center text_c thank_font">Cart is Empty</h5>';
   }
   else
   {
    unset($_SESSION['add_cart']);
    $_SESSION['item_count']=0;
    echo $_SESSION['item_count'].'|'.'
    <h5 class="text-center text_c thank_font">Cart is Empty</h5>';
    }
?>
