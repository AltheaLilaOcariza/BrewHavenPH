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
            <div class="hero-content">
                <h1>Your Kapihan,<br>Your Haven</h1>
                <p class="hero-tagline">Experience the perfect blend of Filipino<br>hospitality and artisan coffee.</p>
                <p class="hero-description">From traditional brews to local delicacies, we<br>bring you the taste of home.</p>
                
                <div class="cta-buttons">
                    <a href="pages/menu.php" class="cta-button cta-primary">Browse Menu</a>
                    <a href="#" class="cta-button cta-secondary">Login</a>
                    <a href="#" class="cta-button cta-secondary">Register</a>
                </div>
            </div>
            
            <div class="hero-image">
                <!-- We'll use a background image via CSS -->
            </div>
        </div>
    </section>

    <!-- Keep your existing content section -->
    <section class="content-section">
        <div class="content-grid">
            <div class="content-card">
                <h2>About us</h2>
                <p>Learn more about our story and passion for bringing you the best coffee experience.</p>
            </div>
            <div class="content-card">
                <h2>FAQs</h2>
                <p>Find answers to commonly asked questions about our products and services.</p>
            </div>
        </div>
        
        <div class="brand-footer">
            <h2>BREWHAVEN CAFE</h2>
        </div>
    </section>

</div>

<?php include 'includes/footer.php'; ?>
