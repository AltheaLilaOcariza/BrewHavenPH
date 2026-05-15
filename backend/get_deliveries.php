<?php

header("Content-Type: application/json");

require_once "functions.php";

$deliveryManager = new DeliveriesDAO();

$deliveries = $deliveryManager->getAllDeliveries();

echo json_encode([
    "success" => true,
    "deliveries" => $deliveries
]);