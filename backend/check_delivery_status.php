<?php
session_start();
header("Content-Type: application/json");

require_once "functions.php";

$deliveryDAO = new DeliveriesDAO();

$id = $_GET['id'] ?? null;

$status = $deliveryDAO->getDeliveryStatus($id);

if ($status === "DELIVERED") {

    // 🔥 CLEAR SESSION ONLY WHEN DONE
    unset($_SESSION['currentDeliveryID']);
    unset($_SESSION['isOnDelivery']);

}

echo json_encode([
    "status" => $status
]);