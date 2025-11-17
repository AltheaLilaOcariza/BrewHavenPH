<?php 
    $title = "Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/menu.css'];
    $extra_js = ['../assets/js/menu.js'];
    include '../includes/header.php';
?>

<div class="container">
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
                    <button class="best-seller-order-btn">ORDER</button>
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
                        $drinks = [
                            ['name' => 'Espresso', 'price' => 120, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Americano', 'price' => 130, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Cappuccino', 'price' => 150, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Latte', 'price' => 160, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Mocha', 'price' => 170, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Cold Brew', 'price' => 140, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Iced Coffee', 'price' => 135, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Matcha Latte', 'price' => 165, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Hot Chocolate', 'price' => 145, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Chai Tea', 'price' => 155, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg']
                        ];
                        
                        foreach ($drinks as $drink) {
                            echo '
                        <div class="carousel-item">
                            <img src="' . $drink['image'] . '" alt="' . htmlspecialchars($drink['name']) . '" loading="lazy">
                            <div class="item-details">
                                <div class="item-info">
                                    <p class="item-name">' . htmlspecialchars($drink['name']) . '</p>
                                    <p class="price">PHP ' . htmlspecialchars($drink['price']) . '</p>
                                </div>
                                <div class="order-btn-container">
                                    <button class="order-btn">ORDER</button>
                                </div>
                            </div>
                        </div>';
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
                        $snacks = [
                            ['name' => 'Biko', 'price' => 95, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Cassava Cake', 'price' => 110, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Ensaymada', 'price' => 65, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Pan de Coco', 'price' => 55, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Crinkles', 'price' => 80, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Banana Bread', 'price' => 85, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg'],
                            ['name' => 'Pain au chocolat', 'price' => 85, 'image' => 'https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg']
                        ];
                        
                        foreach ($snacks as $snack) {
                            echo '
                        <div class="carousel-item">
                            <img src="' . $snack['image'] . '" alt="' . htmlspecialchars($snack['name']) . '" loading="lazy">
                            <div class="item-details">
                                <div class="item-info">
                                    <p class="item-name">' . htmlspecialchars($snack['name']) . '</p>
                                    <p class="price">PHP ' . htmlspecialchars($snack['price']) . '</p>
                                </div>
                                <div class="order-btn-container">
                                    <button class="order-btn">ORDER</button>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>
                    </div>
                </div>
                
                <button class="next" aria-label="Next items">&gt;</button>
            </div>
        </div>

    </section>

    <button class="view-order-btn">View Order</button>

</div>

<!-- MANUALLY INCLUDE THE JAVASCRIPT FILE -->
<script src="../assets/js/menu.js"></script>

<?php include '../includes/footer.php'; ?>
