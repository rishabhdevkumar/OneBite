<?php
session_start();
include("config.php");

$p_id = $_POST['p_id'];
$cat_id = $_POST['cat_id'];   
$QTY = 1;

$select_menu = "SELECT * FROM menu WHERE category_id='$cat_id' AND id='$p_id'";
$run_menu = mysqli_query($connect, $select_menu);
$find_menu1 = mysqli_fetch_array($run_menu);

if(isset($_SESSION['add_cart'])==true)
{
    
    $item_array_id = array_column($_SESSION['add_cart'],'product_id');

    if(!in_array($find_menu1['id'],$item_array_id)){
        $count = count($_SESSION['add_cart']);

        $product_details = array(
            'product_id'    => $find_menu1['id'],
            'product_image' => $find_menu1['menu_image'],
            'product_name'  => $find_menu1['menu_title'],  
            'product_price' => $find_menu1['menu_price'],  
            'product_qty'   => $QTY
        );

        $_SESSION['add_cart'][$p_id] = $product_details;
        $_SESSION['item_count'] = $count;
        $_SESSION['item_count'] =$_SESSION['item_count']+1;

    } else {
        $_SESSION['add_cart'][$p_id]['product_qty']=$_SESSION['add_cart']['$p_id']['product_qty']+1;
    }

} else {
    $_SESSION['item_count'] = 1;

    $product_details = array(
        'product_id'    => $find_menu1['id'],
        'product_image' => $find_menu1['menu_image'],
        'product_name'  => $find_menu1['menu_title'],   
        'product_price' => $find_menu1['menu_price'], 
        'product_qty'   => $QTY
    );

    $_SESSION['add_cart'][$p_id] = $product_details;
}

echo $_SESSION['item_count'] . "|";

foreach($_SESSION['add_cart'] as $key => $tem){
    echo '
        <li>
            <span class="item-left">
                <img class="td_img" src="admin/menu_img/'.$tem['product_image'].'" />
                <span class="item-info">
                    <span>'.$tem['product_name'].'</span>
                    <span>Rs. '.$tem['product_price'].'</span>
                </span>
            </span>
        </li>
    ';
}

echo '
<li class="divider"></li>
<li><a class="pull-left" href="cart.php"><button type="button"
class="btn btn-danger order-weight">View All</button></a></li>
<li><button type="button" class="btn btn-danger pull-right empty_cart_btn">Empty Cart</button></li>';
?>
