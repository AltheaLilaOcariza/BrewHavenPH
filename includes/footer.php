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
                <li><a href="pages/about.html">About Us</a></li>
                <li><a href="pages/contact.html">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4>Contact Info</h4>
            <p>📍 Cebu City, Cebu</p>
            <p>📞 (02) 8123-4567</p>
            <p>✉️ hello@brewhaven.com</p>
        </div>
        
    
    <div class="footer-bottom">
        <p>&copy; 2025 BrewHaven Cafe PH. All rights reserved.</p>
    </div>
</footer>
<?php
// Print any extra JS files enqueued by pages. Pages can set $extra_js = ['path/to/file.js', ...]
if (isset($extra_js) && is_array($extra_js)) {
    foreach ($extra_js as $js_file) {
        echo '<script src="' . htmlspecialchars($js_file, ENT_QUOTES) . '"></script>' . PHP_EOL;
    }
}
?>
