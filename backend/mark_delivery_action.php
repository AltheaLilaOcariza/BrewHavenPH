<?php
require_once '../backend/functions.php';
$deliveryManager = new DeliveriesDAO();
session_start();

$currentDeliveryID = $_SESSION['currentDeliveryID'];

if (isset($_POST['btnPickup'])) {

    $deliveryManager ->setDeliveryStatus($currentDeliveryID, "PICKED UP");
    header("Location: ../Driver/Deliveries.php");
}

if (isset($_POST['btnDelivered'])) {
    $deliveryManager ->setDeliveryStatus($currentDeliveryID, "DELIVERED");
    header("Location: ../Driver/Deliveries.php");
}


?>