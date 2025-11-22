<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image'])) {

    $item = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'qty' => 1
    ];

    $_SESSION['cart'][] = $item;
}

header("Location: order.php");
exit;
?>
