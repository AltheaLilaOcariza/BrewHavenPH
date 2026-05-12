<?php
session_start();
require 'functions.php';
$manager = new OrderDAO();

$order_id = $_GET['order_id'];

$query = "SELECT status,
            TIMESTAMPDIFF(SECOND, NOW(), ready_at) AS time_left
          FROM orders
          WHERE id = $order_id";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if($row['time_left'] <= 0 && $row['status'] == 'preparing'){
    mysqli_query($conn, "UPDATE orders SET status='ready' WHERE id = $order_id");
    $row['status'] = 'ready';
    $row['time_left'] = 0;
}

echo json_encode($row);
?>