//Placeholders only... needed syag backend
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<?php 
    $title = "Sales Report | BrewHaven Cafe";
    $extra_css = ['../assets/css/includes.css'];
    $extra_js = [
        'https://cdn.jsdelivr.net/npm/chart.js',
        '../assets/js/sales_chart.js'
    ];
    include '../includes/header.php';
?>

<style>
    .admin-header {
        background: linear-gradient(135deg, #FAF9F6 0%, #FFD88F 100%);
        padding: 40px;
        text-align: center;
        border-bottom: 3px solid #A0522D;
        position: relative;
    }

    .admin-title {
        color: #A0522D;
        font-size: 2.5em;
        margin-bottom: 10px;
    }

    .admin-subtitle {
        color: #5a3927;
        font-size: 1.2em;
    }

    .sales-content {
        padding: 40px;
        background: #FAF9F6;
        min-height: 400px;
    }

    .sales-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-top: 30px;
    }

    .top-products {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 2px solid #FFD88F;
    }

    .top-products h3 {
        color: #A0522D;
        margin-bottom: 20px;
        font-size: 1.3em;
        border-bottom: 2px solid #FFD88F;
        padding-bottom: 10px;
    }

    .product-list {
        list-style: none;
        padding: 0;
    }

    .product-list li {
        padding: 12px 15px;
        margin-bottom: 8px;
        background: #FAF9F6;
        border-radius: 8px;
        border: 1px solid #FFD88F;
        color: #5a3927;
        font-weight: 500;
    }

    .chart-container {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 2px solid #FFD88F;
        height: 400px;
    }

    .chart-container h3 {
        color: #A0522D;
        margin-bottom: 20px;
        font-size: 1.3em;
        border-bottom: 2px solid #FFD88F;
        padding-bottom: 10px;
        text-align: center;
    }

    .stats-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 2px solid #FFD88F;
        text-align: center;
    }

    .stat-card h4 {
        color: #A0522D;
        margin-bottom: 10px;
        font-size: 1em;
    }

    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #D04F4F;
    }

    @media (max-width: 968px) {
        .sales-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-summary {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container">
    <!-- Admin Header -->
    <div class="admin-header">
        <h1 class="admin-title">Sales Report</h1>
        <p class="admin-subtitle">BrewHaven Cafe Sales Analytics</p>
    </div>

    <!-- Admin Navigation -->
    <?php include '../includes/admin_nav.php'; ?>

    <!-- Sales Content -->
    <div class="sales-content">
        <!-- Stats Summary -->
        <div class="stats-summary">
            <div class="stat-card">
                <h4>Total Revenue</h4>
                <div class="stat-number">₱12,450</div>
            </div>
            <div class="stat-card">
                <h4>Total Orders</h4>
                <div class="stat-number">89</div>
            </div>
            <div class="stat-card">
                <h4>Avg. Order Value</h4>
                <div class="stat-number">₱140</div>
            </div>
        </div>

        <!-- Sales Grid -->
        <div class="sales-grid">
            <!-- Top Products List -->
            <div class="top-products">
                <h3>Top Selling Items</h3>
                <ul class="product-list">
                    <li>Ube Latte</li>
                    <li>Espresso</li>
                    <li>Cappuccino</li>
                    <li>Biko</li>
                    <li>Cassava Cake</li>
                    <li>Matcha Latte</li>
                </ul>
            </div>

            <!-- Chart Container -->
            <div class="chart-container">
                <h3>Sales Performance</h3>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
