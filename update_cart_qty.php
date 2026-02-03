<?php
session_start();

$p_id = $_POST['p_id'];
$qty  = $_POST['qty'];

if ($qty == 0) {
    unset($_SESSION['add_cart'][$p_id]);
} else {
    $_SESSION['add_cart'][$p_id]['product_qty'] = $qty;
}

$total = 0;
foreach ($_SESSION['add_cart'] as $item) {
    $total += $item['product_price'] * $item['product_qty'];
}

$subtotal = isset($_SESSION['add_cart'][$p_id])
    ? ($_SESSION['add_cart'][$p_id]['product_price'] * $_SESSION['add_cart'][$p_id]['product_qty'])
    : 0;

$cart_html = '';
foreach ($_SESSION['add_cart'] as $key => $item) {
    $cart_html .= '
    <li>
        <span class="item">
            <span class="item-left">
                <img src="admin/menu_img/'.$item['product_image'].'">
                <span class="item-info">
                    <span>'.$item['product_name'].'</span>
                    <span>'.$item['product_price'].'</span>
                </span>
            </span>
        </span>
    </li>';
}

echo json_encode([
    "count" => count($_SESSION['add_cart']),
    "total" => number_format($total, 2),
    "subtotal" => number_format($subtotal, 2),
    "pid" => $p_id,
    "html" => $cart_html
]);
?>
