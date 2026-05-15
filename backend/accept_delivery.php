<?php
session_start();
header("Content-Type: application/json");

require_once "functions.php";

$deliveryDAO = new DeliveriesDAO();

if (!isset($_POST['delivery_id'])) {
    echo json_encode([
        "success" => false,
        "message" => "No delivery ID"
    ]);
    exit;
}

$deliveryId = $_POST['delivery_id'];
$driverId = $_SESSION['driver_id'];

// store in session 🔥 THIS is what you were asking about
$_SESSION['currentDeliveryID'] = $deliveryId;
$_SESSION['isOnDelivery'] = true;

// optional DB update (recommended)
$deliveryDAO->assignDriverToDelivery($driverId, $deliveryId);

echo json_encode([
    "success" => true,
    "message" => "Delivery accepted"
]);