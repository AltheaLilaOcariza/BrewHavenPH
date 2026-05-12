<?php
// Determine base path for assets and links
$base_path = (strpos($_SERVER['PHP_SELF'], 'pages/') !== false) ? '../' : '';
?>

<nav class="main-nav">
    <div class="left-section">
        <img src="<?php echo $base_path; ?>../assets/img/logo.png" alt="BrewHaven Cafe Logo" class="logo">
        <a href="<?= $base_path ?>dashboard.php"><span class="site-name">BrewHaven Cafe PH</span></a>
        <div class="divider"></div>
    </div>
    
    <div class="right-section">
        <ul class="nav-links">
            <li><a href="<?php echo $base_path; ?>dashboard.php">Dashboard</a></li>
            <li><a href="<?php echo $base_path; ?>manage_menu.php">Manage Menu</a></li>
            <li><a href="<?php echo $base_path; ?>manage_orders.php">Manage Orders</a></li>
            <li><a href="<?php echo $base_path; ?>feedbacks.php">Feedbacks</a></li>
            <li><a href="<?php echo $base_path; ?>logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>

<style>
    .left-section a {
        text-decoration: none;
        color: inherit;
    }
</style>