
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

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:#F5E9D3;
    color:#1e293b;
}

.dashboard{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:260px;
    background:linear-gradient(145deg, #5E8C4A 0%, #4A6F3A 100%);
    color:white;
    padding:30px 20px;
    box-shadow: 4px 0 20px rgba(94,140,74,0.3);
    transition:all 0.3s ease;
}

.logo{
    font-size:1.8rem;
    font-weight:700;
    margin-bottom:40px;
    background:linear-gradient(135deg, #FFD88F, #FFCB7D);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
}

.nav{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.nav a{
    text-decoration:none;
    color:rgba(255,255,255,0.9);
    padding:14px 16px;
    border-radius:14px;
    transition:all 0.3s ease;
    font-weight:500;
    display:flex;
    align-items:center;
    gap:12px;
    cursor:pointer;
    position:relative;
    overflow:hidden;
}

.nav a::before{
    content:'';
    position:absolute;
    top:0;
    left:-100%;
    width:100%;
    height:100%;
    background:linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition:left 0.5s;
}

.nav a:hover::before{
    left:100%;
}

.nav a:hover,
.nav a.active{
    background:#FFD88F;
    color:#1e293b;
    transform:translateX(6px);
    box-shadow:0 4px 15px rgba(255,216,143,0.4);
}

/* MAIN CONTENT */
.main{
    flex:1;
    padding:30px;
    overflow-y:auto;
    position:relative;
}

/* PAGE TRANSITION */
.page-content{
    opacity:1;
    transform:translateX(0);
    transition:all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.page-content.hidden{
    opacity:0;
    transform:translateX(20px);
    pointer-events:none;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    flex-wrap:wrap;
    gap:16px;
}

.topbar h1{
    font-size:2.2rem;
    font-weight:700;
    background:linear-gradient(135deg, #5E8C4A, #4A6F3A);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
}

.greeting{
    font-size:1.1rem;
    color:#6B7280;
    font-weight:500;
}

/* STATUS BUTTON */
.status-toggle{
    background: transparent;
    border: 2px solid #A8C66C;
    color: #2f4f2f;
    padding: 12px 22px;
    border-radius: 999px;
    font-size: 0.95rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.status-toggle.online{
    border-color: #10B981;
    background:linear-gradient(135deg, rgba(16,185,129,0.1), rgba(16,185,129,0.05));
}

/* STATS GRID */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));
    gap:24px;
}

.stat-card{
    background:linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
    border-radius:24px;
    padding:28px;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
    border:2px solid transparent;
    transition:all 0.3s ease;
    position:relative;
    overflow:hidden;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:0 25px 50px rgba(0,0,0,0.15);
    border-color:rgba(94,140,74,0.2);
}

.stat-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:16px;
}

.stat-icon{
    width:56px;
    height:56px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.5rem;
    color:white;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
}

.icon-orders{ background:linear-gradient(135deg, #3B82F6, #1D4ED8); }
.icon-deliveries{ background:linear-gradient(135deg, #F59E0B, #D97706); }
.icon-completed{ background:linear-gradient(135deg, #10B981, #059669); }
.icon-canceled{ background:linear-gradient(135deg, #EF4444, #DC2626); }

.stat-title{
    font-size:0.9rem;
    font-weight:600;
    color:#64748B;
    text-transform:uppercase;
    letter-spacing:0.5px;
}

.stat-number{
    font-size:3rem;
    font-weight:800;
    background:linear-gradient(135deg, #1E293B, #334155);
    -webkit-background-clip:text;
    background-clip:text;
    line-height:1;
    margin-bottom:8px;
}

.stat-description{
    color:#6B7280;
    font-size:0.95rem;
    line-height:1.4;
    margin-top:8px;
}

/* RESPONSIVE */
@media (max-width: 768px){
    .sidebar{width:80px;padding:30px 12px;}
    .logo{font-size:1.2rem;}
    .nav a{justify-content:center;padding:14px 12px;}
    .nav a span{display:none;}
    .topbar{flex-direction:column;gap:20px;text-align:center;}
    .stats-grid{grid-template-columns:1fr;}
    .main{padding:20px 16px;}
}
</style>
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

        <!-- DASHBOARD PAGE -->
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

            <!-- STATS GRID -->
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

<script>
// SIMPLE STATUS TOGGLE
document.getElementById('statusToggle')?.addEventListener('click', function() {
    this.classList.toggle('online');
    const isOnline = this.classList.contains('online');
    this.innerHTML = isOnline 
        ? '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Online'
        : '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Offline';
});

console.log('☕ BrewHaven Driver Dashboard Ready!');
console.log('🔄 Status toggle working');
console.log('📱 Navigation links ready for PHP pages');
</script>

</body>
</html>