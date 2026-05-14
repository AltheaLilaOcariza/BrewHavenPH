
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<?php
    
    $title = "Manage Orders | BrewHaven Cafe";
    $extra_css = ['../assets/css/includes.css', '../assets/css/manage_orders.css'];
    include '../includes/header.php';
    
    require '../backend/functions.php';
    $orderManager = new OrderDAO();
    $itemManager = new Item(); // We need this to get item names
    $deliveryManager  = new DeliveriesDAO();
    
    // Handle actions
    if (isset($_POST['update_status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        //update order status first
        $orderManager->updateOrderStatus($order_id, $status);
        
        // if order is completed AND it's a delivery → update delivery status
        $order = $orderManager->getOrderById($order_id);

        if ($order && $order['order_type'] === 'Delivery' && $status === 'completed') {
            $deliveryManager->updateDeliveryStatus($order_id, "READY");
        }

        // Refresh to show updated status
        $redirect_url = 'manage_orders.php';
        if (isset($_GET['selected'])) {
            $redirect_url .= '?selected=' . $_GET['selected'];
        }
        header("Location: " . $redirect_url . "&updated=1");
        exit;
    }
    
    if (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];
        $orderManager->deleteOrder($order_id);
        
        // Redirect without the deleted order
        header("Location: manage_orders.php?deleted=1");
        exit;
    }
    
    // Get all orders
    $orders = $orderManager->getAllOrders();
    $deliveries = $deliveryManager->getAllDeliveries();
?>

<main class="container">
    <?php 
    include '../includes/admin_nav.php'
    ?>
    
    <section class="manage-orders-section">
        <h1>Orders</h1>
        
        <!-- Success Messages -->
        <?php if (isset($_GET['updated'])): ?>
            <div class="alert alert-success">
                ✅ Order status updated successfully!
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-success">
                ✅ Order deleted successfully!
            </div>
        <?php endif; ?>
        
        <div class="orders-container">
            <!-- LEFT COLUMN: Orders List -->
            <section class="orders-list">
                <h2>All Orders</h2>
                
                <!-- Filter Controls -->
                <div class="filter-controls">
                    <div class="search-box">
                        <input type="text" id="searchOrders" placeholder="Search orders..." 
                               onkeyup="filterOrders()">
                    </div>
                    <div class="status-filter">
                        <select id="statusFilter" onchange="filterOrders()">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="preparing">Preparing</option>
                            <option value="ready">Ready</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="status-filter">
                        <select id="orderTypeFilter" onchange="filterOrderType()">
                            <option value="all">All Types</option>
                            <option value="On Site">On Site</option>
                            <option value="Delivery">Delivery</option>
                        </select>
                    </div>
                </div>
                
                <div class="orders-cards" id="ordersList">
                    <?php if (empty($orders)): ?>
                        <p class="empty-msg">📭 No orders found.</p>
                    <?php else: ?>
                        <?php
                        $deliveryMap = [];
                        foreach ($deliveries as $delivery) {
                            $deliveryMap[$delivery['order_id']] = $delivery;
                        }
                        ?>
                        <?php foreach ($orders as $order): 
                            $order_number = str_pad($order['order_id'], 4, '0', STR_PAD_LEFT);
                            $order_time = date('M d, Y h:i A', strtotime($order['created_at']));
                            $total_formatted = '₱' . number_format($order['total_amount'], 2);
                            $search_text = strtolower($order_number . ' ' . $total_formatted . ' ' . $order['status']);
                        ?>
                        <div class="order-card <?= isset($_GET['selected']) && $_GET['selected'] == $order['order_id'] ? 'active' : '' ?>" 
                             data-order-id="<?= $order['order_id'] ?>"
                             data-status="<?= $order['status'] ?>"
                             data-order-type="<?= $order['order_type'] ?>"
                             data-search="<?= htmlspecialchars($search_text) ?>"
                             onclick="selectOrder(<?= $order['order_id'] ?>)">
                            
                            <div class="order-header">
                                <h3>Order No. <?= $order_number ?></h3>
                                <p>
                                    <strong>Type:</strong>
                                    <?= htmlspecialchars($order['order_type']) ?>
                                </p>
                                <?php if ($order['order_type'] === 'Delivery'): ?>
                                    <?php
                                        $delivery_status = $deliveryMap[$order['order_id']]['delivery_status']
                                            ?? 'PENDING';
                                    ?>
                                    <p>
                                        <strong>Delivery:</strong>
                                        <?= htmlspecialchars($delivery_status) ?>
                                    </p>
                                <?php endif; ?>
                                <span class="status-badge status-<?= $order['status'] ?>">
                                    <?= ucfirst($order['status']) ?>
                                </span>
                            </div>
                            
                            <div class="order-details">
                                <p><strong>Total:</strong> <?= $total_formatted ?></p>
                                <p><strong>Ordered at:</strong> <?= $order_time ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
            
            <!-- RIGHT COLUMN: Order Details -->
            <section class="order-details-panel">
                <h2>Order Details</h2>
                
                <div class="details-content" id="orderDetails">
                    <?php if (isset($_GET['selected']) && !empty($orders)): 
                        $selected_order = null;
                        foreach ($orders as $order) {
                            if ($order['order_id'] == $_GET['selected']) {
                                $selected_order = $order;
                                break;
                            }
                        }
                        
                        if ($selected_order):
                            $order_number = str_pad($selected_order['order_id'], 4, '0', STR_PAD_LEFT);
                            $order_time = date('M d, Y h:i A', strtotime($selected_order['created_at']));
                            $total_formatted = '₱' . number_format($selected_order['total_amount'], 2);
                            
                            // Get order items
                            $order_with_items = $orderManager->getOrderById($selected_order['order_id']);
                            $items = isset($order_with_items['items']) ? $order_with_items['items'] : [];

                            // DELIVERY INFO
                            $selected_delivery = null;

                            foreach ($deliveries as $delivery) {
                                if ($delivery['order_id'] == $selected_order['order_id']) {
                                    $selected_delivery = $delivery;
                                    break;
                                }
                            }
                    ?>
                    
                    <div class="order-info">
                        <h3>Order No. <?= $order_number ?></h3>
                        <p><strong>Ordered at:</strong><?= $order_time ?></p>
                        <p><strong>Order Type:</strong><?= htmlspecialchars($selected_order['order_type']) ?></p>

                        <?php if ($selected_order['order_type'] === 'Delivery'): ?>
                            <p>
                                <strong>Delivery Status:</strong>
                                <span class="current-status">
                                    <?= htmlspecialchars(
                                        $selected_delivery['delivery_status']
                                        ?? 'PENDING'
                                    ) ?>
                                </span>
                            </p>

                            <p>
                                <strong>Customer:</strong>
                                <?= htmlspecialchars(
                                    $selected_delivery['customer_name']
                                    ?? 'N/A'
                                ) ?>
                            </p>

                            <p>
                                <strong>Contact:</strong>
                                <?= htmlspecialchars(
                                    $selected_delivery['contact_number']
                                    ?? 'N/A'
                                ) ?>
                            </p>

                            <p>
                                <strong>Delivery Address:</strong>
                                <?= htmlspecialchars(
                                    $selected_delivery['delivery_location']
                                    ?? 'N/A'
                                ) ?>
                            </p>

                            <p>
                                <strong>Payment Method:</strong>
                                <?= htmlspecialchars(
                                    $selected_delivery['payment_method']
                                    ?? 'N/A'
                                ) ?>
                            </p>

                        <?php endif; ?>

                        <p>
                            <strong>Status:</strong>

                            <span class="current-status status-<?= $selected_order['status'] ?>">
                                <?= ucfirst($selected_order['status']) ?>
                            </span>
                        </p>

                    </div>
                    
                    <div class="order-items">
                        <h4>Items Ordered:</h4>
                        <?php if (!empty($items)): ?>
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $itemManager = new Item();
                                foreach ($items as $item): 
                                    $item_details = $itemManager->getItemById($item['item_id']);
                                    $item_name = $item_details ? $item_details['name'] : 'Item #' . $item['item_id'];
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($item_name) ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>₱<?= number_format($item['price_each'], 2) ?></td>
                                    <td>₱<?= number_format($item['subtotal'], 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                            <p class="no-items">No items found for this order.</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="order-summary">
                        <div class="status-section">
                            <h4>Update Status:</h4>
                            <form method="POST" class="status-form">
                                <input type="hidden" name="order_id" value="<?= $selected_order['order_id'] ?>">
                                <div class="status-controls">
                                    <select name="status" class="status-select">
                                        <option value="pending" <?= $selected_order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="preparing" <?= $selected_order['status'] == 'preparing' ? 'selected' : '' ?>>Preparing</option>
                                        <option value="ready" <?= $selected_order['status'] == 'ready' ? 'selected' : '' ?>>Ready for Pickup</option>
                                        <option value="completed" <?= $selected_order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                                        <option value="cancelled" <?= $selected_order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn-update">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="total-section">
                            <h4>Order Total:</h4>
                            <p class="total-amount"><?= $total_formatted ?></p>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <form method="POST" class="delete-form" 
                              onsubmit="return confirmDelete();">
                            <input type="hidden" name="order_id" value="<?= $selected_order['order_id'] ?>">
                            <button type="submit" name="delete_order" class="btn-delete">
                                🗑️ Delete Order
                            </button>
                        </form>
                    </div>
                    
                    <?php else: ?>
                        <p class="select-msg">⚠️ Order not found. It may have been deleted.</p>
                    <?php endif; ?>
                    
                    <?php else: ?>
                        <div class="welcome-message">
                            <p class="select-msg">👈 Select an order from the list to view details</p>
                            <div class="instructions">
                                <h4>How to use:</h4>
                                <ul>
                                    <li>Click on any order card to view details</li>
                                    <li>Use the search box to find specific orders</li>
                                    <li>Filter by status using the dropdown</li>
                                    <li>Update order status using the dropdown in details panel</li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </section>
</main>

<script>
function selectOrder(orderId) {
    // Redirect to same page with selected order
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('selected', orderId);
    window.location.href = currentUrl.toString();
}

function applyFilters() {
    const searchInput = document.getElementById('searchOrders').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const typeFilter = document.getElementById('orderTypeFilter').value;

    const orderCards = document.querySelectorAll('.order-card');

    let visibleCount = 0;

    orderCards.forEach(card => {
        const searchText = card.getAttribute('data-search');
        const cardStatus = card.getAttribute('data-status');
        const cardType = card.getAttribute('data-order-type');

        const matchesSearch = searchText.includes(searchInput);
        const matchesStatus = statusFilter === 'all' || cardStatus === statusFilter;
        const matchesType = typeFilter === 'all' || cardType === typeFilter;

        if (matchesSearch && matchesStatus && matchesType) {
            card.style.display = 'block';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
}

function confirmDelete() {
    return confirm('⚠️ Are you sure you want to DELETE this order?\n\nThis action cannot be undone!');
}

// Auto-select order from URL parameter on page load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const selectedOrder = urlParams.get('selected');
    
    if (selectedOrder) {
        // Scroll to selected order card
        const selectedCard = document.querySelector(`.order-card[data-order-id="${selectedOrder}"]`);
        if (selectedCard) {
            setTimeout(() => {
                selectedCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 100);
        }
    }
    
    // Set filter dropdown to match current status if order is selected
    if (selectedOrder) {
        const selectedCard = document.querySelector(`.order-card[data-order-id="${selectedOrder}"]`);
        if (selectedCard) {
            const status = selectedCard.getAttribute('data-status');
            document.getElementById('statusFilter').value = status;
        }
    }
});
</script>

<?php include '../includes/footer.php'; ?>
