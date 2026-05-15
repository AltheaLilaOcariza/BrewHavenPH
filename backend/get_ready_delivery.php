<?php
session_start();
header("Content-Type: application/json");

require_once "functions.php";

$deliveryDAO = new DeliveriesDAO();

// 🔥 CHECK SESSION FIRST
$currentDeliveryID = $_SESSION['currentDeliveryID'] ?? null;
$isOnDelivery = $_SESSION['isOnDelivery'] ?? false;

// If already on delivery → return same order
if ($isOnDelivery && $currentDeliveryID) {

    $delivery = $deliveryDAO->getDeliveryById($currentDeliveryID);

    // 🔥 CASE 1: delivery not found → unlock session
    if (!$delivery) {
        $_SESSION['currentDeliveryID'] = null;
        $_SESSION['isOnDelivery'] = false;

        echo json_encode([
            "success" => false,
            "locked" => false
        ]);
        exit;
    }

    // 🔥 CASE 2: delivery already completed → unlock session
    if ($delivery['delivery_status'] === 'DELIVERED') {
        $_SESSION['currentDeliveryID'] = null;
        $_SESSION['isOnDelivery'] = false;

        echo json_encode([
            "success" => false,
            "locked" => false
        ]);
        exit;
    }

    // 🔥 CASE 3: still active delivery → keep locked
    echo json_encode([
        "success" => true,
        "delivery" => $delivery,
        "locked" => true
    ]);
    exit;
}

// Otherwise fetch READY delivery
$delivery = $deliveryDAO->getDriverDeliveriesWithStatus("READY");

if ($delivery) {

    echo json_encode([
        "success" => true,
        "delivery" => $delivery
    ]);

} else {

    echo json_encode([
        "success" => false
    ]);
}