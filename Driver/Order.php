
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BrewHaven Orders | Vertical Flow</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:#F9F1E2;
    color:#1e293b;
}

.dashboard{
    display:flex;
    min-height:100vh;
}

/* SIDEBAR (same elegance) */
.sidebar{
    width:260px;
    background:linear-gradient(145deg, #5E8C4A 0%, #3D5C2E 100%);
    color:white;
    padding:30px 20px;
    box-shadow:5px 0 25px rgba(0,0,0,0.1);
    transition:all 0.2s;
}

.logo{
    font-size:1.9rem;
    font-weight:800;
    background:linear-gradient(135deg, #FFE4A3, #FFD27A);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
    margin-bottom:48px;
    letter-spacing:-0.5px;
}

.nav{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.nav a{
    text-decoration:none;
    color:rgba(255,255,255,0.85);
    padding:12px 18px;
    border-radius:16px;
    font-weight:500;
    display:flex;
    align-items:center;
    gap:14px;
    transition:0.25s;
}

.nav a i{
    width:24px;
    font-size:1.2rem;
}

.nav a:hover, .nav a.active{
    background:#FFD88F;
    color:#2C4B1E;
    transform:translateX(6px);
    box-shadow:0 6px 14px rgba(0,0,0,0.15);
}

/* MAIN LAYOUT */
.main{
    flex:1;
    padding:32px 36px;
    overflow-y:auto;
    background:#FDF9F2;
}

.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    margin-bottom:32px;
    gap:20px;
}

.topbar h1{
    font-size:2.2rem;
    font-weight:800;
    background:linear-gradient(135deg, #4B6E3B, #2C5A1E);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
    letter-spacing:-0.3px;
}

.greeting{
    color:#5b6e4a;
    font-weight:500;
    margin-top:4px;
}

.status-toggle{
    background:white;
    border:2px solid #A8C66C;
    color:#2f4f2f;
    padding:10px 24px;
    border-radius:60px;
    font-weight:700;
    cursor:pointer;
    transition:all 0.2s;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
}

.status-toggle.online{
    border-color:#10B981;
    background:#E8FAF0;
    color:#0B6E4F;
}

/* TWO COLUMN LAYOUT: left orders (vertical queue) + right messages */
.two-column-layout{
    display:flex;
    gap:32px;
    align-items:flex-start;
}

/* LEFT: VERTICAL ORDERS CONTAINER */
.orders-vertical-container{
    flex:2.2;
    min-width:0;
}

.section-header{
    display:flex;
    justify-content:space-between;
    align-items:baseline;
    margin-bottom:20px;
    flex-wrap:wrap;
}

.section-header h2{
    font-weight:700;
    font-size:1.6rem;
    background:linear-gradient(135deg, #4A6F3A, #2C5A1E);
    -webkit-background-clip:text;
    background-clip:text;
    color:transparent;
}

.badge-counter{
    background:#5E8C4A;
    color:white;
    padding:6px 14px;
    border-radius:40px;
    font-size:0.85rem;
    font-weight:600;
}

/* VERTICAL ORDER CARD (one at a time) */
.current-order-card{
    background:white;
    border-radius:32px;
    box-shadow:0 20px 35px -12px rgba(0,0,0,0.15);
    overflow:hidden;
    transition:all 0.35s ease;
    border:1px solid #F0E3D0;
    margin-bottom:28px;
}

.order-active-header{
    background:linear-gradient(115deg, #FEF9E6, #FFF5E0);
    padding:22px 28px;
    border-bottom:2px solid #FFDFA5;
}

.order-no-badge{
    font-size:1.7rem;
    font-weight:800;
    color:#5E8C4A;
    letter-spacing:-0.3px;
    display:inline-block;
    background:rgba(94,140,74,0.12);
    padding:6px 18px;
    border-radius:60px;
}

.order-detail-section{
    padding:24px 28px;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.info-row{
    display:flex;
    flex-wrap:wrap;
    align-items:baseline;
    gap:12px;
    border-bottom:1px dashed #E9DFCF;
    padding-bottom:16px;
}

.info-label{
    width:130px;
    font-weight:700;
    color:#4b5e3a;
    font-size:0.9rem;
    display:flex;
    align-items:center;
    gap:8px;
}

.info-value{
    flex:1;
    font-weight:500;
    color:#1e2a3a;
    font-size:1rem;
}

.items-list{
    background:#F8F4EB;
    border-radius:18px;
    padding:14px 18px;
    margin:6px 0;
}

.item-line{
    display:flex;
    justify-content:space-between;
    padding:8px 0;
    font-weight:500;
    border-bottom:1px solid #e9dfcf;
}

.item-line:last-child{
    border-bottom:none;
}

.total-bill{
    font-weight:800;
    font-size:1.2rem;
    color:#2C5A1E;
    background:#E6F0DC;
    padding:12px 18px;
    border-radius:24px;
    display:inline-block;
}

.action-buttons-row{
    display:flex;
    gap:18px;
    margin-top:12px;
    flex-wrap:wrap;
}

.btn-accept-order{
    background:linear-gradient(95deg, #10B981, #0E9F6E);
    border:none;
    padding:14px 28px;
    border-radius:48px;
    font-weight:700;
    color:white;
    font-size:1rem;
    display:inline-flex;
    align-items:center;
    gap:10px;
    cursor:pointer;
    transition:0.2s;
    box-shadow:0 4px 10px rgba(16,185,129,0.3);
    flex:1;
    justify-content:center;
}

.btn-accept-order:hover{
    transform:translateY(-2px);
    filter:brightness(1.02);
}

.btn-cancel-order{
    background:transparent;
    border:2px solid #EF4444;
    color:#EF4444;
    padding:14px 28px;
    border-radius:48px;
    font-weight:700;
    gap:8px;
    display:inline-flex;
    align-items:center;
    cursor:pointer;
    transition:0.2s;
    flex:1;
    justify-content:center;
}

.btn-cancel-order:hover{
    background:#EF4444;
    color:white;
}

/* Empty state for orders */
.empty-order-state{
    background:white;
    border-radius:32px;
    padding:54px 32px;
    text-align:center;
    box-shadow:0 12px 30px rgba(0,0,0,0.05);
    border:1px dashed #CBBFA8;
}

.empty-order-state i{
    font-size:3.5rem;
    color:#B7A87B;
    margin-bottom:20px;
}

/* RIGHT SIDE: MESSAGES + REPLY */
.messages-panel{
    flex:1.4;
    background:white;
    border-radius:32px;
    box-shadow:0 20px 35px -12px rgba(0,0,0,0.12);
    overflow:hidden;
    display:flex;
    flex-direction:column;
    height:fit-content;
    max-height:78vh;
    border:1px solid #F1E6D8;
}

.messages-header{
    background:#FEF9EF;
    padding:20px 24px;
    border-bottom:2px solid #F7EBD9;
}

.messages-header h3{
    font-weight:700;
    font-size:1.45rem;
    display:flex;
    align-items:center;
    gap:10px;
    color:#4A5C3A;
}

.messages-list{
    flex:1;
    padding:20px 20px 10px 20px;
    overflow-y:auto;
    max-height:420px;
    display:flex;
    flex-direction:column;
    gap:22px;
}

.messages-list::-webkit-scrollbar {
    width: 6px;
}
.messages-list::-webkit-scrollbar-track {
    background: #f1e6d8;
    border-radius: 10px;
}
.messages-list::-webkit-scrollbar-thumb {
    background: #a8c66c;
    border-radius: 10px;
}

.message-item{
    background:#FEF9F0;
    border-radius:24px;
    padding:18px;
    border-left:4px solid #F4B942;
    transition:0.2s;
    box-shadow:0 2px 8px rgba(0,0,0,0.03);
}

.message-customer{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:12px;
}

.customer-avatar{
    width:40px;
    height:40px;
    background:#EBAE3A;
    border-radius:60px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    color:white;
}

.customer-name{
    font-weight:700;
    font-size:1rem;
    color:#2c3e2b;
}

.message-time{
    font-size:0.7rem;
    color:#9b8e72;
    margin-left:auto;
}

.message-text{
    color:#41503a;
    line-height:1.45;
    margin:10px 0 8px 0;
    padding-left:8px;
    font-size:0.95rem;
}

.reply-area{
    margin-top:16px;
    display:flex;
    gap:12px;
    align-items:center;
    background:white;
    border-radius:60px;
    padding:5px 8px 5px 18px;
    border:1px solid #E2D5BE;
}

.reply-input{
    flex:1;
    border:none;
    padding:12px 0;
    font-family:'Inter',sans-serif;
    font-size:0.9rem;
    outline:none;
    background:transparent;
}

.btn-send-reply{
    background:#5E8C4A;
    border:none;
    color:white;
    padding:8px 18px;
    border-radius:40px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

.btn-send-reply:hover{
    background:#446b34;
}

.no-messages{
    text-align:center;
    padding:40px;
    color:#bcaa86;
}

/* order queue hidden: next order appears after accept */
.next-order-info{
    background:#FAF4EA;
    border-radius:28px;
    padding:14px 20px;
    margin-top:18px;
    border:1px solid #E8DDCD;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* notification */
.notification{
    position:fixed;
    bottom:28px;
    right:28px;
    background:#2c3e2b;
    color:white;
    padding:14px 28px;
    border-radius:80px;
    font-weight:500;
    z-index:1100;
    transform:translateX(400px);
    transition:all 0.3s;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.notification.show{
    transform:translateX(0);
}

.notification.success{ background:#10B981; }
.notification.info{ background:#3B82F6; }

/* Responsive */
@media (max-width:1024px){
    .two-column-layout{
        flex-direction:column;
    }
    .sidebar{
        width:90px;
        padding:30px 10px;
    }
    .sidebar .logo{ font-size:1.2rem; }
    .nav a span{ display:none; }
    .nav a i{ margin:0 auto; }
    .main{ padding:20px; }
}

@media (max-width:680px){
    .info-row{
        flex-direction:column;
        gap:6px;
    }
    .info-label{
        width:auto;
    }
    .action-buttons-row{
        flex-direction:column;
    }
}

@media (max-width: 480px) {
    .messages-panel { order: -1; }
}
</style>
</head>

<body>
<div class="dashboard">
    <div class="sidebar">
        <div class="logo">☕ BrewHaven</div>
        <div class="nav">
            <a href="dashboard.php">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <a href="order.php" class="active">
                <i class="fas fa-clipboard-list"></i>
                <span>Orders</span>
            </a>

            <a href="deliveries.php">
                <i class="fas fa-truck"></i>
                <span>Deliveries</span>
            </a>

            <a href="earnings.php">
                <i class="fas fa-dollar-sign"></i>
                <span>Earnings</span>
            </a>

            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div>
                <h1>Orders</h1>
                <p class="greeting">One order at a time — smooth workflow</p>
            </div>
            <button class="status-toggle online" id="globalStatusToggle">
                <i class="fas fa-circle" style="font-size:0.7rem;"></i> Accepting Orders
            </button>
        </div>

        <div class="two-column-layout">
            <!-- LEFT: VERTICAL ORDER QUEUE (single live order) -->
            <div class="orders-vertical-container">
                <div class="section-header">
                    <h2><i class="fas fa-mug-hot"></i> Active Order</h2>
                    <div class="badge-counter" id="queueCountBadge">Queue: 3</div>
                </div>

                <!-- Dynamic order card will be injected here -->
                <div id="verticalOrderCardContainer"></div>
                
                <!-- Next order hint (only if queue left) -->
                <div id="nextOrderHint" class="next-order-info" style="display: none;">
                    <span><i class="fas fa-hourglass-half"></i> Next order ready after accepting</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- RIGHT: MESSAGES PANEL with reply -->
            <div class="messages-panel">
                <div class="messages-header">
                    <h3><i class="fas fa-comment-dots" style="color:#EBAE3A;"></i> Customer Messages</h3>
                    <p style="font-size:13px; color:#7d6e4e;">Reply directly — they'll see your response</p>
                </div>
                <div class="messages-list" id="messagesListContainer">
                    <!-- dynamic messages appear -->
                </div>
            </div>
        </div>
    </div>
</div>

<div id="notification" class="notification"></div>

<script>
// ---------- DATA MODELS (PESO PRICES) ----------
// Orders queue (Philippine Peso prices)
let ordersQueue = [
    {
        id: "ORD-001",
        orderName: "Morning Brew Special",
        customerName: "John Cruz",
        items: [{ name: "Latte", qty: 1, price: 145 }, { name: "Croissant", qty: 1, price: 95 }],
        totalBill: 240,
        pickup: "BrewHaven Cafe, Cebu City",
        delivery: "Ayala Mall Cebu",
        estTime: "25 min",
        notes: "Extra hot latte, no sugar. Thanks!",
    },
    {
        id: "ORD-002",
        orderName: "Americano Rush",
        customerName: "Maria K.",
        items: [{ name: "Americano", qty: 2, price: 110 }, { name: "Muffin", qty: 1, price: 85 }],
        totalBill: 305,
        pickup: "BrewHaven Cafe, Cebu City",
        delivery: "SM City Cebu",
        estTime: "20 min",
        notes: "Rush order - paper cup please!",
    },
    {
        id: "ORD-003",
        orderName: "Green Tea Bliss",
        customerName: "Anna L.",
        items: [{ name: "Matcha Latte", qty: 1, price: 165 }],
        totalBill: 165,
        pickup: "BrewHaven Cafe, Cebu City",
        delivery: "IT Park Lahug",
        estTime: "18 min",
        notes: "Less sweet please. Thank you ☕",
    }
];

// Additional orders (Philippine Peso)
const extraOrders = [
    { 
        id: "ORD-004", 
        orderName: "Caramel Dream", 
        customerName: "Leo M.", 
        items: [{ name: "Caramel Macchiato", qty: 1, price: 175 },{ name:"Cookie", qty:1, price:70}], 
        totalBill:245, 
        pickup: "BrewHaven Cafe, Cebu City", 
        delivery: "Central Bloc", 
        estTime: "22 min", 
        notes: "Extra caramel drizzle" 
    },
    { 
        id: "ORD-005", 
        orderName: "Iced Refresh", 
        customerName: "Sophia R.", 
        items: [{ name:"Iced Americano", qty:1, price:125},{ name:"Brownie", qty:1, price:95}], 
        totalBill:220, 
        pickup: "BrewHaven Cafe, Cebu City", 
        delivery: "Baseline Complex", 
        estTime: "15 min", 
        notes: "Less ice" 
    }
];

// Messages list (linked to orders by customer name)
let customerMessages = [
    { id: "msg1", customerName: "John Cruz", avatar: "JC", message: "Hi! For my morning latte, can you please make it extra hot with almond milk instead of regular milk? Also, croissant should be warmed up. Thank you so much! ☕", timestamp: "3 mins ago", status: "seen", replies: [] },
    { id: "msg2", customerName: "Maria K.", avatar: "MK", message: "Rush order please! I'm heading to an important meeting. Can you use paper cup for my Americano? Will be there in 10 mins to pick up.", timestamp: "8 mins ago", status: "pending", replies: [] },
    { id: "msg3", customerName: "Anna L.", avatar: "AL", message: "Love your matcha lattes! Can you make it less sweet this time? Heading to IT Park for work. Thank you BrewHaven team! ✨", timestamp: "12 mins ago", status: "read", replies: [] }
];

let ordersActive = true;
let currentOrderIndex = 0;
let orderTimers = {};

// Helper: format peso
function formatPeso(amount) {
    return new Intl.NumberFormat('fil-PH', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 0
    }).format(amount);
}

// Helper: show notification
function showNotification(text, type = "info") {
    const notif = document.getElementById('notification');
    notif.textContent = text;
    notif.className = `notification ${type} show`;
    setTimeout(() => notif.classList.remove('show'), 3500);
}

// Render the current active order (vertical style)
function renderCurrentOrder() {
    const container = document.getElementById('verticalOrderCardContainer');
    const queueHint = document.getElementById('nextOrderHint');
    if (!container) return;

    // if no orders left globally + queue empty
    if (currentOrderIndex >= ordersQueue.length) {
        container.innerHTML = `
            <div class="empty-order-state">
                <i class="fas fa-check-circle" style="color:#10B981;"></i>
                <h3 style="margin:16px 0 8px;">All orders completed!</h3>
                <p style="color:#7e6e50;">Great job! New orders will appear when toggled ON and ready.</p>
                <button id="refillMockOrdersBtn" style="margin-top:20px; background:#5E8C4A; border:none; color:white; padding:10px 20px; border-radius:40px; cursor:pointer;"><i class="fas fa-plus"></i> Simulate New Order</button>
            </div>
        `;
        queueHint.style.display = 'none';
        document.getElementById('queueCountBadge').innerText = `Queue: 0`;
        const refillBtn = document.getElementById('refillMockOrdersBtn');
        if(refillBtn) refillBtn.addEventListener('click', () => {
            if(!ordersActive) { showNotification("Enable 'Accepting Orders' first", "info"); return; }
            ordersQueue.push(...extraOrders);
            if(currentOrderIndex === ordersQueue.length - extraOrders.length) {
                renderCurrentOrder();
            }
            updateQueueBadge();
            if(currentOrderIndex < ordersQueue.length) renderCurrentOrder();
            showNotification("➕ 2 new orders added to queue!", "success");
        });
        return;
    }

    const order = ordersQueue[currentOrderIndex];
    if (!order) return;

    // items HTML with PESO
    const itemsHtml = order.items.map(it => 
        `<div class="item-line">
            <span>${it.name} x${it.qty}</span>
            <span>${formatPeso(it.price * it.qty)}</span>
        </div>`
    ).join('');
    
    const total = formatPeso(order.totalBill);

    container.innerHTML = `
    <div class="current-order-card">
        <div class="order-active-header">
            <div class="order-no-badge"><i class="fas fa-hashtag"></i> ${order.id}</div>
            <div style="margin-top: 12px; font-size:1.2rem; font-weight:600;">
                ${order.orderName} · ${order.customerName}
            </div>
        </div>

        <div class="order-detail-section">
            <div class="info-row">
                <div class="info-label"><i class="fas fa-cube"></i> Items & Qty</div>
                <div class="info-value items-list">${itemsHtml}</div>
            </div>

            <div class="info-row">
                <div class="info-label"><i class="fas fa-receipt"></i> Total Bill</div>
                <div class="info-value total-bill">${total}</div>
            </div>

            <div class="info-row">
                <div class="info-label"><i class="fas fa-store"></i> Pickup Location</div>
                <div class="info-value">${order.pickup}</div>
            </div>

            <div class="info-row">
                <div class="info-label"><i class="fas fa-location-dot"></i> Delivery Location</div>
                <div class="info-value">${order.delivery}</div>
            </div>

            <div class="info-row">
                <div class="info-label"><i class="fas fa-clock"></i> Estimated Time</div>
                <div class="info-value">
                    <span style="background:#f0ecdc; padding:6px 12px; border-radius:24px;" id="estTime-${order.id}">
                        ${order.estTime}
                    </span>
                </div>
            </div>

            ${order.notes ? `
                <div class="info-row">
                    <div class="info-label"><i class="fas fa-pen"></i> Order Notes</div>
                    <div class="info-value">${order.notes}</div>
                </div>
            ` : ''}

            <div class="action-buttons-row">
                <button class="btn-accept-order" id="acceptOrderBtn">
                    <i class="fas fa-check-circle"></i> Accept Order
                </button>
                <button class="btn-cancel-order" id="cancelOrderBtn">
                    <i class="fas fa-times-circle"></i> Cancel Order
                </button>
            </div>
        </div>
    </div>
`;
    
    // next hint visibility
    if((currentOrderIndex + 1) < ordersQueue.length && ordersActive) {
        queueHint.style.display = 'flex';
        queueHint.innerHTML = `<span><i class="fas fa-hourglass-half"></i> Next: ${ordersQueue[currentOrderIndex+1].orderName} (${ordersQueue[currentOrderIndex+1].customerName}) ready after accept</span><i class="fas fa-arrow-right"></i>`;
    } else {
        queueHint.style.display = 'none';
    }

    // Accept button
    document.getElementById('acceptOrderBtn')?.addEventListener('click', () => {
        if(!ordersActive) { 
            showNotification("Orders paused. Enable accepting orders first.", "info"); 
            return; 
        }
        showNotification(`✅ Order ${order.id} accepted! Preparing for delivery. Total: ${total}`, "success");
        currentOrderIndex++;
        updateQueueBadge();
        renderCurrentOrder();
        if(currentOrderIndex >= ordersQueue.length) {
            showNotification("🎉 No more orders in queue. Add more or wait for new.", "info");
        } else {
            showNotification(`📦 New order popped: ${ordersQueue[currentOrderIndex].orderName}`, "info");
        }
    });

    // Cancel button
    document.getElementById('cancelOrderBtn')?.addEventListener('click', () => {
        if(!ordersActive) { 
            showNotification("Cannot cancel while paused", "info"); 
            return; 
        }
        showNotification(`❌ Order ${order.id} declined & removed.`, "info");
        ordersQueue.splice(currentOrderIndex, 1);
        if(ordersQueue.length === 0) {
            currentOrderIndex = 0;
        } else if(currentOrderIndex >= ordersQueue.length) {
            currentOrderIndex = ordersQueue.length - 1;
            if(currentOrderIndex < 0) currentOrderIndex = 0;
        }
        updateQueueBadge();
        renderCurrentOrder();
        if(ordersQueue.length > 0) showNotification(`Next order in queue.`, "info");
    });

    // Start countdown timer
    startOrderTimer(order.id);
    
    updateQueueBadge();
}

function startOrderTimer(orderId) {
    const timerEl = document.getElementById(`estTime-${orderId}`);
    if (!timerEl) return;

    let timeMatch = timerEl.textContent.match(/(\d+) min/);
    if (timeMatch) {
        let minutes = parseInt(timeMatch[1]);
        const timer = setInterval(() => {
            if (minutes > 0) {
                minutes--;
                timerEl.textContent = `${minutes} min`;
                if (minutes <= 5) {
                    timerEl.style.color = '#EF4444';
                    timerEl.style.background = '#fee2e2';
                }
            } else {
                clearInterval(timer);
                timerEl.textContent = 'Ready!';
                timerEl.style.color = '#10B981';
            }
        }, 60000); // 1 minute
        
        orderTimers[orderId] = timer;
    }
}

function updateQueueBadge() {
    const remaining = ordersQueue.length - currentOrderIndex;
    document.getElementById('queueCountBadge').innerText = `Queue: ${Math.max(0, remaining)}`;
}

// RENDER MESSAGES + REPLY logic
function renderMessages() {
    const container = document.getElementById('messagesListContainer');
    if(!container) return;
    
    container.innerHTML = customerMessages.map(msg => `
        <div class="message-item" data-msg-id="${msg.id}">
            <div class="message-customer">
                <div class="customer-avatar">${msg.avatar}</div>
                <div class="customer-name">${msg.customerName}</div>
                <div class="message-time">${msg.timestamp}</div>
            </div>
            <div class="message-text">${escapeHtml(msg.message)}</div>
            <div class="reply-area" id="reply-area-${msg.id}">
                <input type="text" class="reply-input" id="replyInput-${msg.id}" placeholder="Reply to ${msg.customerName}...">
                <button class="btn-send-reply" data-replyto="${msg.id}"><i class="fas fa-paper-plane"></i> Send</button>
            </div>
            <div id="replyHistory-${msg.id}" style="margin-top: 10px; font-size:0.85rem; color:#6c5e44;"></div>
        </div>
    `).join('');

    // Auto-scroll to bottom
    container.scrollTop = container.scrollHeight;

    customerMessages.forEach(msg => {
        const sendBtn = document.querySelector(`button[data-replyto="${msg.id}"]`);
        const inputField = document.getElementById(`replyInput-${msg.id}`);
        const replyHistoryDiv = document.getElementById(`replyHistory-${msg.id}`);
        
        if(msg.replies && msg.replies.length){
            replyHistoryDiv.innerHTML = msg.replies.map(r => 
                `<div style="background:#F4EAD9; border-radius:20px; padding:6px 12px; margin-top:6px;">
                    <i class="fas fa-reply"></i> You: ${escapeHtml(r)}
                </div>`
            ).join('');
        }
        
        if(sendBtn && inputField) {
            const sendReply = () => {
                const replyText = inputField.value.trim();
                if(!replyText) return;
                if(!msg.replies) msg.replies = [];
                msg.replies.push(replyText);
                showNotification(`✅ Replied to ${msg.customerName}`, "success");
                inputField.value = '';
                replyHistoryDiv.innerHTML = msg.replies.map(r => 
                    `<div style="background:#F4EAD9; border-radius:20px; padding:6px 12px; margin-top:6px;">
                        <i class="fas fa-reply"></i> You: ${escapeHtml(r)}
                    </div>`
                ).join('');
                container.scrollTop = container.scrollHeight;
            };
            
            sendBtn.addEventListener('click', sendReply);
            inputField.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') sendReply();
            });
        }
    });
}

function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    if (e.ctrlKey || e.metaKey) {
        switch(e.key) {
            case 'Enter':
                e.preventDefault();
                document.getElementById('acceptOrderBtn')?.click();
                break;
            case 'Escape':
                document.getElementById('cancelOrderBtn')?.click();
                break;
        }
    }
});

// Global toggle status
document.getElementById('globalStatusToggle')?.addEventListener('click', function() {
    ordersActive = !ordersActive;
    if(ordersActive) {
        this.classList.add('online');
        this.innerHTML = '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Accepting Orders';
        showNotification("✅ Now accepting orders. Click 'Accept Order' to fulfill. (Ctrl+Enter)", "success");
        renderCurrentOrder();
    } else {
        this.classList.remove('online');
        this.innerHTML = '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Paused';
        showNotification("⏸ Orders paused. No new accepts.", "info");
    }
});

// initial load
function init() {
    renderCurrentOrder();
    renderMessages();
    updateQueueBadge();
}

// PWA Support
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('data:text/javascript;base64,...');
}

init();
</script>

</body>
</html>

