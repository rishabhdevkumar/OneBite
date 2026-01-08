<?php
session_start();

if (!empty($_SESSION['add_cart'])) {
    foreach ($_SESSION['add_cart'] as $item) {
        ?>
        <li>
            <span class="item">
                <span class="item-left">
                    <img src="admin/menu_img/<?php echo $item['product_image']; ?>" class="td_img">
                    <span class="item-info">
                        <span><?php echo $item['product_name']; ?></span>
                        <span>Rs.<?php echo $item['product_price']; ?></span>
                    </span>
                </span>
            </span>
        </li>
        <?php
    }
    ?>
    <li class="divider"></li>
    <li>
        <a href="cart.php">
            <button class="btn btn-danger btn-block">View Cart</button>
        </a>
    </li>
    <li>
        <button class="btn btn-danger btn-block" onclick="empty_card()">Empty Cart</button>
    </li>
<?php
} else {
    echo '<li class="text-center">Cart is Empty</li>';
}
?>
