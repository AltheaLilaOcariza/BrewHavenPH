<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs | BrewHaven Cafe PH</title>
    <link rel="stylesheet" href="../assets/css/includes.css">
    <style>
        /* FAQ Page Specific Styles */
        .faq-hero {
            background: linear-gradient(135deg, #FAF9F6 0%, #FFD88F 100%);
            padding: 80px 40px;
            text-align: center;
        }

        .faq-hero h1 {
            font-size: 3.5em;
            color: #3E2723;
            margin-bottom: 20px;
            font-weight: 800;
        }

        .faq-hero .subtitle {
            font-size: 1.3em;
            color: #A0522D;
            max-width: 600px;
            margin: 0 auto;
        }

        .faq-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 60px 40px;
            background: #FAF9F6;
        }

        .faq-categories {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .category-btn {
            background: #FFFFFF;
            color: #A0522D;
            border: 2px solid #FFD88F;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-btn.active,
        .category-btn:hover {
            background: #FFD88F;
            color: #A0522D;
            transform: translateY(-2px);
        }

        .faq-section {
            margin-bottom: 50px;
        }

        .section-title {
            color: #A0522D;
            font-size: 2.2em;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 700;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #FFD88F;
            border-radius: 2px;
        }

        .faq-item {
            background: #FFFFFF;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            border: 1px solid #FFD88F;
            overflow: hidden;
        }

        .faq-question {
            padding: 25px 30px;
            font-size: 1.2em;
            font-weight: 600;
            color: #3E2723;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .faq-question:hover {
            background: #FFF9E6;
        }

        .faq-question::after {
            content: '+';
            font-size: 1.5em;
            color: #D04F4F;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-question::after {
            transform: rotate(45deg);
        }

        .faq-answer {
            padding: 0 30px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #FDFDFD;
        }

        .faq-item.active .faq-answer {
            padding: 0 30px 25px 30px;
            max-height: 500px;
        }

        .faq-answer p {
            color: #5a3927;
            line-height: 1.7;
            margin: 0;
        }

        .contact-prompt {
            background: #F5F5DC;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            margin-top: 50px;
            border: 2px solid #A0522D;
        }

        .contact-prompt h3 {
            color: #A0522D;
            margin-bottom: 15px;
            font-size: 1.8em;
        }

        .contact-prompt p {
            color: #3E2723;
            margin-bottom: 25px;
            font-size: 1.1em;
        }

        .contact-btn {
            background: linear-gradient(135deg, #D04F4F 0%, #C0392B 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1.1em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .contact-btn:hover {
            background: linear-gradient(135deg, #FFD88F 0%, #F4D03F 100%);
            color: #A0522D;
            transform: translateY(-2px);
        }

        /* Quick Links */
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .quick-link-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            border: 1px solid #FFD88F;
            transition: transform 0.3s ease;
        }

        .quick-link-card:hover {
            transform: translateY(-5px);
        }

        .quick-link-card h4 {
            color: #D04F4F;
            margin-bottom: 10px;
            font-size: 1.3em;
        }

        .quick-link-card p {
            color: #5a3927;
            margin-bottom: 15px;
        }

        .link-btn {
            background: #ABC06C;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 0.9em;
        }

        .link-btn:hover {
            background: #FFD88F;
            color: #A0522D;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .faq-hero {
                padding: 60px 20px;
            }
            
            .faq-hero h1 {
                font-size: 2.5em;
            }
            
            .faq-container {
                padding: 40px 20px;
            }
            
            .section-title {
                font-size: 1.8em;
            }
            
            .faq-question {
                padding: 20px;
                font-size: 1.1em;
            }
            
            .contact-prompt {
                padding: 30px 20px;
            }
        }

        @media (max-width: 480px) {
            .faq-hero h1 {
                font-size: 2em;
            }
            
            .faq-categories {
                gap: 10px;
            }
            
            .category-btn {
                padding: 10px 15px;
                font-size: 0.9em;
            }
            
            .quick-links {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include '../includes/nav.php'; ?>

        <!-- Hero Section -->
        <section class="faq-hero">
            <h1>Frequently Asked Questions</h1>
            <p class="subtitle">Find quick answers to common questions about BrewHaven Cafe</p>
        </section>

        <!-- FAQ Container -->
        <section class="faq-container">
            <!-- Category Filters -->
            <div class="faq-categories">
                <button class="category-btn active" data-category="all">All Questions</button>
                <button class="category-btn" data-category="ordering">Ordering</button>
                <button class="category-btn" data-category="products">Products</button>
                <button class="category-btn" data-category="general">General</button>
            </div>

            <!-- Ordering FAQs -->
            <div class="faq-section" data-category="ordering">
                <h2 class="section-title">Ordering & Payment</h2>
                
                <div class="faq-item">
                    <div class="faq-question">How do I place an order?</div>
                    <div class="faq-answer">
                        <p>You can place orders through our website menu, by visiting our physical cafe, or by calling us directly. Online orders can be placed for pickup or delivery within our service areas.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">What payment methods do you accept?</div>
                    <div class="faq-answer">
                        <p>We accept cash, credit/debit cards (Visa, MasterCard), GCash, Maya, and bank transfers. For online orders, we also accept payment through our secure payment gateway.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Can I modify or cancel my order?</div>
                    <div class="faq-answer">
                        <p>Orders can be modified or cancelled within 15 minutes of placement. Please contact us immediately at (02) 8123-4567 for any changes to your order.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Do you offer refunds?</div>
                    <div class="faq-answer">
                        <p>We offer refunds for incorrect orders or quality issues. Please contact us within 2 hours of receiving your order with photos of the issue for a prompt resolution.</p>
                    </div>
                </div>
            </div>

            <!-- Products FAQs -->
            <div class="faq-section" data-category="products">
                <h2 class="section-title">Our Products</h2>
                
                <div class="faq-item">
                    <div class="faq-question">Where do you source your coffee beans?</div>
                    <div class="faq-answer">
                        <p>We source our premium coffee beans directly from local Filipino farmers in Benguet, Sagada, and Bukidnon. We're committed to supporting local agriculture while ensuring the highest quality.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Are your pastries made fresh daily?</div>
                    <div class="faq-answer">
                        <p>Yes! All our pastries and Filipino delicacies are made fresh daily in our kitchen. We use traditional recipes with a modern twist, and we bake in small batches throughout the day.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Do you offer vegan or dairy-free options?</div>
                    <div class="faq-answer">
                        <p>Absolutely! We offer oat milk, almond milk, and coconut milk alternatives. Several of our Filipino delicacies are naturally vegan, and we can customize most drinks to accommodate dietary restrictions.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">What makes your Filipino coffee special?</div>
                    <div class="faq-answer">
                        <p>Our Filipino coffee is special because we use beans grown in volcanic soil at high altitudes, giving them unique flavor profiles. We also incorporate traditional brewing methods with modern techniques to highlight the authentic taste of Philippine coffee.</p>
                    </div>
                </div>
            </div>


            <!-- General FAQs -->
            <div class="faq-section" data-category="general">
                <h2 class="section-title">General Information</h2>
                
                <div class="faq-item">
                    <div class="faq-question">What are your operating hours?</div>
                    <div class="faq-answer">
                        <p>We're open Monday to Sunday from 6:00 AM to 10:00 PM. Holiday hours may vary, so check our social media pages for special announcements.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">Do you have WiFi?</div>
                    <div class="faq-answer">
                        <p>Yes! We offer free high-speed WiFi for our customers. Just ask our baristas for the password when you visit.</p>
                    </div>
                </div>



                <div class="faq-item">
                    <div class="faq-question">Do you offer loyalty programs?</div>
                    <div class="faq-answer">
                        <p>Yes! Join our Brew Crew loyalty program. Earn 1 point for every PHP 50 spent, and redeem points for free drinks, pastries, and exclusive merchandise. Ask our baristas to sign you up!</p>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="quick-links">
                <div class="quick-link-card">
                    <h4>📞 Contact Us</h4>
                    <p>Need immediate assistance? Reach out to our team.</p>
                    <a href="contact.html" class="link-btn">Get in Touch</a>
                </div>
                <div class="quick-link-card">
                    <h4>📋 View Menu</h4>
                    <p>Explore our full selection of drinks and snacks.</p>
                    <a href="menu.php" class="link-btn">See Menu</a>
                </div>
            </div>

            <!-- Contact Prompt -->
            <div class="contact-prompt">
                <h3>Still have questions?</h3>
                <p>Our friendly team is here to help you with any other inquiries you might have.</p>
                <a href="contact.html" class="contact-btn">Contact Us Today</a>
            </div>
        </section>

        <!-- Footer -->
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
                <p>&copy; 2025 BrewHaven Cafe PH. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        // FAQ Accordion Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const faqItems = document.querySelectorAll('.faq-item');
            const categoryBtns = document.querySelectorAll('.category-btn');
            const faqSections = document.querySelectorAll('.faq-section');

            // Accordion functionality
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', () => {
                    // Close all other items
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                        }
                    });
                    
                    // Toggle current item
                    item.classList.toggle('active');
                });
            });

            // Category filter functionality
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const category = btn.getAttribute('data-category');
                    
                    // Update active button
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    
                    // Show/hide sections
                    faqSections.forEach(section => {
                        if (category === 'all' || section.getAttribute('data-category') === category) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                });
            });

            // Close FAQ when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.faq-item')) {
                    faqItems.forEach(item => {
                        item.classList.remove('active');
                    });
                }
            });

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
