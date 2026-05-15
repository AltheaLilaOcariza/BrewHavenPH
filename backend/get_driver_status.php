<?php
session_start();

require_once "../backend/functions.php";

header('Content-Type: application/json');

if (!isset($_SESSION['driver_id'])) {
    echo json_encode([
        "success" => false
    ]);
    exit();
}

$driver_id = $_SESSION['driver_id'];

$driverDAO = new DriverDAO();

$driver = $driverDAO->getDriverByID($driver_id);

echo json_encode([
    "success" => true,
    "status" => $driver['driver_status']
]);
?>