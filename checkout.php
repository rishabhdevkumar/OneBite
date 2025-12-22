<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = 'order_now.php';
    header("Location: login.php");
    exit;
} else {
    // User already logged in, go directly to order page
    header("Location: order_now.php");
    exit;
}
?>
