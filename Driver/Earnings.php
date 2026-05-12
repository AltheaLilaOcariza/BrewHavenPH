
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven Earnings - Driver Dashboard</title>

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

/* EARNINGS STATS GRID */
.earnings-stats{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));
    gap:24px;
    margin-bottom:32px;
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

.stat-card.total-earnings{
    border-color:#10B981;
    background:linear-gradient(145deg, rgba(16,185,129,0.05) 0%, #FEFCF3 100%);
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

.icon-total{ background:linear-gradient(135deg, #10B981, #059669); }
.icon-today{ background:linear-gradient(135deg, #F59E0B, #D97706); }
.icon-week{ background:linear-gradient(135deg, #3B82F6, #1D4ED8); }
.icon-month{ background:linear-gradient(135deg, #8B5CF6, #7C3AED); }

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

.stat-change{
    display:flex;
    align-items:center;
    gap:6px;
    font-size:0.9rem;
    font-weight:600;
}

.change-up{ color:#10B981; }
.change-down{ color:#EF4444; }

/* EARNINGS BREAKDOWN */
.breakdown-section{
    background:linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
    border-radius:24px;
    padding:32px;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
    margin-bottom:32px;
}

.breakdown-title{
    font-size:1.3rem;
    font-weight:700;
    color:#374151;
    margin-bottom:24px;
    display:flex;
    align-items:center;
    gap:8px;
}

.earnings-table{
    width:100%;
    border-collapse:collapse;
}

.table-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:16px 0;
    border-bottom:1px solid #E5E7EB;
}

.table-row:last-child{
    border-bottom:none;
    font-weight:700;
    font-size:1.1rem;
    color:#1e293b;
}

.table-label{
    display:flex;
    align-items:center;
    gap:12px;
    font-weight:500;
}

.table-amount{
    font-weight:600;
    color:#5E8C4A;
}

/* WITHDRAWAL SECTION */
.withdrawal-section{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px;
    margin-top:32px;
}

.balance-card,
.withdraw-card{
    background:linear-gradient(145deg, #FFFFFF 0%, #F8FAFC 100%);
    border-radius:24px;
    padding:32px;
    box-shadow:0 12px 30px rgba(0,0,0,0.08);
}

.balance-card{
    border-right:4px solid #10B981;
}

.withdraw-card{
    border-right:4px solid #F59E0B;
}

.section-title{
    font-size:1.1rem;
    font-weight:600;
    color:#374151;
    margin-bottom:16px;
}

.balance-amount{
    font-size:2.5rem;
    font-weight:800;
    color:#10B981;
    line-height:1;
    margin-bottom:8px;
}

.withdraw-btn{
    background:linear-gradient(135deg, #F59E0B, #D97706);
    color:white;
    border:none;
    padding:14px 24px;
    border-radius:12px;
    font-weight:600;
    font-size:1rem;
    cursor:pointer;
    transition:all 0.3s ease;
    width:100%;
    margin-top:16px;
}

.withdraw-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 25px rgba(245,158,11,0.4);
}

/* RESPONSIVE */
@media (max-width: 768px){
    .sidebar{width:80px;padding:30px 12px;}
    .logo{font-size:1.2rem;}
    .nav a{justify-content:center;padding:14px 12px;}
    .nav a span{display:none;}
    .topbar{flex-direction:column;gap:20px;text-align:center;}
    .main{padding:20px 16px;}
    .earnings-stats{grid-template-columns:1fr;}
    .withdrawal-section{grid-template-columns:1fr;}
    .table-row{flex-direction:column;align-items:flex-start;gap:8px;}
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
            <a href="Deliveries.php">
                <i class="fas fa-truck"></i>
                <span>Deliveries</span>
            </a>
            <a href="Earnings.php" class="active">
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
                    <h1>My Earnings</h1>
                    <p class="greeting">Track your income & withdrawals</p>
                </div>
                <button class="status-toggle online" id="statusToggle">
                    <i class="fas fa-circle" style="font-size:0.7rem;"></i>
                    Online
                </button>
            </div>

            <!-- EARNINGS STATS -->
            <div class="earnings-stats">
                <div class="stat-card total-earnings">
                    <div class="stat-header">
                        <div class="stat-title">Total Earnings</div>
                        <div class="stat-icon icon-total">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="totalEarnings">₱0.00</div>
                    <div class="stat-change change-up">
                        <i class="fas fa-arrow-up"></i>
                        <span id="totalChange">+12.5%</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Today</div>
                        <div class="stat-icon icon-today">
                            <i class="fas fa-sun"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="todayEarnings">₱0.00</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">This Week</div>
                        <div class="stat-icon icon-week">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="weekEarnings">₱0.00</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">This Month</div>
                        <div class="stat-icon icon-month">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <div class="stat-number" id="monthEarnings">₱0.00</div>
                </div>
            </div>

            <!-- EARNINGS BREAKDOWN -->
            <div class="breakdown-section">
                <h2 class="breakdown-title" id="breakdownTitle">
                    <i class="fas fa-chart-pie"></i>
                    Earnings Breakdown
                </h2>
                <table class="earnings-table">
                    <tr class="table-row">
                        <td class="table-label">
                            <div style="width:12px;height:12px;background:#10B981;border-radius:50%;"></div>
                            <span id="breakdownCompleted">Completed Deliveries</span>
                        </td>
                        <td class="table-amount" id="amountCompleted">₱0.00</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-label">
                            <div style="width:12px;height:12px;background:#F59E0B;border-radius:50%;"></div>
                            <span id="breakdownBonus">Peak Hour Bonus</span>
                        </td>
                        <td class="table-amount" id="amountBonus">₱0.00</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-label">
                            <div style="width:12px;height:12px;background:#3B82F6;border-radius:50%;"></div>
                            <span id="breakdownTips">Customer Tips</span>
                        </td>
                        <td class="table-amount" id="amountTips">₱0.00</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-label">
                            <div style="width:12px;height:12px;background:#8B5CF6;border-radius:50%;"></div>
                            <span id="breakdownReferral">Referral Bonus</span>
                        </td>
                        <td class="table-amount" id="amountReferral">₱0.00</td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-label">
                            <span>TOTAL</span>
                        </td>
                        <td class="table-amount" id="breakdownTotal">₱0.00</td>
                    </tr>
                </table>
            </div>

            <!-- WITHDRAWAL SECTION -->
            <div class="withdrawal-section">
                <div class="balance-card">
                    <div class="section-title">Available Balance</div>
                    <div class="balance-amount" id="availableBalance">₱0.00</div>
                    <div style="color:#6B7280; font-size:0.95rem;">Ready for withdrawal</div>
                </div>
                <div class="withdraw-card">
                    <div class="section-title">Withdraw Earnings</div>
                    <div style="color:#374151; margin-bottom:16px; font-size:1rem;" id="pendingWithdrawals">
                        Pending: ₱0.00
                    </div>
                    <button class="withdraw-btn" id="withdrawButton">
                        <i class="fas fa-arrow-down"></i>
                        Withdraw Now
                    </button>
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

// WITHDRAW BUTTON
document.getElementById('withdrawButton').addEventListener('click', function() {
    alert('💰 Withdrawal request sent!\n\nProcessing in 1-2 business days.');
});

console.log('💰 BrewHaven Earnings Ready!');
console.log('₱ All earnings now in Philippine Peso!');
</script>

</body>
</html>