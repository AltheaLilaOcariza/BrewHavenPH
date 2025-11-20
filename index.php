<?php 
    $title = "Home | BrewHaven Cafe PH";
    $extra_css = ['assets/css/includes.css'];
    include 'includes/header.php';
?>

<div class="container">
    <?php include 'includes/nav.php'; ?>

    <!-- Hero Section with Image -->
    <section class="hero-section-with-image">
        <div class="hero-overlay"></div>
        <div class="hero-container">
            
            <!-- LEFT HERO CONTENT -->
            <div class="hero-content">
                <h1>Your Kapihan,<br>Your Haven</h1>
                <p class="hero-tagline">Experience the perfect blend of Filipino<br>hospitality and artisan coffee.</p>
                <p class="hero-description">From traditional brews to local delicacies, we<br>bring you the taste of home.</p>
                
                <div class="cta-buttons">
                    <a href="pages/menu.php" class="cta-button cta-primary">Browse Menu</a>
                </div>
            </div>

            <!-- RIGHT HERO IMAGE (FIX ADDED) -->
            <div class="hero-image">
                <div class="image-glow"></div>
            </div>

        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="brand-footer">
            <h2>WELCOME TO BREWHAVEN CAFE</h2>
        </div>
    </section>

</div>

<?php include 'includes/footer.php'; ?>
