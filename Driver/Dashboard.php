<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}
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
                    <div class="stat-number" id="totalOrders">-</div>
                    <div class="stat-description">Total orders assigned</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Pending Deliveries</div>
                        <div class="stat-icon icon-deliveries">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="pendingDeliveries">-</div>
                    <div class="stat-description">Awaiting pickup</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Completed</div>
                        <div class="stat-icon icon-completed">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="completedDeliveries">-</div>
                    <div class="stat-description">Successfully delivered</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Canceled</div>
                        <div class="stat-icon icon-canceled">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="canceledOrders">-</div>
                    <div class="stat-description">Customer/store canceled</div>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- JS FILE -->
<script src="DashboardJs.js"></script>

</body>
</html>