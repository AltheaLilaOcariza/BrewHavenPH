<?php
// Determine base path for assets and links
$base_path = (strpos($_SERVER['PHP_SELF'], 'pages/') !== false) ? '../' : '';
?>

<nav class="main-nav">
    <div class="left-section">
        <img src="<?php echo $base_path; ?>assets/img/logo.png" alt="BrewHaven Cafe Logo" class="logo">
        <a href="<?= $base_path ?>index.php"><span class="site-name">BrewHaven Cafe PH</span></a>
        <div class="divider"></div>
    </div>
    
    <div class="right-section">
        <ul class="nav-links">
            <li><a href="<?php echo $base_path; ?>index.php">Home</a></li>
            <li><a href="<?php echo $base_path; ?>pages/menu.php">Menu</a></li>
            <li><a href="<?php echo $base_path; ?>pages/deliveryStatus.php">Delivery Status</a></li>
            <li><a href="<?php echo $base_path; ?>pages/contact.php">Contacts</a></li>
            <li><a href="<?php echo $base_path; ?>pages/about.php">About us</a></li>
            <li><a href="<?php echo $base_path; ?>pages/faq.php">FAQs</a></li>
        </ul>
    </div>   
</nav>


<style>
    .left-section a {
        text-decoration: none;
        color: inherit;
    }
</style>
