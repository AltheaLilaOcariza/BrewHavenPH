<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $licenseNo = mysqli_real_escape_string($conn, $_POST['licenseNo']);
    $plateNo = mysqli_real_escape_string($conn, $_POST['plateNo']);
    $vehicleType = mysqli_real_escape_string($conn, $_POST['vehicleType']);
    $contactNo = mysqli_real_escape_string($conn, $_POST['contactNo']);
    
    // Check if user exists
    $check = mysqli_query($conn, "SELECT id FROM drivers WHERE username = '$username' OR email = '$email' OR licenseNo = '$licenseNo'");
    
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Username, Email, or License already exists!']);
        exit();
    }
    
    $sql = "INSERT INTO drivers (fullname, email, username, password, licenseNo, plateNo, vehicleType, contactNo) 
            VALUES ('$fullname', '$email', '$username', '$password', '$licenseNo', '$plateNo', '$vehicleType', '$contactNo')";
    
    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Registration successful!'
        ]);
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registration failed: ' . mysqli_error($conn)]);
    }
    
    mysqli_close($conn);
}
?>