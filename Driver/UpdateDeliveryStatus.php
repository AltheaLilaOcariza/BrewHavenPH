<?php
session_start();
header("Content-Type: application/json");

require_once "functions.php";

$deliveryDAO = new DeliveriesDAO();

if (!isset($_SESSION['currentDeliveryID'])) {
    echo json_encode([
        "success" => false,
        "message" => "No active delivery"
    ]);
    exit;
}

if (!isset($_POST['status'])) {
    echo json_encode([
        "success" => false,
        "message" => "No status provided"
    ]);
    exit;
}

$deliveryId = $_SESSION['currentDeliveryID'];
$status = $_POST['status'];

$updated = $deliveryDAO->updateDeliveryStatus($deliveryId, $status);

if ($updated) {

    // remove active delivery if finished
    if ($status === "Completed" || $status === "Failed") {

        unset($_SESSION['currentDeliveryID']);
        unset($_SESSION['isOnDelivery']);
    }

    echo json_encode([
        "success" => true,
        "message" => "Delivery updated"
    ]);
}
else {
    echo json_encode([
        "success" => false,
        "message" => "Update failed"
    ]);
}
?>