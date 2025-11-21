<?php
// Determine base path for assets and links
$base_path = (strpos($_SERVER['PHP_SELF'], 'pages/') !== false) ? '../' : '';
?>

<nav class="main-nav">
    <div class="left-section">
        <img src="<?php echo $base_path; ?>../assets/img/logo.png" alt="BrewHaven Cafe Logo" class="logo">
        <span class="site-name">BrewHaven Cafe PH</span>
        <div class="divider"></div>
    </div>

    <div class="right-section">
        <ul class="nav-links">
            <li><a href="<?php echo $base_path; ?>admin/dashboard.php">Dashboard</a></li>
            <li><a href="<?php echo $base_path; ?>admin/manage_menu.php">Manage Menu</a></li>
            <li><a href="<?php echo $base_path; ?>admin/manage_orders.php">Manage Orders</a></li>
            <li><a href="<?php echo $base_path; ?>admin/feedbacks.php">Feedbacks</a></li>
            <li><a href="<?php echo $base_path; ?>admin/logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>