<?php
require 'functions.php'; // Your DAO class
$orderDao = new OrderDAO();
$monthlySales = $orderDao->getMonthlySales();

// Prepare arrays for labels and data
$months = [];
$sales = [];

foreach ($monthlySales as $row) {
    $dateObj = DateTime::createFromFormat('Y-m', $row['month']);
    $months[] = $dateObj->format('M - Y'); // e.g., 'Dec - 2025'
    $sales[] = $row['total_sales'];
}

// Return JSON
echo json_encode([
    'months' => $months,
    'sales' => $sales
]);


?>