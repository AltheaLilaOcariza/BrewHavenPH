<?php
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "brewhavenph");
    $conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo 'Database connected successfully';
    }
?>