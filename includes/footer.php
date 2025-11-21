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
                <li><a href="../index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
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
        <small id="staff-login"><a href="admin/login.php" style="color: #FFD88F;">| Staff Login</a></small>
        </p>
    </div>
</footer>

<script>

    // Staff Login Link Toggle
    const staffLogin = document.getElementById('staff-login');
    const currentPath = window.location.pathname;

    if (currentPath.includes('/admin/')) {
        staffLogin.style.display = 'none';
    } else {
        staffLogin.style.display = 'inline';
    }

</script>