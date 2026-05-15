<?php
session_start();

require_once "../backend/functions.php";

header('Content-Type: application/json');

if (!isset($_SESSION['driver_id'])) {

    echo json_encode([
        "success" => false,
        "message" => "Driver not logged in"
    ]);

    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $driver_id = $_SESSION['driver_id'];

    $status = $_POST['status'];

    $driverDAO = new DriverDAO();

    $updated = $driverDAO->updateDriverStatusByID($driver_id, $status);

    echo json_encode([
        "success" => $updated
    ]);
}
?>