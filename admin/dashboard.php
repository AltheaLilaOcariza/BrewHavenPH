<?php
session_start();
//we might debug this later, 
// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<?php 
    $title = "Admin Dashboard | BrewHaven Cafe";
    $extra_css = ['../assets/css/includes.css'];
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

    .dashboard-content {
        padding: 40px;
        background: #FAF9F6;
        min-height: 400px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 2px solid #FFD88F;
        text-align: center;
    }

    .stat-card h3 {
        color: #A0522D;
        font-size: 1.1em;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .stat-number {
        font-size: 3em;
        font-weight: bold;
        color: #D04F4F;
        margin: 10px 0;
    }

    .stat-label {
        color: #5a3927;
        font-size: 0.9em;
    }

    .tools-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .tools-section {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: 2px solid #FFD88F;
    }

    .tools-section h3 {
        color: #A0522D;
        margin-bottom: 20px;
        font-size: 1.3em;
        border-bottom: 2px solid #FFD88F;
        padding-bottom: 10px;
    }

    .tool-links {
        list-style: none;
        padding: 0;
    }

    .tool-links li {
        margin-bottom: 12px;
    }

    .tool-links a {
        display: block;
        padding: 12px 15px;
        background: #FAF9F6;
        color: #5a3927;
        text-decoration: none;
        border-radius: 8px;
        border: 1px solid #FFD88F;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .tool-links a:hover {
        background: #FFD88F;
        color: #A0522D;
        transform: translateX(5px);
    }

    .quick-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 15px;
    }

    .action-btn {
        padding: 15px;
        background: linear-gradient(135deg, #D04F4F 0%, #C0392B 100%);
        color: white;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        text-align: center;
        font-weight: bold;
        transition: all 0.3s ease;
        display: block;
    }

    .action-btn:hover {
        background: linear-gradient(135deg, #FFD88F 0%, #F4D03F 100%);
        color: #A0522D;
        transform: translateY(-2px);
    }

    .welcome-message {
        text-align: center;
        margin-bottom: 30px;
        color: #5a3927;
        font-size: 1.1em;
    }
</style>

    <!-- Admin Navigation -->
    <?php include '../includes/admin_nav.php'; ?>

    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <div class="welcome-message">
            Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?>!
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Sales</h3>
                <div class="stat-number">₱0</div>
                <div class="stat-label">Overall Revenue</div>
            </div>
            
            <div class="stat-card">
                <h3>Total Orders</h3>
                <div class="stat-number">0</div>
                <div class="stat-label">All-time Orders</div>
            </div>
            
            <div class="stat-card">
                <h3>Feedback</h3>
                <div class="stat-number">0</div>
                <div class="stat-label">Customer Messages</div>
            </div>
        </div>

        <!-- Admin Tools -->
        <div class="tools-grid">
            <div class="tools-section">
                <h3>Admin Tools</h3>
                <ul class="tool-links">
                    <li><a href="manage_menu.php">Manage Menu</a></li>
                    <li><a href="sales_report.php">Sales Report</a></li>
                    <!-- Removed Manage Users since we're not using user accounts -->
                </ul>
            </div>
            
            <div class="tools-section">
                <h3>Quick Actions</h3>
                <div class="quick-actions">
                    <a href="manage_orders.php" class="action-btn">View Orders</a>
                    <a href="feedbacks.php" class="action-btn">Feedback Viewer</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
