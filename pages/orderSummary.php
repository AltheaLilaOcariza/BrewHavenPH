<?php
    $title = "Order | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/order_summary.css'];
    $extra_js = ['../assets/js/cart.js'];
    include '../includes/header.php';
    require '../backend/functions.php';

    $manager = new OrderDAO();
    $orderID = $manager->getLastOrderId();
    $orderID += 1;

    session_start();

    $cart = $_SESSION['cart'] ?? [];

    $total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <link rel="stylesheet" href="order_summary.css">
</head>

<body>
<?php include '../includes/nav.php';?>
<div class="container">
    <!-- LEFT SIDE -->
    <div class="left-side">

        <h1>ORDER SUMMARY</h1>

        <?php
        if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    // Defensive checks and cleaning:
                    $rawPrice = $item['price'] ?? 0;    // whatever is stored
                    $rawQty   = $item['qty'] ?? 0;

                    // Remove non-numeric characters (currency sign, spaces, commas)
                    $cleanPrice = floatval(str_replace([',', '₱', ' ', PHP_EOL, "\t"], '', $rawPrice));
                    $cleanQty   = intval($rawQty);

                    // ensure non-negative
                    if ($cleanQty < 0) $cleanQty = 0;
                    if ($cleanPrice < 0) $cleanPrice = 0.0;
                        $total += $cleanPrice * $cleanQty;
            }
        }
        ?>

        <?php foreach($cart as $item): ?>

            <?php
                $price = floatval($item['price']);
                $qty = intval($item['qty']);
                $subtotal = $item['price'] * $rawQty;
                $total += $subtotal;
            ?>

            <div class="product-box">

                <img src="<?php echo $item['image']; ?>" class="product-img">
                <h3>Product: <?php echo $item['name']; ?></h3>

                <p>
                    Quantity:
                    <?php echo $rawQty; ?>
                </p>

                <p>
                    Total Cost:
                    ₱<?php echo $subtotal; ?>
                </p>

            </div>

        <?php endforeach; ?>

        <div class="total">
            Grand Total: ₱<?php echo $total; ?>
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="right-side">

        <h2>Customer Information</h2>

        <form action="../backend/place_order.php" method="POST">

            <label>Costumer Name</label>
            <input type="text" name="customer_name" required>

            <label>Address</label>
            <textarea name="address" required></textarea>

            <label>Payment Method</label>
            <select name="payment_method" required>
                <option value="">Select Payment</option>
                <option value="CASH ON DELIVERY">Cash on Delivery</option>
                <option value="GCASH">GCash</option>
                <option value="CREDIT CARD">Credit Card</option>
            </select>

            <label>Contact Number</label>
            <input type="text" name="contact_number" required>

            <label>Additional Message (Optional)</label>
            <textarea
                name="customer_message"
                placeholder="Enter message here..."
            >   </textarea>

            <br>
            <button type="submit" class="confirm" name="confirm">
                CONFIRM ORDER
            </button><br><br>
            <button class="cancel" name="cancel">
                CANCEL ORDER
            </button>

        </form>

    </div>

</div>

</body>
</html>

<?php include '../includes/order_alerts.php'; ?>
<?php include '../includes/footer.php'; ?>