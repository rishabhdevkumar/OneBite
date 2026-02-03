<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['key'])) {
    unset($_SESSION['add_cart'][$_POST['key']]);
}

$table_html = '';
$header_html = '';
$grand_total = 0;
$count = 0;

if (!empty($_SESSION['add_cart'])) {

    foreach ($_SESSION['add_cart'] as $key => $item) {

        $subtotal = $item['product_price'] * $item['product_qty'];
        $grand_total += $subtotal;
        $count++;

        $table_html .= '
        <tr>
            <td>
                <a href="javascript:void(0)" onclick="remove_cart('.$key.')">
                    <img src="image/cancel1.png" class="cart_padd padd_img1">
                </a>
            </td>
            <td class="td_img">
                <img src="admin/menu_img/'.$item['product_image'].'" class="td_img">
            </td>
            <td class="text-center cart_padd">'.$item['product_name'].'</td>
            <td class="text-center cart_padd">'.$item['product_price'].'</td>
            <td class="text-center cart_padd">
                <input type="number" value="'.$item['product_qty'].'" class="cart_input">
            </td>
            <td class="text-center cart_padd">'.$subtotal.'</td>
        </tr>';

        $header_html .= '
        <li>
            <span class="item">
                <span class="item-left">
                    <img src="admin/menu_img/'.$item['product_image'].'" class="td_img">
                    <span class="item-info">
                        <span>'.$item['product_name'].'</span>
                        <span>'.$item['product_price'].'</span>
                    </span>
                </span>
            </span>
        </li>';
    }

    $header_html .= '
    <li class="divider"></li>
    <li><a href="cart.php" class="btn btn-danger btn-block">View Cart</a></li>';

} else {

    $table_html = '
    <tr>
        <td colspan="6" class="text-center">
            <h5 class="empty-cart-text"><strong><em>Cart is Empty</em></strong></h5>
        </td>
    </tr>';

    $header_html = '<li><h5 class="text-center">Cart is Empty</h5></li>';
}

echo json_encode([
    "table" => $table_html,
    "header" => $header_html,
    "count" => $count,
    "total" => $grand_total
]);
exit;
?>

<style>
  .empty-cart-text {
    font-size: 20px;
    animation: colorBlink 0.9s infinite;
}

@keyframes colorBlink {
    0%   { color: blue; }
    25%  { color: orange; }
    100% { color: red; }
}

</style>