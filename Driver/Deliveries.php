<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven Deliveries - Driver Dashboard</title>

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

/* DELIVERIES CONTAINER */
.deliveries-container{
    display:grid;
    gap:24px;
}

/* ACTIVE DELIVERY CARD */
.active-delivery{
    background:linear-gradient(145deg, #FFFFFF 0%, #FEFCF3 100%);
    border:3px solid #FFD88F;
    border-radius:24px;
    padding:32px;
    box-shadow:0 20px 40px rgba(255,216,143,0.25);
    position:relative;
    overflow:hidden;
}

.active-delivery::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:4px;
    background:linear-gradient(90deg, #F59E0B, #FFD88F, #F59E0B);
}

.delivery-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:24px;
    flex-wrap:wrap;
    gap:16px;
}

.delivery-id{
    background:linear-gradient(135deg, #F59E0B, #D97706);
    color:white;
    padding:8px 16px;
    border-radius:12px;
    font-weight:700;
    font-size:0.9rem;
}

.customer-info h3{
    font-size:1.4rem;
    font-weight:700;
    color:#1e293b;
    margin-bottom:4px;
}

.customer-address{
    color:#6B7280;
    font-size:0.95rem;
    display:flex;
    align-items:center;
    gap:6px;
}

/* TRACKING PROGRESS */
.tracking-container{
    margin:32px 0;
}

.tracking-title{
    font-size:1.1rem;
    font-weight:600;
    color:#374151;
    margin-bottom:20px;
    display:flex;
    align-items:center;
    gap:8px;
}

.progress-track{
    display:flex;
    align-items:center;
    gap:20px;
    position:relative;
}

.progress-step{
    flex:1;
    text-align:center;
    position:relative;
}

.progress-step.active .step-icon,
.progress-step.completed .step-icon{
    background:linear-gradient(135deg, #10B981, #059669);
    color:white;
}

.progress-step.pending .step-icon{
    background:#F3F4F6;
    color:#9CA3AF;
}

.step-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.3rem;
    margin:0 auto 12px;
    box-shadow:0 4px 16px rgba(0,0,0,0.1);
    transition:all 0.3s ease;
}

.progress-line{
    height:4px;
    background:#E5E7EB;
    flex:1;
    border-radius:2px;
    position:relative;
}

.progress-line.completed{
    background:linear-gradient(90deg, #10B981, #059669);
}

/* UPDATE BUTTONS */
.update-buttons{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
    margin-top:28px;
}

.btn-update{
    padding:12px 24px;
    border-radius:12px;
    font-weight:600;
    font-size:0.95rem;
    cursor:pointer;
    transition:all 0.3s ease;
    border:none;
    display:flex;
    align-items:center;
    gap:8px;
}

.btn-pickup{
    background:linear-gradient(135deg, #3B82F6, #1D4ED8);
    color:white;
}

.btn-delivered{
    background:linear-gradient(135deg, #10B981, #059669);
    color:white;
}

.btn-update:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 25px rgba(0,0,0,0.2);
}

.btn-update:disabled{
    opacity:0.5;
    cursor:not-allowed;
    transform:none !important;
}

/* DELIVERY ITEMS */
.items-list{
    background:#F8FAFC;
    border-radius:16px;
    padding:20px;
    margin:24px 0;
}

.item-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 0;
    border-bottom:1px solid #E5E7EB;
}

.item-row:last-child{
    border-bottom:none;
}

.item-name{
    font-weight:500;
    color:#1e293b;
}

.item-price{
    font-weight:600;
    color:#5E8C4A;
}

/* NO ACTIVE DELIVERY */
.no-active{
    text-align:center;
    padding:60px 40px;
    background:linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
    border-radius:24px;
    border:2px dashed #D1D5DB;
    color:#6B7280;
}

.no-active i{
    font-size:4rem;
    margin-bottom:20px;
    opacity:0.5;
}

/* COMPLETED DELIVERIES */
.completed-section{
    margin-top:40px;
}

.completed-title{
    font-size:1.3rem;
    font-weight:700;
    color:#374151;
    margin-bottom:20px;
}

.history-item{
    background:linear-gradient(145deg, #F8FAFC 0%, #FFFFFF 100%);
    border-radius:16px;
    padding:20px;
    margin-bottom:16px;
    border-left:4px solid #10B981;
    transition:all 0.3s ease;
}

.history-item:hover{
    transform:translateX(4px);
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
}

/* RESPONSIVE */
@media (max-width: 768px){
    .sidebar{width:80px;padding:30px 12px;}
    .logo{font-size:1.2rem;}
    .nav a{justify-content:center;padding:14px 12px;}
    .nav a span{display:none;}
    .topbar{flex-direction:column;gap:20px;text-align:center;}
    .main{padding:20px 16px;}
    .delivery-header{flex-direction:column;align-items:flex-start;}
    .update-buttons{flex-direction:column;width:100%;}
    .btn-update{width:100%;justify-content:center;}
    .progress-track{gap:12px;}
}
</style>
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

<script>
// STATUS TOGGLE
document.getElementById('statusToggle')?.addEventListener('click', function() {
    this.classList.toggle('online');
    const isOnline = this.classList.contains('online');
    this.innerHTML = isOnline 
        ? '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Online'
        : '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Offline';
});

// UPDATE DELIVERY STATUS
document.getElementById('btnPickup').addEventListener('click', function() {
    const steps = {
        ready: document.getElementById('stepReady'),
        pickup: document.getElementById('stepPickup'),
        delivered: document.getElementById('stepDelivered')
    };
    const lines = {
        line1: document.getElementById('line1'),
        line2: document.getElementById('line2')
    };

    // Update to picked up
    steps.ready.classList.add('completed');
    steps.pickup.classList.add('active', 'completed');
    lines.line1.classList.add('completed');
    
    this.style.display = 'none';
    document.getElementById('btnDelivered').disabled = false;
});

document.getElementById('btnDelivered').addEventListener('click', function() {
    const steps = {
        pickup: document.getElementById('stepPickup'),
        delivered: document.getElementById('stepDelivered')
    };
    const lines = { line2: document.getElementById('line2') };

    // Update to delivered
    steps.delivered.classList.add('active', 'completed');
    lines.line2.classList.add('completed');
    
    this.innerHTML = '<i class="fas fa-check-double"></i> Delivered!';
    this.disabled = true;
});

console.log('☕ BrewHaven Deliveries Ready!');
console.log('🚚 All containers & IDs labeled for PHP');
</script>

</body>
</html>