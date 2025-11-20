<?php 
    $title = "Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/menu.css'];
    $extra_js = ['../assets/js/menu.js'];
    include '../includes/header.php';
    include '../includes/db_con.php';
?>

<main class="container">
    <?php include '../includes/nav.php'; ?>
    
    <section class="menu-section">
        <h1>Our Menu</h1>
        <p>Explore our selection of artisan coffees and Filipino delicacies.</p>

        <!-- BEST SELLER SECTION -->
        <section class="best-seller-section">
            <div class="yellow-bg"></div>
    
            <div class="card">
                <h2 class="title">Best Seller!!!</h2>
    
                <div class="image-box">
                    <img src="https://images.pexels.com/photos/27548798/pexels-photo-27548798.jpeg" alt="Ube Latte">
                </div>
    
                <div class="details-box">
                    <div class="info">
                        <p class="item-name">Ube Latte</p>
                        <p class="price">PHP 185</p>
                    </div>
                    <button class="best-seller-order-btn"
                            data-name="Ube Latte"
                            data-price="185"
                            data-image="https://images.pexels.com/photos/27548798/pexels-photo-27548798.jpeg">
                        ORDER
                    </button>

                </div>
            </div>
    
            <div class="description-box">
                <p>
                    Our signature Ube Latte combines the rich flavor of purple yam with premium espresso 
                    and steamed milk. Topped with coconut cream and toasted coconut flakes for an authentic 
                    Filipino twist on a classic coffee.
                </p>
            </div>
        </section>

        <!-- DRINKS CAROUSEL -->
        <h2 class="carousel-title">Drinks</h2>
        <div class="carousel-container">
            <div class="carousel">
                <button class="prev" aria-label="Previous items">&lt;</button>
                
                <div class="carousel-window">
                    <div class="carousel-track">
                        <?php
                        $drink_query = $conn->query("SELECT * FROM items WHERE category='Drink' AND is_available=1 ORDER BY name ASC");
                        $drinks = $drink_query->fetch_all(MYSQLI_ASSOC);

                        foreach ($drinks as $drink):
                        ?>
                        <div class="carousel-item">
                            <img src="<?= htmlspecialchars($drink['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($drink['name'], ENT_QUOTES) ?>" loading="lazy">
                            <div class="item-details">
                                <div class="item-info">
                                    <p class="item-name"><?= htmlspecialchars($drink['name'], ENT_QUOTES) ?></p>
                                    <p class="price">PHP <?= htmlspecialchars($drink['price'], ENT_QUOTES) ?></p>
                                </div>
                                <div class="order-btn-container">
                                    <button class="order-btn"
                                            data-name="<?= htmlspecialchars($drink['name'], ENT_QUOTES) ?>"
                                            data-price="<?= htmlspecialchars($drink['price'], ENT_QUOTES) ?>"
                                            data-image="<?= htmlspecialchars($drink['image'], ENT_QUOTES) ?>">
                                        ORDER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <button class="next" aria-label="Next items">&gt;</button>
            </div>
        </div>

        <!-- SNACKS CAROUSEL -->
        <h2 class="carousel-title">Snacks</h2>
        <div class="carousel-container">
            <div class="carousel">
                <button class="prev" aria-label="Previous items">&lt;</button>
                
                <div class="carousel-window">
                    <div class="carousel-track">
                        <?php
                        $snack_query = $conn->query("SELECT * FROM items WHERE category='Snack' AND is_available=1 ORDER BY name ASC");
                        $snacks = $snack_query->fetch_all(MYSQLI_ASSOC);

                        foreach ($snacks as $snack):
                        ?>
                        <div class="carousel-item">
                            <img src="<?= htmlspecialchars($snack['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($snack['name'], ENT_QUOTES) ?>" loading="lazy">
                            <div class="item-details">
                                <div class="item-info">
                                    <p class="item-name"><?= htmlspecialchars($snack['name'], ENT_QUOTES) ?></p>
                                    <p class="price">PHP <?= htmlspecialchars($snack['price'], ENT_QUOTES) ?></p>
                                </div>
                                <div class="order-btn-container">
                                    <button class="order-btn"
                                            data-name="<?= htmlspecialchars($snack['name'], ENT_QUOTES) ?>"
                                            data-price="<?= htmlspecialchars($snack['price'], ENT_QUOTES) ?>"
                                            data-image="<?= htmlspecialchars($snack['image'], ENT_QUOTES) ?>">
                                        ORDER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <button class="next" aria-label="Next items">&gt;</button>
            </div>
        </div>

        <a href="order.php"><button class="view-order-btn">View Order</button></a>
    </section>

</main>
<!-- Manual script inclusion at the bottom -->
<script src="../assets/js/menu.js"></script>
<?php include '../includes/footer.php'; ?>
