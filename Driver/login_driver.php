<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['loginUsername']);
    $password = trim($_POST['loginPassword']);

    // CHECK DRIVER
    $sql = "SELECT * FROM drivers WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $driver = $result->fetch_assoc();

        // VERIFY PASSWORD
        if (password_verify($password, $driver['password'])) {

            // CREATE SESSION
            $_SESSION['driver_id'] = $driver['id'];
            $_SESSION['driver_name'] = $driver['fullname'];
            $_SESSION['logged_in'] = true;

            echo json_encode([
                "status" => "success",
                "message" => "Login successful",
                "fullname" => $driver['fullname']
            ]);

        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid password"
            ]);
        }

    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Driver not found"
        ]);
    }
}
?>


