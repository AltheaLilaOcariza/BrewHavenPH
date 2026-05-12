<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'brewhavenph';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . mysqli_connect_error()]));
}
?>