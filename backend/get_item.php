<?php
require 'functions.php';
header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Missing ID"]);
    exit;
}

$item = new Item();
$data = $item->getItemById($_GET['id']);

echo json_encode($data);
?>
