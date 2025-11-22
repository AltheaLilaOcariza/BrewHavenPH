<?php 
    $title = "Order | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/order.css'];
    $extra_js = ['../assets/js/cart.js'];
    include '../includes/header.php';
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
                    <section class="order-item">
                        <section class="item-img" style="background-image:url('.$item['image'].')"></section>

                        <section class="item-details">
                            <p class="item-name">'.$item['name'].'</p>
                            <p class="item-price">₱'.$item['price'].'</p>
                        </section>

                        <section class="qty-control">
                            <button class="minus" data-id="'.$item['id'].'">−</button>
                            <span class="qty">'.$item['qty'].'</span>
                            <button class="plus" data-id="'.$item['id'].'">+</button>
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
            <p class="value">########</p>

            <p class="label">Total Due:</p>
            <p class="value">########</p>

            <button class="confirm">Confirm</button>
            <button class="cancel">Cancel</button>
        </section>
        
    </section>

</main>

<?php include '../includes/footer.php'; ?>