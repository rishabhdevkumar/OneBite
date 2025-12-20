<?php
session_start();

if (isset($_GET['key'])) {

    $key = $_GET['key'];

    unset($_SESSION['add_cart'][$key]);

    $_SESSION['add_cart'] = array_values($_SESSION['add_cart']);

    $_SESSION['item_count'] = count($_SESSION['add_cart']);
}

header("Location: cart.php");

?>
