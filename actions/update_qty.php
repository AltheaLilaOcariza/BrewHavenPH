<?php
session_start();
header("Content-Type: application/json");

if (!isset($_POST['item_id']) || !isset($_POST['action'])) {
    echo json_encode(["error" => true, "message" => "Missing params"]);
    exit;
}

$item_id = $_POST['item_id'];
$action = $_POST['action'];

$foundIndex = null;

// Find the item in cart
foreach ($_SESSION['cart'] as $i => $cartItem) {
    if ($cartItem['item_id'] == $item_id) {
        $foundIndex = $i;
        break;
    }
}

if ($foundIndex === null) {
    echo json_encode(["error" => true, "message" => "Item not found"]);
    exit;
}

// Handle plus/minus
if ($action === "plus") {
    $_SESSION['cart'][$foundIndex]['qty'] += 1;

} elseif ($action === "minus") {
    $_SESSION['cart'][$foundIndex]['qty'] -= 1;

    // Remove item if quantity reaches zero
    if ($_SESSION['cart'][$foundIndex]['qty'] <= 0) {
        array_splice($_SESSION['cart'], $foundIndex, 1);

        // Recalculate total
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['qty'] * $item['price'];
        }

        echo json_encode([
            "removed" => true,
            "item_id" => $item_id,
            "total" => $total
        ]);
        exit;
    }
}

// Item still exists → calculate qty, subtotal
$qty = $_SESSION['cart'][$foundIndex]['qty'];
$price = $_SESSION['cart'][$foundIndex]['price'];
$subtotal = $qty * $price;

// Compute total for cart
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['qty'] * $item['price'];
}

// Return structured JSON
echo json_encode([
    "removed" => false,
    "item_id" => $item_id,
    "qty" => $qty,
    "subtotal" => $subtotal,
    "total" => $total
]);
exit;
?>
