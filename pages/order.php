<?php 
    $title = "Order | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/order.css'];
    $extra_js = ['../assets/js/order.js'];
    include '../includes/header.php';
?>

<main class="container">
    <?php include '../includes/nav.php'; ?>
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

            <section class="order-item">
                <section class="item-img"></section>

                <section class="item-details">
                    <p class="item-name">Name</p>
                    <p class="item-price">Price</p>
                </section>

                <section class="qty-control">
                    <button class="minus">−</button>
                    <span class="qty">1</span>
                    <button class="plus">+</button>
                </section>
            </section>

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