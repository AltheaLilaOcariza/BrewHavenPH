<?php
session_start();
$currentDeliveryID = $_SESSION['currentDeliveryID'];

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
<title>BrewHaven Deliveries - Driver Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="DeliveriesStyle.css">
</head>

<body>
<div class="dashboard">
    <!-- SIDEBAR NAVIGATION -->
    <div class="sidebar">
        <div class="logo">☕ BrewHaven</div>
        <div class="nav">
            <a href="Dashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="Order.php">
                <i class="fas fa-clipboard-list"></i>
                <span>Orders</span>
            </a>
            <a href="Deliveries.php" class="active">
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
                    <h1>My Deliveries</h1>
                    <p class="greeting">Active deliveries & tracking</p>
                </div>
                <button class="status-toggle online" id="statusToggle">
                    <i class="fas fa-circle" style="font-size:0.7rem;"></i>
                    Online
                </button>
            </div>

            <!-- DELIVERIES CONTAINER -->
            <div class="deliveries-container" id="deliveriesContainer">
                <!-- ACTIVE DELIVERY CARD -->
                <div class="active-delivery" id="activeDeliveryCard">
                    <div class="delivery-header">
                        <div class="delivery-id" id="deliveryId">ORDER ID</div>
                        <div class="customer-info">
                            <h3 id="customerName">Customer Name</h3>
                            <div class="customer-address" id="customerAddress">
                                <i class="fas fa-map-marker-alt"></i>
                                Address • Distance
                            </div>
                        </div>
                    </div>

                    <!-- TRACKING PROGRESS -->
                    <div class="tracking-container">
                        <div class="tracking-title">
                            <i class="fas fa-route"></i>
                            Delivery Progress
                        </div>
                        <div class="progress-track">
                            <div class="progress-step" id="stepReady">
                                <div class="step-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div>Order Ready</div>
                            </div>
                            <div class="progress-line" id="line1"></div>
                            <div class="progress-step" id="stepPickup">
                                <div class="step-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div>Picked Up</div>
                            </div>
                            <div class="progress-line" id="line2"></div>
                            <div class="progress-step" id="stepDelivered">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>Delivered</div>
                            </div>
                        </div>
                    </div>

                    <!-- ORDER ITEMS -->
                    <div class="items-list" id="orderItems">
                        <div class="item-row">
                            <span class="item-name" id="item1Name">Item Name</span>
                            <span class="item-price" id="item1Price">₱0.00</span>
                        </div>
                        <div class="item-row">
                            <span class="item-name" id="item2Name">Item Name</span>
                            <span class="item-price" id="item2Price">₱0.00</span>
                        </div>
                        <div style="margin-top:16px; padding-top:16px; border-top:2px solid #E5E7EB;">
                            <div style="display:flex; justify-content:space-between; font-weight:700; font-size:1.1rem;" id="totalAmount">
                                <span>Total</span>
                                <span>₱0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- UPDATE STATUS BUTTONS -->
                    <div class="update-buttons">
                        <button class="btn-update btn-pickup" id="btnPickup">
                            <i class="fas fa-shopping-bag"></i>
                            Mark as Picked Up
                        </button>
                        <button class="btn-update btn-delivered" id="btnDelivered" disabled>
                            <i class="fas fa-check"></i>
                            Mark as Delivered
                        </button>
                    </div>
                </div>

                <!-- NO ACTIVE DELIVERY -->
                <div class="no-active" id="noActiveDelivery" style="display:none;">
                    <i class="fas fa-truck"></i>
                    <h3>No Active Deliveries</h3>
                    <p>You're ready for new orders when online</p>
                </div>

                <!-- COMPLETED DELIVERIES -->
                <div class="completed-section">
                    <h2 class="completed-title">Recent Completed</h2>
                    <div class="history-item" id="historyItem1">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                            <span id="historyId1">ORDER ID</span>
                            <span id="historyTime1">Time</span>
                        </div>
                        <div id="historyCustomer1">Customer</div>
                        <div style="color:#10B981; font-weight:600; margin-top:8px;" id="historyEarnings1">₱0.00 earned</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="DeliveriesJs.js"></script>
</body>
</html>