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

    if (!$delivery) {
        echo json_encode([
            "success" => false,
            "error" => "Delivery not found in database"
        ]);
        exit;
    }

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