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
$driverId = $_SESSION['driver_id'] ?? null;


if (!$driverId) {
    echo json_encode([
        "success" => false,
        "message" => "Driver not logged in"
    ]);
    exit;
}

$_SESSION['currentDeliveryID'] = $deliveryId;
$_SESSION['isOnDelivery'] = true;

$deliveryDAO->assignDriverToDelivery($driverId, $deliveryId);

echo json_encode([
    "success" => true,
    "delivery_id" => $deliveryId
]);
?>