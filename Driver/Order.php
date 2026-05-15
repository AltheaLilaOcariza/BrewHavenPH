<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}
require_once '../backend/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven Orders | Vertical Flow</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="OrderStyle.css">
</head>

<body>
<div class="dashboard">
    <div class="sidebar">
        <div class="logo">☕ BrewHaven</div>
        <div class="nav">
            <a href="Dashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="Order.php" class="active">
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

    <div class="main">
        <div class="topbar">
            <div>
                <h1>Orders</h1>
                <p class="greeting">Simple order workflow — one at a time</p>
            </div>
            <button class="status-toggle online" id="statusToggle">
                <i class="fas fa-circle" style="font-size:0.7rem;"></i> Accepting Orders
            </button>
        </div>

        <div class="orders-container">
            <div class="section-header">
                <h2><i class="fas fa-mug-hot"></i> Active Order</h2>
                <div class="badge-counter" id="queueBadge">Queue: 0</div>
            </div>

            <div id="orderContainer">
                <!-- Dynamic order data from database will be injected here -->
            </div>
        </div>
    </div>
</div>

<div id="notification" class="notification"></div>

<script src="OrderJs.js"></script>
</body>
</html>