<?php
session_start();
require 'functions.php';
$orders = new OrderDAO();
$deliveries = new DeliveriesDAO();

$orderID = $orders->getLastOrderId();

if (isset($_POST['confirm'])) {

    // =========================
    // GET FORM DATA
    // =========================
    $customer_name   = $_POST['customer_name'] ?? '';
    $pickup_location = "BrewHaven PH Store";
    $address         = $_POST['address'] ?? '';
    $payment_method  = $_POST['payment_method'] ?? '';
    $contact_number  = $_POST['contact_number'] ?? '';
    $message         = $_POST['customer_message'] ?? '';


    $success = $deliveries->fillDeliveries($orderID, $customer_name, $contact_number, $message, $pickup_location, $address, $payment_method);

    /*$query = "INSERT INTO orders 
            (customer_name, address, total_amount)
            VALUES 
            ('$customer_name', '$address', '$total')";
    */

    
    // =========================
    // CLEAR CART
    // =========================
    unset($_SESSION['cart']);

    header("Location: ../pages/menu.php");
    exit();
}

if(isset($_POST['cancel'])){
    unset($_SESSION['cart']);
    header("Location: ../pages/menu.php");
    exit();
}

?>