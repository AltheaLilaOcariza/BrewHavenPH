//please disregard this sa huhu
//welp i guess goods ramn
<?php
// Start session for admin login
session_start();

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Demo credentials - replace with database check later
    if ($username === 'admin' && $password === 'brewhaven123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials! Use: admin / brewhaven123";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | BrewHaven Cafe</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FAF9F6 0%, #FFD88F 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 50px 40px;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(160, 82, 45, 0.15);
            border: 3px solid #FFD88F;
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #FFD88F;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            color: #A0522D;
        }

        .login-title {
            color: #A0522D;
            font-size: 2.2em;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-subtitle {
            color: #5a3927;
            margin-bottom: 30px;
            font-size: 1.1em;
        }

        .error-message {
            background: #FFE6E6;
            color: #D04F4F;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #D04F4F;
        }

        .demo-credentials {
            background: #F5F5DC;
            padding: 20px;
            border-radius: 15px;
            margin: 20px 0;
            border: 1px solid #A0522D;
        }

        .demo-credentials h4 {
            color: #A0522D;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        .demo-credentials p {
            color: #5a3927;
            margin: 5px 0;
            font-size: 0.95em;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            display: block;
            color: #3E2723;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 1em;
        }

        .form-group input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #FFD88F;
            border-radius: 15px;
            font-size: 1em;
            background: #FAF9F6;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #A0522D;
            background: white;
            box-shadow: 0 0 15px rgba(160, 82, 45, 0.2);
        }

        .login-btn {
            background: linear-gradient(135deg, #D04F4F 0%, #C0392B 100%);
            color: white;
            border: none;
            padding: 18px 35px;
            border-radius: 30px;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin: 10px 0 25px;
            box-shadow: 0 8px 25px rgba(208, 79, 79, 0.3);
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #FFD88F 0%, #F4D03F 100%);
            color: #A0522D;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 216, 143, 0.4);
        }

        .login-footer {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid #FFD88F;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .footer-links a {
            color: #5a3927;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #A0522D;
        }

        .brand-footer {
            color: #A0522D;
            font-size: 1.3em;
            font-weight: 700;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 40px 25px;
            }
            
            .login-title {
                font-size: 1.8em;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">☕</div>
        <h1 class="login-title">Admin Login</h1>
        <p class="login-subtitle">BrewHaven Cafe Management System</p>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <h4>Demo Credentials:</h4>
            <p><strong>Username:</strong> admin</p>
            <p><strong>Password:</strong> brewhaven123</p>
        </div>

        <form method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required 
                       value="<?php echo htmlspecialchars($_POST['username'] ?? 'admin'); ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required 
                       value="brewhaven123">
            </div>

            <button type="submit" class="login-btn">Login to Dashboard</button>
        </form>

        <div class="login-footer">
            <div class="footer-links">
                <a href="../pages/contact.html">Contacts</a>
                <a href="../pages/about.html">About us</a>
                <a href="../pages/faq.html">FAQs</a>
            </div>
            <div class="brand-footer">BREWHAVEN CAFE</div>
        </div>
    </div>
</body>
</html>
