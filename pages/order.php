<?php 
    $title = "Order | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/order.css'];
    $extra_js = ['../assets/js/cart.js'];
    include '../includes/header.php';
    require '../backend/functions.php';

    $manager = new OrderDAO();
    $orderID = $manager->getLastOrderId();
    $orderID += 1;
?>

<main class="container">
    <?php include '../includes/nav.php';?>
    <section class="order-section">
        <div class="back-to-menu">
            <a href="menu.php">
                <p class="back-arrow"><</p>
                <p>Back to Menu</p>
            </a>
        </div>

        <section class="order-container">

            <!-- LEFT COLUMN -->
            <section class="orders-left">
                <h2>Your Orders</h2>

                <?php
                session_start();

                if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                    echo "<p class='empty-msg'>Your cart is empty.</p>";
                } else {
                    foreach ($_SESSION['cart'] as $item) {
                        echo '
                        <section class="order-item" id="item-'.$item['item_id'].'">
                            <section class="item-img" style="background-image:url('.$item['image'].')"></section>

                            <section class="item-details">
                                <p class="item-name">'.$item['name'].'</p>
                                <p class="item-price">₱'.$item['price'].'</p>
                                <p class="item-subtotal">Subtotal: ₱'.($item['price'] * $item['qty']).'</p>
                            </section>

                            <section class="qty-control">
                                <button type="button" class="minus" data-id="'.$item['item_id'].'">−</button>
                                <span class="qty">'.$item['qty'].'</span>
                                <button type="button" class="plus" data-id="'.$item['item_id'].'">+</button>
                            </section>
                        </section>
                        ';
                    }
                }
                ?>
            </section>

            <!-- RIGHT COLUMN -->
            <section class="orders-right">
                <p class="label">Order No:</p>
                <p class="value order-no"><?= $orderID ?></p>

                <?php
                // --- compute a clean numeric total (defensive: remove currency chars, commas, etc.)
                $total = 0.0;
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

                // For display (nice formatting). Use 2 decimals (change if you want integers)
                $displayTotal = number_format($total, 2);
                ?>
        
                <p class="label">Total Due:</p>
                <p class="value total-due">₱<?= $total ?></p>

                <form action="../backend/order_manager.php" method="POST">
                    <input type="hidden" name="total_amount" value="<?= $total ?>">

                    <?php if (!empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <input type="hidden" name="items[<?= $item['item_id'] ?>][item_id]" value="<?= $item['item_id'] ?>">
                            <input type="hidden" name="items[<?= $item['item_id'] ?>][quantity]" value="<?= $item['qty'] ?>">
                            <input type="hidden" name="items[<?= $item['item_id'] ?>][price_each]" value="<?= $item['price'] ?>">
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <button type="submit" class="confirm" name="confirm">Confirm</button>
                    <button class="cancel" name="cancel" >Cancel</button>
                </form>

            </section>

        </section>
    </section>
</main>

<?php include '../includes/order_alerts.php'; ?>
<?php include '../includes/footer.php'; ?>