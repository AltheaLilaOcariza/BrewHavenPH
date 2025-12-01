<?php 
    $title = "Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/menu.css'];
    $extra_js = ['../assets/js/menu.js'];
    include '../includes/header.php';
    require '../backend/functions.php';

    $item = new Item();
    $best_seller = $item->getBestSeller();
    $drinks_list = $item->getAllDrinks();
    $snacks_list = $item->getAllSnacks();
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
                    <img src="<?= $best_seller[0]['image'] ?>" alt="<?= $best_seller[0]['name'] ?>">
                </div>
    
                <div class="details-box">
                    <div class="info">
                        <p class="item-name"><?= $best_seller[0]['name'] ?></p>
                        <p class="price">PHP <?= $best_seller[0]['price'] ?></p>
                    </div>
                    <button class="best-seller-order-btn"
                            data-id="<?= $best_seller[0]['item_id'] ?>"
                            data-name="<?= $best_seller[0]['name'] ?>"
                            data-price="<?= $best_seller[0]['price'] ?>"
                            data-image="<?= $best_seller[0]['image'] ?>">
                        ORDER
                    </button>

                </div>
            </div>
    
            <div class="description-box">
                <p>
                    <?= $best_seller[0]['description'] ?>
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
                        foreach ($drinks_list as $drink){
                        ?>
                        <div class="carousel-item">
                            <img src="<?= $drink['image'] ?>" loading="lazy">
                            <div class="item-details">
                                <div class="item-info">
                                    <p class="item-name"><?= $drink['name'] ?></p>
                                    <p class="price">PHP <?= $drink['price'] ?></p>
                                </div>
                                <div class="order-btn-container">
                                    <button class="order-btn"
                                            data-id="<?= htmlspecialchars($drink['item_id'], ENT_QUOTES) ?>"
                                            data-name="<?= htmlspecialchars($drink['name'], ENT_QUOTES) ?>"
                                            data-price="<?= htmlspecialchars($drink['price'], ENT_QUOTES) ?>"
                                            data-image="<?= htmlspecialchars($drink['image'], ENT_QUOTES) ?>">
                                        ORDER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php 
                        } 
                        ?>

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
                        foreach ($snacks_list as $snack){
                        ?>
                        <div class="carousel-item">
                            <img src="<?= $snack['image'] ?>" loading="lazy">
                            <div class="item-details">
                                <div class="item-info">
                                    <p class="item-name"><?= $snack['name'] ?></p>
                                    <p class="price">PHP <?= $snack['price'] ?></p>
                                </div>
                                <div class="order-btn-container">
                                    <button class="order-btn"
                                            data-id="<?= htmlspecialchars($snack['item_id'], ENT_QUOTES) ?>"
                                            data-name="<?= htmlspecialchars($snack['name'], ENT_QUOTES) ?>"
                                            data-price="<?= htmlspecialchars($snack['price'], ENT_QUOTES) ?>"
                                            data-image="<?= htmlspecialchars($snack['image'], ENT_QUOTES) ?>">
                                        ORDER
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                </div>
                
                <button class="next" aria-label="Next items">&gt;</button>
            </div>
        </div>

        <a href="order.php"><button class="view-order-btn">View Order</button></a>
    </section>

</main>
<!-- Manual script inclusion at the bottom -->
<!--<script src="../assets/js/order_button.js"></script> -->
<script src="../assets/js/menu.js"></script>
<?php include '../includes/footer.php'; ?>
