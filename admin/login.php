<?php 
    $title = "Admin Login | BrewHaven Cafe";
    $extra_css = ['../assets/css/includes.css'];
    include '../includes/header.php';
?>

<style>
    .login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #FAF9F6 0%, #FFD88F 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .login-card {
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
        margin-bottom: 40px;
        font-size: 1.1em;
    }

    .login-form .form-group {
        margin-bottom: 25px;
        text-align: left;
    }

    .login-form label {
        display: block;
        color: #3E2723;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 1em;
    }

    .login-form input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #FFD88F;
        border-radius: 15px;
        font-size: 1em;
        background: #FAF9F6;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .login-form input:focus {
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
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #FFD88F;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 25px;
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
        margin-top: 20px;
    }

    .demo-credentials {
        background: #F5F5DC;
        padding: 20px;
        border-radius: 15px;
        margin: 25px 0;
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

    @media (max-width: 480px) {
        .login-card {
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

<div class="login-container">
    <div class="login-card">
        <div class="login-logo">☕</div>
        <h1 class="login-title">Admin Login</h1>
        <p class="login-subtitle">BrewHaven Cafe Management System</p>
        
        <!-- Demo Credentials -->
        <div class="demo-credentials">
            <h4>Demo Credentials (For Testing):</h4>
            <p><strong>Username:</strong> admin</p>
            <p><strong>Password:</strong> brewhaven123</p>
        </div>

        <form class="login-form" id="adminLoginForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('adminLoginForm');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Final credentials validation
            if (username === 'admin' && password === 'brewhaven123') {
                alert('Login successful! Redirecting to admin dashboard...');
                // For now, redirect to dashboard placeholder
                window.location.href = 'dashboard.php';
            } else {
                alert('Invalid credentials! Please use:\nUsername: admin\nPassword: brewhaven123');
            }
        });

        // Auto-fill demo credentials for testing
        document.getElementById('username').value = 'admin';
        document.getElementById('password').value = 'brewhaven123';
    });
</script>

<?php include '../includes/footer.php'; ?>
