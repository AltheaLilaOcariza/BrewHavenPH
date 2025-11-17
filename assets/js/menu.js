// Enhanced Carousel Functionality with Swipe/Drag
class Carousel {
    constructor(carouselElement) {
        this.carousel = carouselElement;
        this.track = carouselElement.querySelector('.carousel-track');
        this.items = Array.from(this.track.children);
        this.prevBtn = carouselElement.querySelector('.prev');
        this.nextBtn = carouselElement.querySelector('.next');
        
        // Initialize with default values, then calculate properly
        this.itemWidth = 200;
        this.gap = 15;
        this.visibleItems = 3;
        this.index = 0;
        
        // Swipe/drag variables
        this.isDragging = false;
        this.startPos = 0;
        this.currentTranslate = 0;
        this.prevTranslate = 0;
        this.animationID = 0;
        
        // Wait a bit for DOM to be ready, then initialize
        setTimeout(() => {
            this.calculateDimensions();
            this.init();
        }, 50);
    }
    
    calculateDimensions() {
        if (this.items.length > 0) {
            try {
                // Calculate actual dimensions
                const firstItem = this.items[0];
                const trackStyle = getComputedStyle(this.track);
                
                this.itemWidth = firstItem.offsetWidth || 200;
                this.gap = parseInt(trackStyle.gap) || 15;
                
                // Calculate how many items are visible based on container width
                const containerWidth = this.carousel.offsetWidth;
                this.visibleItems = Math.floor(containerWidth / (this.itemWidth + this.gap));
                
                console.log('Carousel dimensions calculated:', {
                    itemWidth: this.itemWidth,
                    gap: this.gap,
                    visibleItems: this.visibleItems,
                    containerWidth: containerWidth,
                    totalItems: this.items.length
                });
                
            } catch (error) {
                console.warn('Error calculating carousel dimensions, using defaults:', error);
                // Fallback to default values
                this.itemWidth = 200;
                this.gap = 15;
                this.visibleItems = 3;
            }
        }
    }
    
    init() {
        console.log('Carousel initialized with', this.items.length, 'items');
        
        // Set up track width to contain all items
        this.updateTrackWidth();
        this.updateCarousel();
        this.updateButtons();
        
        // Button events with null checks
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => this.prev());
        }
        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.next());
        }
        
        // Mouse events for dragging
        this.track.addEventListener('mousedown', this.dragStart.bind(this));
        this.track.addEventListener('mousemove', this.drag.bind(this));
        this.track.addEventListener('mouseup', this.dragEnd.bind(this));
        this.track.addEventListener('mouseleave', this.dragEnd.bind(this));
        
        // Touch events for mobile
        this.track.addEventListener('touchstart', this.dragStart.bind(this));
        this.track.addEventListener('touchmove', this.drag.bind(this));
        this.track.addEventListener('touchend', this.dragEnd.bind(this));
        
        // Prevent image drag
        this.track.addEventListener('dragstart', (e) => e.preventDefault());
        
        // Keyboard navigation
        this.carousel.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            this.calculateDimensions();
            this.updateTrackWidth();
            this.updateCarousel();
            this.updateButtons();
        });
    }
    
    updateTrackWidth() {
        // Ensure track has enough width for all items with gaps
        const totalWidth = this.items.length * (this.itemWidth + this.gap);
        this.track.style.minWidth = `${totalWidth}px`;
    }
    
    // Drag functionality
    dragStart(e) {
        if (e.type === 'touchstart') {
            this.startPos = e.touches[0].clientX;
        } else {
            this.startPos = e.clientX;
            e.preventDefault();
        }
        
        this.isDragging = true;
        this.track.style.transition = 'none';
        this.track.style.cursor = 'grabbing';
        this.animationID = requestAnimationFrame(this.animation.bind(this));
    }
    
    drag(e) {
        if (!this.isDragging) return;
        
        let currentPosition;
        if (e.type === 'touchmove') {
            currentPosition = e.touches[0].clientX;
        } else {
            currentPosition = e.clientX;
        }
        
        const diff = currentPosition - this.startPos;
        this.currentTranslate = this.prevTranslate + diff;
    }
    
    dragEnd() {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        this.track.style.cursor = 'grab';
        cancelAnimationFrame(this.animationID);
        
        const movedBy = this.currentTranslate - this.prevTranslate;
        
        // If drag was significant enough, change slide
        if (Math.abs(movedBy) > 50) {
            if (movedBy < 0 && this.index < this.items.length - this.visibleItems) {
                this.index++;
            } else if (movedBy > 0 && this.index > 0) {
                this.index--;
            }
        }
        
        this.prevTranslate = this.currentTranslate;
        this.updateCarousel();
        this.updateButtons();
    }
    
    animation() {
        this.setSliderPosition();
        if (this.isDragging) {
            requestAnimationFrame(this.animation.bind(this));
        }
    }
    
    setSliderPosition() {
        this.track.style.transform = `translateX(${this.currentTranslate}px)`;
    }
    
    updateCarousel() {
        const totalItemWidth = this.itemWidth + this.gap;
        const translateX = -this.index * totalItemWidth;
        
        this.currentTranslate = translateX;
        this.prevTranslate = translateX;
        
        this.track.style.transition = this.isDragging ? 'none' : 'transform 0.4s ease';
        this.track.style.transform = `translateX(${translateX}px)`;
        
        console.log('Moving carousel to index:', this.index, 'translateX:', translateX);
    }
    
    updateButtons() {
        const maxIndex = Math.max(0, this.items.length - this.visibleItems);
        const prevDisabled = this.index === 0;
        const nextDisabled = this.index >= maxIndex;
        
        if (this.prevBtn) {
            this.prevBtn.disabled = prevDisabled;
            this.prevBtn.style.opacity = prevDisabled ? '0.5' : '1';
            this.prevBtn.style.cursor = prevDisabled ? 'not-allowed' : 'pointer';
        }
        
        if (this.nextBtn) {
            this.nextBtn.disabled = nextDisabled;
            this.nextBtn.style.opacity = nextDisabled ? '0.5' : '1';
            this.nextBtn.style.cursor = nextDisabled ? 'not-allowed' : 'pointer';
        }
        
        console.log('Button states - prev:', prevDisabled, 'next:', nextDisabled, 'maxIndex:', maxIndex);
    }
    
    prev() {
        console.log('Previous button clicked, current index:', this.index);
        if (this.index > 0) {
            this.index--;
            this.updateCarousel();
            this.updateButtons();
        }
    }
    
    next() {
        console.log('Next button clicked, current index:', this.index);
        const maxIndex = Math.max(0, this.items.length - this.visibleItems);
        if (this.index < maxIndex) {
            this.index++;
            this.updateCarousel();
            this.updateButtons();
        }
    }
}

// Initialize all carousels
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - initializing carousels...');
    
    // Add CSS for carousel and animations first
    const carouselStyle = document.createElement('style');
    carouselStyle.textContent = `
        .carousel-track {
            cursor: grab;
            user-select: none;
            display: flex;
        }
        
        .carousel-track:active {
            cursor: grabbing;
        }
        
        .carousel-item {
            user-select: none;
            flex-shrink: 0;
        }
        
        .carousel {
            overflow: hidden;
            position: relative;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #FFD88F;
            color: #A0522D;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
        
        .view-order-btn {
            position: relative;
        }
    `;
    document.head.appendChild(carouselStyle);
    
    // Initialize carousels after a short delay to ensure CSS is applied
    setTimeout(() => {
        const carousels = document.querySelectorAll('.carousel');
        console.log(`Found ${carousels.length} carousels`);
        
        if (carousels.length === 0) {
            console.error('No carousels found! Check your HTML structure.');
            console.log('Available elements with class "carousel":', document.querySelectorAll('.carousel'));
            return;
        }
        
        carousels.forEach((carousel, index) => {
            console.log(`Initializing carousel ${index + 1} with ${carousel.querySelectorAll('.carousel-item').length} items`);
            try {
                new Carousel(carousel);
            } catch (error) {
                console.error(`Error initializing carousel ${index + 1}:`, error);
            }
        });
    }, 100);
    
    // Add to Cart functionality
    function initializeCart() {
        const orderButtons = document.querySelectorAll('.order-btn, .best-seller-order-btn');
        let cartCount = 0;
        
        console.log(`Found ${orderButtons.length} order buttons`);
        
        orderButtons.forEach(button => {
            button.addEventListener('click', function() {
                const item = this.closest('.carousel-item, .card');
                if (!item) {
                    console.error('Could not find parent item for button:', this);
                    return;
                }
                
                const itemNameElem = item.querySelector('.item-name');
                const priceElem = item.querySelector('.price');
                
                if (!itemNameElem || !priceElem) {
                    console.error('Could not find item name or price in:', item);
                    return;
                }
                
                const itemName = itemNameElem.textContent;
                const price = priceElem.textContent;
                
                // Animation feedback
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
                
                // Update cart count
                cartCount++;
                updateCartBadge(cartCount);
                
                // Show notification
                showAddToCartNotification(itemName);
                
                console.log(`Added to cart: ${itemName} - ${price}`);
            });
        });
        
        // Initialize cart badge if view order button exists
        const viewOrderBtn = document.querySelector('.view-order-btn');
        if (viewOrderBtn) {
            updateCartBadge(0); // Initialize with 0
        }
    }
    
    function updateCartBadge(count) {
        let badge = document.querySelector('.cart-badge');
        if (!badge) {
            badge = document.createElement('span');
            badge.className = 'cart-badge';
            const viewOrderBtn = document.querySelector('.view-order-btn');
            if (viewOrderBtn) {
                viewOrderBtn.appendChild(badge);
            } else {
                console.warn('View order button not found for cart badge');
                return;
            }
        }
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    }
    
    function showAddToCartNotification(itemName) {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.cart-notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.textContent = `✓ Added ${itemName} to cart!`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ABC06F;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            animation: slideIn 0.3s ease forwards;
            font-family: system-ui, -apple-system, sans-serif;
            font-size: 14px;
            font-weight: 500;
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, 3000);
    }
    
    // Initialize cart functionality after carousels
    setTimeout(initializeCart, 200);
    
    // Error handling for the entire script
    window.addEventListener('error', function(e) {
        console.error('Script error:', e.error);
    });
});
