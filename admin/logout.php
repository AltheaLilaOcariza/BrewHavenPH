<?php 
    $title = "Logout | BrewHaven Cafe";
    $extra_css = ['../assets/css/includes.css'];
    include '../includes/header.php';
?>

<style>
    .logout-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #FAF9F6 0%, #FFD88F 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .logout-card {
        background: white;
        padding: 50px 40px;
        border-radius: 25px;
        box-shadow: 0 20px 60px rgba(160, 82, 45, 0.15);
        border: 3px solid #FFD88F;
        width: 100%;
        max-width: 500px;
        text-align: center;
    }

    .logout-icon {
        width: 100px;
        height: 100px;
        margin: 0 auto 30px;
        background: #FFD88F;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5em;
        color: #A0522D;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .logout-title {
        color: #A0522D;
        font-size: 2.5em;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .logout-message {
        color: #5a3927;
        font-size: 1.2em;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .logout-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
    }

    .logout-btn {
        background: linear-gradient(135deg, #D04F4F 0%, #C0392B 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 8px 25px rgba(208, 79, 79, 0.3);
    }

    .logout-btn:hover {
        background: linear-gradient(135deg, #FFD88F 0%, #F4D03F 100%);
        color: #A0522D;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 216, 143, 0.4);
    }

    .cancel-btn {
        background: linear-gradient(135deg, #5a3927 0%, #3E2723 100%);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 8px 25px rgba(90, 57, 39, 0.3);
    }

    .cancel-btn:hover {
        background: linear-gradient(135deg, #FFD88F 0%, #F4D03F 100%);
        color: #A0522D;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 216, 143, 0.4);
    }

    .countdown {
        font-size: 1.1em;
        color: #D04F4F;
        font-weight: bold;
        margin: 20px 0;
    }

    .login-footer {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #FFD88F;
    }

    .brand-footer {
        color: #A0522D;
        font-size: 1.3em;
        font-weight: 700;
        margin-top: 20px;
    }

    @media (max-width: 480px) {
        .logout-card {
            padding: 40px 25px;
        }
        
        .logout-title {
            font-size: 2em;
        }
        
        .logout-actions {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<div class="logout-container">
    <div class="logout-card">
        <div class="logout-icon">👋</div>
        <h1 class="logout-title">Logging Out</h1>
        <p class="logout-message">You are about to be logged out of the BrewHaven Cafe Admin Panel.</p>
        
        <div class="countdown" id="countdown">Redirecting in 5 seconds...</div>

        <div class="logout-actions">
            <button class="logout-btn" onclick="confirmLogout()">Yes, Log Me Out</button>
            <a href="dashboard.php" class="cancel-btn">Cancel & Go Back</a>
        </div>

        <div class="login-footer">
            <div class="brand-footer">BREWHAVEN CAFE</div>
        </div>
    </div>
</div>

<script>
    let countdown = 5;
    let countdownInterval;
    
    function startCountdown() {
        countdownInterval = setInterval(function() {
            countdown--;
            document.getElementById('countdown').textContent = `Redirecting in ${countdown} seconds...`;
            
            if (countdown <= 0) {
                performLogout();
            }
        }, 1000);
    }
    
    function confirmLogout() {
        performLogout();
    }
    
    function performLogout() {
        clearInterval(countdownInterval);
        
        // Show success message
        document.querySelector('.logout-message').textContent = 'You have been successfully logged out!';
        document.querySelector('.logout-title').textContent = 'Logged Out';
        document.querySelector('.logout-icon').innerHTML = '✅';
        document.getElementById('countdown').textContent = 'Redirecting to login page...';
        
        // Hide action buttons
        document.querySelector('.logout-actions').style.display = 'none';
        
        // Simulate logout and redirect
        setTimeout(function() {
            alert('Logout successful! Session cleared.');
            window.location.href = 'login.php';
        }, 2000);
    }
    
    // Start countdown when page loads
    document.addEventListener('DOMContentLoaded', function() {
        startCountdown();
    });
</script>

<?php include '../includes/footer.php'; ?>
