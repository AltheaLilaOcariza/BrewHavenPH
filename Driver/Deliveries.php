<?php
session_start();
$currentDeliveryID = $_SESSION['currentDeliveryID'] ?? null;

if (!isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

require_once '../backend/functions.php';

$deliveryManager = new DeliveriesDAO();

$currentDelivery = null;
$currentOrderID = null;
$status = null;

if ($currentDeliveryID) {
    $currentDelivery = $deliveryManager->getDeliveryByIDNoItems($currentDeliveryID);
}

if ($currentDelivery) {
    $currentOrderID = $currentDelivery['order_id'] ?? null;
    $status = $currentDelivery['delivery_status'] ?? '';
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
                        <div class="delivery-id" id="deliveryId">ORDER ID #<?= $currentOrderID ?? 'No Order Accepted' ?></div>
                        <div class="customer-info">
                            <h3 id="customerName"><?= $currentDelivery['customer_name']?? 'No Data' ?></h3>
                            <div class="customer-address" id="customerAddress">
                                <i class="fas fa-map-marker-alt"></i>
                                <?= $currentDelivery['delivery_location'] ?? '-'?>
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

                            <!-- READY -->
                            <div class="progress-step <?= ($status !== '') ? 'completed' : '' ?>" id="stepReady">
                                <div class="step-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div>Order Ready</div>
                            </div>

                            <div class="progress-line <?= ($status === 'PICKED UP' || $status === 'DELIVERED') ? 'completed' : '' ?>" id="line1"></div>

                            <!-- PICKED UP -->
                            <div class="progress-step <?= ($status === 'PICKED UP' || $status === 'DELIVERED') ? 'active completed' : '' ?>" id="stepPickup">
                                <div class="step-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div>Picked Up</div>
                            </div>

                            <div class="progress-line <?= ($status === 'DELIVERED') ? 'completed' : '' ?>" id="line2"></div>

                            <!-- DELIVERED -->
                            <div class="progress-step <?= ($status === 'DELIVERED') ? 'active completed' : '' ?>" id="stepDelivered">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>Delivered</div>
                            </div>

                        </div>
                    </div>

                    <!-- UPDATE STATUS BUTTONS -->
                    <form action="../backend/mark_delivery_action.php" method="POST">
                        <div class="update-buttons">
                            <button type="submit"
                                    name="btnPickup"
                                    class="btn-update btn-pickup"
                                    <?= ($status != 'READY') ? 'disabled' : '' ?>>
                                Mark as Picked Up
                            </button>

                            <button type="submit"
                                    name="btnDelivered"
                                    class="btn-update btn-delivered"
                                    <?= ($status != 'PICKED UP') ? 'disabled' : '' ?>>
                                Mark as Delivered
                            </button>
                        </div>
                    </form>
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