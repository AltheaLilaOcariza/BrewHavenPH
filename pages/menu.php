<?php 
    $title = "Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/menu.css'];
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
        
        </div>
    </section>

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
                <button class="order-btn">ORDER</button>
            </div>
        </section>

        <section class="description-box" id="desc">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam elementum metus nisi,
                id ornare turpis mattis ac. Morbi nec mattis augue. Mauris nec luctus sapien.
            </p>
        </section>

    </section>





</main>

<?php include '../includes/footer.php'; ?>
