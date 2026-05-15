<?php
session_start();
require_once "../backend/functions.php";

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

$driver_id = $_SESSION['driver_id'];

$deliveryManager = new DeliveriesDAO();
$total_orders = $deliveryManager->getTotalDeliveriesAssigned($driver_id);
$total_pending = $deliveryManager ->getDeliveryCountByStatus();
$total_delivered = $deliveryManager ->getTotalDeliveriesDelivered($driver_id);
$total_failed = $deliveryManager -> getDeliveryCountByStatus("FAILED");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven Driver Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- CSS FILE -->
<link rel="stylesheet" href="DashboardStyle.css">
</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR NAVIGATION -->
    <div class="sidebar">
        <div class="logo">☕ BrewHaven</div>
        <div class="nav">
            <a href="Dashboard.php" class="active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="Order.php">
                <i class="fas fa-clipboard-list"></i>
                <span>Orders</span>
            </a>
            <a href="Deliveries.php">
                <i class="fas fa-truck"></i>
                <span>Deliveries</span>
            </a>
            <a href="Earnings.php">
                <i class="fas fa-dollar-sign"></i>
                <span>Earnings</span>
            </a>
            <a href="Logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <div class="page-content">
            <div class="topbar">
                <div>
                    <h1>Driver Dashboard</h1>
                    <p class="greeting">Live stats • Ready to connect</p>
                </div>

                <button class="status-toggle online" id="statusToggle">
                    <i class="fas fa-circle" style="font-size:0.7rem;"></i>
                    Online
                </button>
            </div>

            <div class="stats-grid">

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Orders</div>
                        <div class="stat-icon icon-orders">
                            <i class="fas fa-mug-hot"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="totalOrders"><?= $total_orders ?></div>
                    <div class="stat-description">Total orders assigned</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Pending Deliveries</div>
                        <div class="stat-icon icon-deliveries">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="readyDeliveries"><?= $total_pending ?></div>
                    <div class="stat-description">Awaiting pickup</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Completed</div>
                        <div class="stat-icon icon-completed">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="failedDeliveries"><?= $total_delivered ?></div>
                    <div class="stat-description">Successfully Delivered</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Failed</div>
                        <div class="stat-icon icon-cance
                        led">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="failedDeliveries"><?= $total_failed ?></div>
                    <div class="stat-description">Failed to Deliver</div>
                </div>

            </div>

            <!-- GPS MAP SECTION -->
            <div class="map-section">
                <div class="map-header">
                    <h3><i class="fas fa-map-marker-alt"></i> Live GPS Location</h3>
                    <p>Current location and delivery area</p>
                </div>
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d251172.89328295644!2d123.5364284039915!3d10.375710136211605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a999258dcd2dfd%3A0x4c34030cdbd33507!2sCebu%20City%2C%20Cebu!5e0!3m2!1sen!2sph!4v1778849876032!5m2!1sen!2sph" 
                        width="100%" 
                        height="400" 
                        style="border:0; border-radius: 12px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- JS FILE -->
<script src="DashboardJs.js"></script>

</body>
</html>