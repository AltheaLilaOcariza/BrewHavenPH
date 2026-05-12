<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven Orders</title>

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
    display: flex;
    flex-direction: column;
    gap: 30px;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
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

/* ORDERS GRID */
.orders-grid{
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    min-height: 500px;
}

.order-card{
    background:linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
    border-radius:24px;
    padding:30px;
    box-shadow:0 20px 40px rgba(0,0,0,0.12);
    border:2px solid transparent;
    transition:all 0.3s ease;
    position:relative;
    overflow:hidden;
    display:flex;
    flex-direction:column;
}

.order-card:hover{
    transform:translateY(-8px);
    box-shadow:0 30px 60px rgba(0,0,0,0.18);
    border-color:rgba(94,140,74,0.3);
}

.order-card.empty{
    justify-content:center;
    align-items:center;
    text-align:center;
    color:#6B7280;
}

.card-icon{
    width:80px;
    height:80px;
    border-radius:24px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:2rem;
    color:white;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    margin-bottom:20px;
}

.icon-upcoming{ background:linear-gradient(135deg, #3B82F6, #1D4ED8); }
.icon-empty{ background:linear-gradient(135deg, #6B7280, #4B5563); }

.empty-text{
    font-size:1.1rem;
    font-weight:500;
    margin-bottom:8px;
}

/* ACTION BUTTONS */
.action-buttons{
    margin-top:auto;
    padding-top:24px;
    border-top:1px solid #F1F5F9;
}

.btn-primary,
.btn-secondary{
    flex:1;
    padding:14px 24px;
    border:none;
    border-radius:16px;
    font-weight:700;
    font-size:1rem;
    cursor:pointer;
    transition:all 0.3s;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
}

.btn-primary{
    background:linear-gradient(135deg, #5E8C4A, #4A6F3A);
    color:white;
}

.btn-primary:hover,
.btn-primary.accepted{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(94,140,74,0.4);
}

.btn-primary:disabled{
    opacity:0.6;
    cursor:not-allowed;
    transform:none;
}

.btn-secondary{
    background:transparent;
    color:#5E8C4A;
    border:2px solid #5E8C4A;
}

.btn-secondary:hover,
.btn-secondary.canceled{
    background:#5E8C4A;
    color:white;
    transform:translateY(-2px);
}

/* NOTIFICATION */
.notification{
    position:fixed;
    top:20px;
    right:20px;
    padding:16px 24px;
    border-radius:12px;
    font-weight:600;
    transform:translateX(400px);
    transition:all 0.3s ease;
    z-index:1000;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.notification.show{
    transform:translateX(0);
}

.notification.success{
    background:linear-gradient(135deg, #10B981, #059669);
    color:white;
}

.notification.info{
    background:linear-gradient(135deg, #3B82F6, #1D4ED8);
    color:white;
}

/* RESPONSIVE */
@media (max-width: 768px){
    .sidebar{width:80px;padding:30px 12px;}
    .logo{font-size:1.2rem;}
    .nav a{justify-content:center;padding:14px 12px;}
    .nav a span{display:none;}
    .topbar{flex-direction:column;gap:20px;text-align:center;}
    .main{padding:20px 16px;}
    .orders-grid{grid-template-columns:1fr; min-height:auto; gap:20px;}
    .notification{top:10px; right:10px; left:10px; transform:translateY(-100px);}
    .notification.show{transform:translateY(0);}
}
</style>
</head>

<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">☕ BrewHaven</div>
        <div class="nav">
            <a href="Dashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="Orders.php" class="active">
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
            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="topbar">
            <div>
                <h1>Orders</h1>
                <p class="greeting">Manage your incoming orders</p>
            </div>
            <button class="status-toggle online" id="ordersStatusToggle">
                <i class="fas fa-circle" style="font-size:0.7rem;"></i>
                Accepting Orders
            </button>
        </div>

        <!-- ORDERS GRID -->
        <div class="orders-grid">
            <!-- UPCOMING ORDERS CARD -->
            <div class="order-card" id="upcomingOrdersCard">
                <div class="card-icon icon-upcoming">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div style="flex:1; display:flex; align-items:center; justify-content:center; color:#6B7280;">
                    <div>
                        <div style="font-size:1.3rem; font-weight:600; margin-bottom:8px; color:#374151;">No Upcoming Orders</div>
                        <div style="font-size:0.95rem;">Ready when you are</div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="btn-primary" id="readyBtn" style="width:100%;">
                        <i class="fas fa-check-circle"></i>
                        I'm Ready
                    </button>
                </div>
            </div>

            <!-- MESSAGES CARD -->
            <div class="order-card" id="messagesCard">
                <div class="card-icon icon-upcoming">
                    <i class="fas fa-comment"></i>
                </div>
                <div style="flex:1; display:flex; align-items:center; justify-content:center; color:#6B7280;">
                    <div>
                        <div style="font-size:1.3rem; font-weight:600; margin-bottom:8px; color:#374151;">No Messages</div>
                        <div style="font-size:0.95rem;">Customers will message here</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NOTIFICATION -->
<div class="notification" id="notification"></div>

<script>
// NOTIFICATION SYSTEM
function showNotification(message, type = 'info') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = `notification ${type} show`;
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

// STATUS TOGGLE
document.getElementById('ordersStatusToggle').addEventListener('click', function() {
    this.classList.toggle('online');
    const icon = this.querySelector('i');
    
    if (this.classList.contains('online')) {
        this.innerHTML = '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Accepting Orders';
        showNotification('Now accepting orders!', 'success');
    } else {
        this.innerHTML = '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Paused';
        showNotification('Orders paused', 'info');
    }
});

// READY BUTTON
document.getElementById('readyBtn').addEventListener('click', function() {
    this.disabled = true;
    this.classList.add('accepted');
    this.innerHTML = '<i class="fas fa-check"></i> Ready!';
    
    showNotification('Status updated - waiting for orders!', 'success');
    
    // Reset after 3 seconds for demo
    setTimeout(() => {
        this.disabled = false;
        this.classList.remove('accepted');
        this.innerHTML = '<i class="fas fa-check-circle"></i> I\'m Ready';
    }, 3000);
});

// Smooth animations on load
window.addEventListener('load', function() {
    document.querySelector('.main').style.opacity = '0';
    document.querySelector('.main').style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        document.querySelector('.main').style.transition = 'all 0.5s ease';
        document.querySelector('.main').style.opacity = '1';
        document.querySelector('.main').style.transform = 'translateY(0)';
    }, 100);
});
</script>

</body>
</html>