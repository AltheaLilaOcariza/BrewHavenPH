<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven | Earnings</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="EarningsStyle.css">
</head>
<body>
<div class="dashboard">
    <!-- SIDEBAR - EARNINGS ACTIVE -->
    <div class="sidebar">
        <div class="logo">☕ BrewHaven</div>
        <div class="nav">
            <a href="Dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            <a href="Order.php"><i class="fas fa-clipboard-list"></i><span>Orders</span></a>
            <a href="Deliveries.php"><i class="fas fa-truck"></i><span>Deliveries</span></a>
            <a href="Earnings.php" class="active"><i class="fas fa-dollar-sign"></i><span>Earnings</span></a>
            <a href="Logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
        </div>
    </div>

    <div class="main">
        <div class="page-header">
            <h1>📊 My Earnings Summary</h1>
        </div>

        <!-- SUMMARY CARDS - DATABASE READY -->
        <div class="earnings-summary-grid">
            <div class="summary-card" data-type="total">
                <div class="card-icon"><i class="fas fa-coins"></i></div>
                <div class="card-label">Total Earnings</div>
                <div class="card-amount" data-value="total">₱0.00</div>
                <div class="small-note">All time earnings</div>
            </div>
            <div class="summary-card" data-type="today">
                <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
                <div class="card-label">Today</div>
                <div class="card-amount" data-value="today">₱0.00</div>
                <div class="small-note">Today's deliveries</div>
            </div>
            <div class="summary-card" data-type="week">
                <div class="card-icon"><i class="fas fa-calendar-week"></i></div>
                <div class="card-label">This Week</div>
                <div class="card-amount" data-value="week">₱0.00</div>
                <div class="small-note">Weekly summary</div>
            </div>
            <div class="summary-card" data-type="month">
                <div class="card-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="card-label">This Month</div>
                <div class="card-amount" data-value="month">₱0.00</div>
                <div class="small-note">Monthly summary</div>
            </div>
        </div>

        <!-- EARNINGS BREAKDOWN -->
        <div class="breakdown-panel">
            <div class="section-header">
                <i class="fas fa-list-ul"></i>
                <h2>Earnings Breakdown</h2>
            </div>
            
            <div class="earning-row">
                <div class="earning-label">
                    <div class="badge-dot"></div>
                    <span>Base delivery pay</span>
                </div>
                <div class="earning-amount" data-breakdown="base">₱0.00</div>
            </div>
            
            <div class="earning-row">
                <div class="earning-label">
                    <div class="badge-dot" style="background:#F4A261;"></div>
                    <span>Peak hour bonus</span>
                </div>
                <div class="earning-amount" data-breakdown="peak">₱0.00</div>
            </div>
            
            <div class="earning-row">
                <div class="earning-label">
                    <div class="badge-dot" style="background:#E9C46A;"></div>
                    <span>Customer tips</span>
                </div>
                <div class="earning-amount" data-breakdown="tips">₱0.00</div>
            </div>
            
            <div class="earning-row">
                <div class="earning-label">
                    <div class="badge-dot" style="background:#A7C7B0;"></div>
                    <span>Referral bonus</span>
                </div>
                <div class="earning-amount" data-breakdown="referral">₱0.00</div>
            </div>
            
            <div class="total-row">
                <span><strong>Total Earnings</strong></span>
                <span data-total="grand">₱0.00</span>
            </div>
        </div>
    </div>
</div>

<script src="EarningsJs.js"></script>
</body>
</html>