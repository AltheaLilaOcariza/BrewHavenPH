<?php
// Determine base path for assets and links
$base_path = (strpos($_SERVER['PHP_SELF'], 'pages/') !== false) ? '../' : '';
?>

<nav class="main-nav">
    <div class="left-section">
        <img src="<?php echo $base_path; ?>assets/img/logo.png" alt="BrewHaven Cafe Logo" class="logo">
        <span class="site-name">BrewHaven Cafe PH</span>
        <div class="divider"></div>
    </div>

    <div class="right-section">
        <ul class="nav-links">
            <li><a href="<?php echo $base_path; ?>index.php">Home</a></li>
            <li><a href="<?php echo $base_path; ?>pages/menu.php">Menu</a></li>
            <li><a href="<?php echo $base_path; ?>pages/contact.php">Contacts</a></li>
            <li><a href="<?php echo $base_path; ?>pages/about.html">About us</a></li>
            <li><a href="<?php echo $base_path; ?>pages/faq.html">FAQs</a></li>
        </ul>
    </div>
</nav>
