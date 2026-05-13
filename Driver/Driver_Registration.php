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
    <style>
        /* ==================== CSS RESET & GLOBAL ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 2rem;
            position: relative;
            background-image: url('BREWHAVEN DELIVERY bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            pointer-events: none;
            z-index: 0;
        }

        .card-container {
            position: relative;
            z-index: 1;
            perspective: 1600px;
            width: 100%;
            max-width: 540px;
            margin-left: 3rem;
            margin-right: auto;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .flipper {
            position: relative;
            width: 100%;
            transition: transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
            transform-style: preserve-3d;
            border-radius: 2rem;
        }

        .flipper.flipped {
            transform: rotateY(180deg);
        }

        .front, .back {
            position: relative;
            width: 100%;
            backface-visibility: hidden;
            border-radius: 2rem;
            background: rgba(255, 248, 235, 0.96);
            box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.45), 0 4px 12px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2px);
        }

        .front {
            transform: rotateY(0deg);
        }

        .back {
            transform: rotateY(180deg);
            position: absolute;
            top: 0;
            left: 0;
        }

        .diagonal-badge {
            position: absolute;
            top: 0;
            right: 0;
            width: 220px;
            height: 220px;
            overflow: hidden;
            pointer-events: none;
            z-index: 5;
        }

        .diagonal-badge .diagonal-text {
            position: absolute;
            top: 36px;
            right: -45px;
            transform: rotate(45deg);
            background: linear-gradient(125deg, #c28a4a, #a5672f);
            color: #fff7e8;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 0.5rem 2.8rem;
            text-align: center;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            width: 260px;
            font-family: 'Inter', monospace;
            text-transform: uppercase;
        }

        .front .diagonal-badge .diagonal-text {
            background: linear-gradient(125deg, #b97f44, #8b5a2b);
            font-size: 1rem;
        }

        .back .diagonal-badge .diagonal-text {
            background: linear-gradient(125deg, #b97f44, #8b5a2b);
            font-size: 0.95rem;
        }

        .card-inner {
            padding: 2rem 1.8rem 2.2rem 1.8rem;
        }

        .cafe-title {
            font-size: 1.7rem;
            font-weight: 700;
            color: #3e2a1f;
            border-left: 6px solid #c28a4a;
            padding-left: 1rem;
            margin-bottom: 1.5rem;
            letter-spacing: -0.3px;
        }

        .cafe-title i {
            color: #c28a4a;
            margin-right: 8px;
        }

        .form-group {
            margin-bottom: 1.1rem;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b4c2c;
            margin-bottom: 0.3rem;
        }

        .input-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon i {
            position: absolute;
            left: 14px;
            color: #b87a40;
            font-size: 1rem;
        }

        .input-icon input, .input-icon select {
            width: 100%;
            padding: 0.75rem 0.8rem 0.75rem 2.3rem;
            border: 1px solid #e2cfb5;
            border-radius: 1.8rem;
            background: white;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            transition: all 0.2s;
            outline: none;
            color: #2c241a;
        }

        .input-icon select {
            padding-left: 2.3rem;
            cursor: pointer;
        }

        .input-icon input:focus, .input-icon select:focus {
            border-color: #c28a4a;
            box-shadow: 0 0 0 3px rgba(194, 138, 74, 0.2);
        }

        .row-2cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.9rem;
        }

        .btn {
            background: #c28a4a;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 2.5rem;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.7rem;
            width: 100%;
            margin-top: 0.5rem;
            font-family: 'Inter', sans-serif;
            text-decoration: none;
        }

        .btn:hover {
            background: #a5723c;
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
        }

        .switch-prompt {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6f5e4e;
        }

        .switch-prompt span {
            color: #c28a4a;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
        }

        hr {
            margin: 1rem 0;
            border: 0;
            height: 1px;
            background: linear-gradient(to right, #e2cfb5, transparent);
        }

        @media (max-width: 768px) {
            body {
                justify-content: center;
                padding: 1.5rem;
            }
            .card-container {
                margin-left: 0;
                max-width: 100%;
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .card-inner {
                padding: 1.5rem;
            }
            .row-2cols {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }
            .diagonal-badge .diagonal-text {
                font-size: 0.75rem;
                padding: 0.4rem 2rem;
                top: 28px;
                right: -55px;
            }
        }
    </style>
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
                <form id="loginForm" method="POST" action="login_driver.php">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-icon">
                            <i class="fas fa-user-circle"></i>
                            <input type="text" id="loginUsername" name="loginUsername" placeholder="Enter username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                            <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn"><i class="fas fa-mug-hot"></i> Login & Start Delivering</button>
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

<!-- MINIMAL 21 LINES OF JS FOR FLIP ANIMATION ONLY -->
<script>
    const flipper = document.getElementById('cardFlipper');
    const showLogin = document.getElementById('showLogin');
    const showRegister = document.getElementById('showRegister');

    showLogin.addEventListener('click', () => {
        flipper.classList.add('flipped');
        document.getElementById('loginUsername').focus();
    });

    showRegister.addEventListener('click', () => {
        flipper.classList.remove('flipped');
    });

    // =========================
    // DRIVER REGISTRATION
    // =========================

    document.getElementById('registrationForm')
        .addEventListener('submit', async function (e) {

        e.preventDefault();

        const message = document.getElementById('registerMessage');

        const formData = new FormData(this);

        // Check empty fields
        for (let pair of formData.entries()) {

            if (pair[1].trim() === "") {

                message.innerText = "All fields need to be filled.";
                message.style.color = "#cc3333";

                return;
            }
        }

        try {

            const response = await fetch('register_driver.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {

                message.innerText = data.message;
                message.style.color = "#2d9c5a";

                // optional flip after success
                setTimeout(() => {
                    flipper.classList.add('flipped');
                }, 1200);

                this.reset();

            } else {

                message.innerText = data.message;
                message.style.color = "#cc3333";
            }

        } catch (err) {

            message.innerText = "Server error occurred.";
            message.style.color = "#cc3333";
        }
    });

    // =========================
    // DRIVER LOGIN
    // =========================

    document.getElementById('loginForm')
        .addEventListener('submit', async function (e) {

        e.preventDefault();

        const formData = new FormData(this);

        try {

            const response = await fetch('login_driver.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {

                window.location.href = "Dashboard.php";

            } else {

                alert(data.message);
            }

        } catch (err) {

            alert("Server error occurred.");
        }
    });
</script>

</body>
</html>