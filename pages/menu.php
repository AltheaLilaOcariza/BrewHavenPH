<?php 
    $title = "Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/menu.css'];
    $extra_js = ['../assets/js/menu.js']; // add scripts here
    include '../includes/header.php';
?>

<main class="container">
    <?php 
        $logo="../assets/img/logo.png";
        include '../includes/nav.php'; 
    ?>

    <section class="menu-section">
        <h1>Our Menu</h1>
        <p>Explore our selection of artisan coffees and Filipino delicacies.</p>

        <section class="best-seller-section">
    
            <div class="yellow-bg"></div>
    
            <section class="card">
                <h2 class="title">Best Seller!!!</h2>
    
                <div class="image-box">
                    <img src="https://images.pexels.com/photos/27548798/pexels-photo-27548798.jpeg"alt="best seller item">
                </div>
    
                <div class="details-box">
                    <div class="info">
                        <p class="item-name">ITEM NAME</p>
                        <p class="price">PHP 999999</p>
                    </div>
                    <button class="best-seller-order-btn">ORDER</button>
                </div>
            </section>
    
            <section class="description-box" id="desc">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum metus nisi,
                    id ornare turpis mattis ac. Morbi nec mattis augue. Mauris nec luctus sapien.
                </p>
            </section>
        </section>

        <h2 class="carousel-title">Drinks</h2>
        <section class="carousel">
            <button class="prev">&lt;</button>
            
            <section class="carousel-window">
                <section class="carousel-track">
                    <?php 
                      for ($i = 0; $i < 10; $i++) {
                        echo'
                    <section class="carousel-item">
                        <img src="https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg" alt="Drink 1">
                        <div class="item-details">
                            <div class="item-info">
                                <p class="item-name">Espresso</p>
                                <p class="price">PHP 120</p>
                            </div>
                            <div class="order-btn-container">
                                <button class="order-btn">ORDER</button>
                            </div>
                        </div>
                    </section>
                        ';
                      }
                    ?>
                </section>
            </section>
            
            <button class="next">&gt;</button>
        </section>

        <h2 class="carousel-title">Snacks</h2>
        <section class="carousel">
            <button class="prev">&lt;</button>
            
            <section class="carousel-window">
                <section class="carousel-track">
                    <?php 
                      for ($i = 0; $i < 10; $i++) {
                        echo'
                    <section class="carousel-item">
                        <img src="https://images.pexels.com/photos/3028993/pexels-photo-3028993.jpeg" alt="Drink 1">
                        <div class="item-details">
                            <div class="item-info">
                                <p class="item-name">Espresso</p>
                                <p class="price">PHP 120</p>
                            </div>
                            <div class="order-btn-container">
                                <button class="order-btn">ORDER</button>
                            </div>
                        </div>
                    </section>
                        ';
                      }
                    ?>
                </section>
            </section>
            
            <button class="next">&gt;</button>
        </section>

    </section>

    <button class="view-order-btn">View Order</button>

</main>

<?php include '../includes/footer.php'; ?>
