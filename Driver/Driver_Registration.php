<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Brewhaven Caffe | Driver Portal</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="Driver_Registration.css">
</head>
<body>

<div class="card-container">
    <div class="flipper" id="cardFlipper">
        <!-- FRONT SIDE: DRIVER REGISTRATION -->
        <div class="front">
            <div class="diagonal-badge">
                <div class="diagonal-text">☕ BREWHAVEN CAFFE ☕</div>
            </div>
            <div class="card-inner">
                <div class="cafe-title">
                    <i class="fas fa-truck"></i> Driver Registration
                </div>
                <form id="registrationForm" method="POST" action="register_driver.php">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" id="fullname" name="fullname" placeholder="Juan Dela Cruz" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row-2cols">
                        <div class="form-group">
                            <label>Email *</label>
                            <div class="input-icon">
                                <i class="fas fa-envelope"></i>
                                <input type="email" id="email" name="email" placeholder="driver@example.com" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Username *</label>
                            <div class="input-icon">
                                <i class="fas fa-at"></i>
                                <input type="text" id="regUsername" name="username" placeholder="username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row-2cols">
                        <div class="form-group">
                            <label>Password *</label>
                            <div class="input-icon">
                                <i class="fas fa-lock"></i>
                                <input type="password" id="regPassword" name="password" placeholder="••••••" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>License No. *</label>
                            <div class="input-icon">
                                <i class="fas fa-id-card"></i>
                                <input type="text" id="licenseNo" name="licenseNo" placeholder="DL123456" required>
                            </div>
                        </div>
                    </div>
                    <div class="row-2cols">
                        <div class="form-group">
                            <label>Plate Number *</label>
                            <div class="input-icon">
                                <i class="fas fa-car"></i>
                                <input type="text" id="plateNo" name="plateNo" placeholder="ABC-1234" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Vehicle Type *</label>
                            <div class="input-icon">
                                <i class="fas fa-motorcycle"></i>
                                <select id="vehicleType" name="vehicleType" required>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Van">Van</option>
                                    <option value="Motorcycle">Motorcycle</option>
                                    <option value="Pickup">Pickup Truck</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Contact No. *</label>
                        <div class="input-icon">
                            <i class="fas fa-phone-alt"></i>
                            <input type="tel" id="contactNo" name="contactNo" placeholder="+63 912 345 6789" required>
                        </div>
                    </div>
                    <button type="submit" class="btn" id="registerBtn"><i class="fas fa-user-plus"></i> Register as Driver</button>
                    <p id="registerMessage"
                    style="font-size: 0.85rem; color:#b9a68b; margin-top:0.8rem; text-align:center;">
                        * All fields are required
                    </p>
                </form>
                <div class="switch-prompt">
                    Already have an account? <span id="showLogin">Log in →</span>
                </div>
                <hr>
                <div style="font-size: 0.7rem; color:#b9a68b; text-align:center;">✦ Join Brewhaven Cafe ✦</div>
            </div>
        </div>

        <!-- BACK SIDE: LOGIN PANEL -->
        <div class="back">
            <div class="diagonal-badge">
                <div class="diagonal-text">☕ WELCOME BACK ☕</div>
            </div>
            <div class="card-inner">
                <div class="cafe-title">
                    <i class="fas fa-sign-in-alt"></i> Driver Login
                </div>
                <form id="loginForm">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-icon">
                            <i class="fas fa-user-circle"></i>
                            <input type="text"
                                id="loginUsername"
                                name="loginUsername"
                                placeholder="Enter username"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                            <input type="password"
                                id="loginPassword"
                                name="loginPassword"
                                placeholder="Enter password"
                                required>
                        </div>
                    </div>

                    <button type="submit" class="btn">
                        <i class="fas fa-mug-hot"></i>
                        Login & Start Delivering
                    </button>
                </form>
                <div class="switch-prompt">
                    New driver? <span id="showRegister">Create account →</span>
                </div>
                <hr>
                <div style="font-size: 0.7rem; color:#b9a68b; text-align:center;"> ✦ brewhaven tradition</div>
            </div>
        </div>
    </div>
</div>

<!-- Custom JS -->
<script src="Driver_Registration.js"></script>

</body>
</html>