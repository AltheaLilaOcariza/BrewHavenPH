let ordersActive = true;
let queueCount = 0;

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

// Render order template with database-ready structure
function renderOrderTemplate(orderNumber = 1) {
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
                <button class="btn-cancel" id="cancelBtn">
                    <i class="fas fa-times-circle"></i> Cancel Order
                </button>
            </div>
        </div>
    `;

    // Accept button handler
    document.getElementById('acceptBtn').addEventListener('click', () => {
        if(!ordersActive) {
            showNotification("Enable 'Accepting Orders' first", "info");
            return;
        }
        // Here you would send POST request to your backend
        showNotification("✅ Order accepted! Sent to processing.", "success");
        queueCount--;
        updateQueueBadge();
        renderEmptyOrder();
    });

    // Cancel button handler
    document.getElementById('cancelBtn').addEventListener('click', () => {
        if(!ordersActive) {
            showNotification("Cannot cancel while paused", "info");
            return;
        }
        // Here you would send DELETE request to your backend
        showNotification("❌ Order cancelled", "info");
        renderEmptyOrder();
    });
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

// Initialize app when DOM loads
document.addEventListener('DOMContentLoaded', function() {
    // Status toggle
    document.getElementById('statusToggle').addEventListener('click', function() {
        ordersActive = !ordersActive;
        if(ordersActive) {
            this.classList.add('online');
            this.innerHTML = '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Accepting Orders';
            showNotification("✅ Connected - waiting for orders from database (Ctrl+Enter)", "success");
            renderOrderTemplate(1);
            // Here you would start polling your API for new orders
            // startOrderPolling();
        } else {
            this.classList.remove('online');
            this.innerHTML = '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Paused';
            showNotification("⏸ Orders paused", "info");
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
    renderEmptyOrder();
    updateQueueBadge();
    
    console.log('☕ BrewHaven Orders loaded!');
    console.log('📦 Ready for PHP/MySQL integration');
    console.log('🔗 Use populateOrderData() for database data');
});