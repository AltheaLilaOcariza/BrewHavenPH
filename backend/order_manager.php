<?php
session_start();
require 'functions.php';
$manager = new OrderDAO();

if(isset($_POST['confirm'])){
    //$total_amount = $_POST['total_amount'];
    //$items = $_POST['items']; // array of cart items
    $items = $_SESSION['cart'];

    if (empty($items)) {
        header("Location: ../pages/order.php?error=empty_cart");
        exit;
    }
    // Create order using your class method
    $success = $manager->createOrder( 'pending', $items);

    // Clear the cart
    unset($_SESSION['cart']);
    
      // Load SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($success) {
        header("Location: ../pages/order.php?status=success&action=order");
        exit;
    } else {
        header("Location: ../pages/order.php?status=error&action=order");
        exit;
    }

    exit;
}

if(isset($_POST['cancel'])){
    unset($_SESSION['cart']);
    header("Location: ../pages/order.php?status=success&action=cancel");
    exit;
}
?>