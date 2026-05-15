// STATUS TOGGLE
document.addEventListener('DOMContentLoaded', function() {
    const statusToggle = document.getElementById('statusToggle');
    
    statusToggle?.addEventListener('click', function() {
        this.classList.toggle('online');
        const isOnline = this.classList.contains('online');
        this.innerHTML = isOnline 
            ? '<i class="fas fa-circle" style="font-size:0.7rem;"></i> Online'
            : '<i class="fas fa-circle" style="font-size:0.7rem;color:#EF4444;"></i> Offline';
    });

    // UPDATE DELIVERY STATUS - PICKUP
    const btnPickup = document.getElementById('btnPickup');
    btnPickup?.addEventListener('click', function() {
        
        const steps = {
            ready: document.getElementById('stepReady'),
            pickup: document.getElementById('stepPickup'),
            delivered: document.getElementById('stepDelivered')
        };
        const lines = {
            line1: document.getElementById('line1'),
            line2: document.getElementById('line2')
        };

        // Update to picked up
        steps.ready.classList.add('completed');
        steps.pickup.classList.add('active', 'completed');
        lines.line1.classList.add('completed');
        
        this.style.display = 'none';
        document.getElementById('btnDelivered').disabled = false;
    });

    // UPDATE DELIVERY STATUS - DELIVERED
    const btnDelivered = document.getElementById('btnDelivered');
    btnDelivered?.addEventListener('click', function() {
        const steps = {
            pickup: document.getElementById('stepPickup'),
            delivered: document.getElementById('stepDelivered')
        };
        const lines = { line2: document.getElementById('line2') };

        // Update to delivered
        steps.delivered.classList.add('active', 'completed');
        lines.line2.classList.add('completed');
        
        this.innerHTML = '<i class="fas fa-check-double"></i> Delivered!';
        this.disabled = true;
    });

    console.log('🚚 BrewHaven Deliveries JavaScript loaded!');
    console.log('✅ All event listeners attached');
    console.log('🔗 Ready for PHP/MySQL database integration');
});