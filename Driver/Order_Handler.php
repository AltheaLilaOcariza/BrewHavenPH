<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$conn = mysqli_connect("localhost", "root", "", "brewhavenph");

if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'DB connection failed']);
    exit;
}

/* =========================
   GET PENDING ORDERS
========================= */
if (isset($_GET['api']) && $_GET['api'] === 'get_pending_orders') {

    $sql = "SELECT 
                o.order_id,
                o.total_amount,
                o.status,
                o.order_type,
                o.created_at,
                GROUP_CONCAT(CONCAT(i.name, ' x', oi.quantity) SEPARATOR ', ') AS items_list
            FROM orders o
            JOIN order_items oi ON o.order_id = oi.order_id
            JOIN items i ON oi.item_id = i.item_id
            WHERE o.status = 'pending'
            GROUP BY o.order_id
            ORDER BY o.order_id ASC";

    $result = mysqli_query($conn, $sql);

    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    echo json_encode($orders);
    exit;
}

/* =========================
   ACCEPT ORDER
========================= */
if (isset($_GET['action']) && $_GET['action'] === 'accept_order') {

    $data = json_decode(file_get_contents("php://input"), true);
    $order_id = $data['order_id'] ?? null;

    if (!$order_id) {
        echo json_encode(['success' => false, 'message' => 'Missing order ID']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE orders SET status='accepted' WHERE order_id=?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    exit;
}

/* =========================
   DECLINE ORDER
========================= */
if (isset($_GET['action']) && $_GET['action'] === 'decline_order') {

    $data = json_decode(file_get_contents("php://input"), true);
    $order_id = $data['order_id'] ?? null;

    if (!$order_id) {
        echo json_encode(['success' => false, 'message' => 'Missing order ID']);
        exit;
    }

    $stmt = $conn->prepare("UPDATE orders SET status='declined' WHERE order_id=?");
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    exit;
}

/* =========================
   QUEUE COUNT
========================= */
if (isset($_GET['api']) && $_GET['api'] === 'get_queue_count') {

    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM orders WHERE status='pending'");
    $row = mysqli_fetch_assoc($result);

    echo json_encode(['count' => (int)$row['count']]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);