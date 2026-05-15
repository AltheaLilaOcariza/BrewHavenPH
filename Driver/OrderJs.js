let ordersActive = null;
let queueCount = 0;
let currentDeliveryID = null;
let isOnDelivery = false;

// Show notification
function showNotification(text, type = "info") {
    const notif = document.getElementById('notification');
    notif.textContent = text;
    notif.className = `notification ${type} show`;
    setTimeout(() => notif.classList.remove('show'), 3000);
}

// Render empty order template (ready for database data)
function renderEmptyOrder() {
    const container = document.getElementById('orderContainer');
    container.innerHTML = `
        <div class="empty-state">
            <i class="fas fa-clipboard-list"></i>
            <h3>No Active Order</h3>
            <p>Waiting for new order from database...<br>Enable "Accepting Orders" to receive orders.</p>
        </div>
    `;
}

async function loadDriverStatus() {

    const response = await fetch("../backend/get_driver_status.php");
    const data = await response.json();

    const toggle = document.getElementById('statusToggle');

    if (!data.success) {
        ordersActive = false;
        renderEmptyOrder();
        document.getElementById('statusToggle').classList.remove('online');
        return;
    }

    if (data.status === "available") {

        ordersActive = true;

        toggle.classList.add('online');

        toggle.innerHTML = `
            <i class="fas fa-circle" style="font-size:0.7rem;"></i>
            Accepting Orders
        `;


        checkPendingDeliveries(true);

    } else {

        ordersActive = false;

        toggle.classList.remove('online');

        toggle.innerHTML = `
            <i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i>
            Paused
        `;

        renderEmptyOrder();
    }
}

// Render order template with database-ready structure
function renderOrderTemplate(orderNumber=null) {
    const container = document.getElementById('orderContainer');
    container.innerHTML = `
        <div class="order-card">
            <div class="order-header">
                <div class="order-no">
                    <i class="fas fa-hashtag"></i> Order #${orderNumber}
                </div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-cube"></i> Costumer Name
                </div>
                <div class="field-value" data-field="customerName">
                    Loading from database...
                </div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-cube"></i> Items & Qty
                </div>
                <div class="field-value" data-field="items">
                    Loading from database...
                </div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-receipt"></i> Total Bill
                </div>
                <div class="field-value" data-field="total">₱0.00</div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-phone"></i> Costumer Contact No.
                </div>
                <div class="field-value" data-field="contactNo">Loading...</div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-credit-card"></i> Payment Method
                </div>
                <div class="field-value" data-field="paymentMethod">Loading...</div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-store"></i> Pickup Location
                </div>
                <div class="field-value" data-field="pickup">Loading...</div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-location-dot"></i> Delivery Location
                </div>
                <div class="field-value" data-field="delivery">Loading...</div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-clock"></i> Estimated Time
                </div>
                <div class="field-value" data-field="time">00:00</div>
            </div>

            <div class="order-field">
                <div class="field-label">
                    <i class="fas fa-pen"></i> Order Notes
                </div>
                <div class="field-value" data-field="notes">-</div>
            </div>

            <div class="action-buttons">
                <button class="btn-accept" id="acceptBtn">
                    <i class="fas fa-check-circle"></i> Accept Order
                </button>
            </div>
        </div>
    `;

    // Accept button handler
    const acceptBtn = document.getElementById('acceptBtn');

    if (acceptBtn) {

         // 🔥 IMPORTANT: ALWAYS RESET BUTTON STATE ON NEW RENDER
        acceptBtn.disabled = false;
        acceptBtn.classList.remove("disabled");
        acceptBtn.innerHTML = `
            <i class="fas fa-check-circle"></i> Accept Order
        `;

        acceptBtn.addEventListener('click', async () => {

            if (!ordersActive) {
                showNotification("Enable 'Accepting Orders' first", "info");
                return;
            }

            const result = await acceptDelivery(currentDeliveryID);

            if (!result.success) {
                showNotification("Failed to accept delivery", "error");
                return;
            }

            currentDeliveryID = result.delivery_id;
            showNotification("🚚 Delivery assigned to you!", "success");

            queueCount--;
            updateQueueBadge();

            // 🔥 LOCK SYSTEM
            isOnDelivery = true;

            // 👉 SOFT LOCK BUFFER (ADD THIS HERE)
            window.deliveryLock = true;

            setTimeout(() => {
                window.deliveryLock = false;
            }, 5000);

            // CHANGE BUTTON UI
            acceptBtn.disabled = true;
            acceptBtn.innerHTML = `
                <i class="fas fa-truck"></i> Delivery On Going...
            `;
            acceptBtn.classList.add("disabled");

            // STOP NEW ORDERS
            // (polling already blocked by isOnDelivery)

        });
    }
}

async function acceptDelivery(deliveryId) {

    const formData = new FormData();
    formData.append("delivery_id", deliveryId);

    const response = await fetch("../backend/accept_delivery.php", {
        method: "POST",
        body: formData
    });

    return await response.json();
}

function updateQueueBadge() {
    document.getElementById('queueBadge').textContent = `Queue: ${queueCount}`;
}

// Database data population function (ready for your API)
function populateOrderData(orderData) {
    const fields = document.querySelectorAll('[data-field]');
    fields.forEach(field => {
        const key = field.getAttribute('data-field');
        if (orderData[key]) {
            field.textContent = orderData[key];
        }
    });
}

//polling for orders
async function checkPendingDeliveries(force = false) {
    
    if (!ordersActive) return;

    try {

        const response = await fetch("../backend/get_ready_delivery.php");
        const data = await response.json();

        // 🔥 CASE 1: backend says driver already has active delivery
        if (data.locked && data.delivery) {

            isOnDelivery = true;
            currentDeliveryID = data.delivery.delivery_id;
            currentOrderID = data.delivery.order_id;

            // 🔥 ALWAYS render UI when locked delivery exists
            renderOrderTemplate(data.delivery.order_id);

            populateOrderData({
                customerName: data.delivery.customer_name || "Unknown",
                items: data.delivery.items
                    ? data.delivery.items.map(i => `${i.item_name} x${i.quantity}`).join(", ")
                    : "No items found",
                total: data.delivery.total_amount ? "₱" + data.delivery.total_amount : "₱0.00",
                contactNo: data.delivery.contact_number,
                pickup: data.delivery.pickup_location,
                delivery: data.delivery.delivery_location,
                notes: data.delivery.message,
                paymentMethod: data.delivery.payment_method,
                time: "15 mins"
            });

            queueCount = 1;
            updateQueueBadge();

            return; // stop further processing AFTER render
        }

        // ❌ no available order
        if (!data.success) return;

        // only reset if we are SURE there is no session + no lock
        if (!data.delivery && !data.locked) {
            queueCount = 0;
            updateQueueBadge();

            currentDeliveryID = null;
            isOnDelivery = false;

            renderEmptyOrder(); // 🔥 THIS IS THE MISSING PIECE
            return;
        }

        const delivery = data.delivery;

        //delete later
        console.log("DELIVERY RESPONSE:", delivery);

        // avoid re-render spam
        if (!force && currentDeliveryID === delivery.delivery_id) return;

        currentDeliveryID = delivery.delivery_id;
        currentOrderID = delivery.order_id;

        if (!isOnDelivery) {
            renderOrderTemplate(delivery.order_id);
        }

        populateOrderData({
            customerName: delivery.customer_name || "Unknown",
            items: delivery.items
                ? delivery.items.map(i => `${i.item_name} x${i.quantity}`).join(", ")
                : "No items found",
             total: delivery.total_amount ? "₱" + delivery.total_amount : "₱0.00",
            contactNo: delivery.contact_number,
            pickup: delivery.pickup_location,
            delivery: delivery.delivery_location,
            notes: delivery.message,
            paymentMethod: delivery.payment_method,
            time: "15 mins"
        });

        queueCount = 1;
        updateQueueBadge();

        showNotification("🚚 New delivery received!", "success");

    } catch (error) {
        console.error(error);
    }
}

async function checkIfDelivered() {

    if (!currentDeliveryID) return;

    const res = await fetch("../backend/check_delivery_status.php?id=" + currentDeliveryID);
    const data = await res.json();

    if (data.status === "DELIVERED") {

        showNotification("✅ Delivery completed!", "success");

        // 🔥 FULL RESET (important order)
        resetDeliveryState();

        renderEmptyOrder();

        queueCount = 0;
        updateQueueBadge();

        isOnDelivery = false;

        currentDeliveryID = null; // 🔥 IMPORTANT ADDITION

        // 🔥 force polling sync
        checkPendingDeliveries(true);
    }
}

function resetDeliveryState() {

    currentDeliveryID = null;
    isOnDelivery = false;

    window.forceUnlock = true; // 🔥 BLOCK POLLING RELOCK

    const container = document.getElementById('orderContainer');
    container.innerHTML = '';

    renderEmptyOrder();

    const btn = document.getElementById('acceptBtn');
    if (btn) {
        btn.disabled = false;
        btn.innerHTML = `<i class="fas fa-check-circle"></i> Accept Order`;
        btn.classList.remove("disabled");
    }

    // 🔥 remove lock after short delay
    setTimeout(() => {
        window.forceUnlock = false;
    }, 2000);
}

// Initialize app when DOM loads
document.addEventListener('DOMContentLoaded', function() {
    
    loadDriverStatus();

    // Status toggle
    async function updateDriverStatus(status) {

        const formData = new FormData();

        formData.append("status", status);

        const response = await fetch("../backend/update_driver_status.php", {
            method: "POST",
            body: formData
        });

        return await response.json();
    }

    document.getElementById('statusToggle').addEventListener('click', async function () {

        // 🚫 BLOCK TOGGLE IF DELIVERY IS ACTIVE
        if (isOnDelivery) {
            showNotification("🚚 Finish current delivery first", "info");
            return;
        }

        let newStatus;

        if (ordersActive === null || ordersActive === false) {
            newStatus = "available";
        } else {
            newStatus = "unavailable";
        }

        const result = await updateDriverStatus(newStatus);

        if (!result.success) {
            showNotification("Database update failed", "info");
            return;
        }

        ordersActive = !ordersActive;

        if (ordersActive) {

            this.classList.add('online');

            this.innerHTML = `
                <i class="fas fa-circle" style="font-size:0.7rem;"></i>
                Accepting Orders
            `;

            showNotification("✅ Driver is ONLINE", "success");

            // 🔥 RESTORE ACTIVE ORDER if exists
            currentDeliveryID = null; // 🔥 reset cache
            checkPendingDeliveries(true); // FORCE FRESH FETCH

        } else {

            this.classList.remove('online');

            this.innerHTML = `
                <i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i>
                Paused
            `;

            showNotification("⏸ Driver is OFFLINE", "info");

            renderEmptyOrder();
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        if (e.ctrlKey || e.metaKey) {
            switch(e.key) {
                case 'Enter':
                    e.preventDefault();
                    document.getElementById('acceptBtn')?.click();
                    break;
                case 'Escape':
                    document.getElementById('cancelBtn')?.click();
                    break;
            }
        }
    });

    // Initialize
    loadDriverStatus().then(() => {

        updateQueueBadge();

        // Check every 3 seconds
        setInterval(checkPendingDeliveries, 3000);

    });
    
    console.log('☕ BrewHaven Orders loaded!');
    console.log('📦 Ready for PHP/MySQL integration');
    console.log('🔗 Use populateOrderData() for database data');
});