<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['item_id'], $_POST['name'], $_POST['price'], $_POST['image'])) {

    $item_id = $_POST['item_id'];
    $foundIndex = null;

    // Check if item exists in cart
    foreach ($_SESSION['cart'] as $i => $cartItem) {
        if ($cartItem['item_id'] == $item_id) {
            $foundIndex = $i;
            $_SESSION['cart'][$i]['qty'] += 1; // increment qty
            break;
        }
    }

    if ($foundIndex === null) {
        $_SESSION['cart'][] = [
            'item_id' => $item_id,
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'qty' => 1
        ];
        $foundIndex = count($_SESSION['cart']) - 1;
    }
}

// Calculate subtotal for this item
$item = $_SESSION['cart'][$foundIndex];
$subtotal = $item['qty'] * $item['price'];

// Calculate total cart amount
$total = 0;
foreach ($_SESSION['cart'] as $i) {
    $total += $i['qty'] * $i['price'];
}

echo json_encode([
    'status' => 'success',
    'item_id' => $item['item_id'],
    'qty' => $item['qty'],
    'subtotal' => $subtotal,
    'total' => $total
]);
exit;
?>
