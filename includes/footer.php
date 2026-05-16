
<?php
if (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) {
    echo '<script src="../assets/js/admin.js"></script>';
}
?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const staffLogin = document.querySelector('.staff-login');
        const currentPath = window.location.pathname;

        if (staffLogin) {
            if (currentPath.includes('/admin/')) {
                staffLogin.style.display = 'none';
            } else {
                staffLogin.style.display = 'inline';
            }
        }
    });
</script>

<script src="../assets/js/cart.js"></script>

</body>
<footer class="main-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>BrewHaven Cafe PH</h3>
            <p>Your Kapihan, Your Haven</p>
            <p>Experience the perfect blend of Filipino hospitality and artisan coffee.</p>
        </div>
        
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="pages/menu.php">Menu</a></li>
                <li><a href="pages/about.php">About Us</a></li>
                <li><a href="pages/contact.php">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Contact Info</h4>
            <p>📍 Cebu City, Cebu</p>
            <p>📞 (02) 8123-4567</p>
            <p>✉️ hello@brewhaven.com</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2025 BrewHaven Cafe PH. All rights reserved. 
        <small class="staff-login"><a href=<?= $login_link ?> style="color: #FFD88F;">| Staff Login</a></small>
        </p>
    </div>
</footer>
