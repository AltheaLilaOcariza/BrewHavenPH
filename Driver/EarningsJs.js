    // EARNINGS PAGE INTERACTIONS
document.addEventListener('DOMContentLoaded', function() {
    // Card highlight on hover
    const cards = document.querySelectorAll('.summary-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.borderColor = '#FFE4B5';
        });
        card.addEventListener('mouseleave', () => {
            card.style.borderColor = '#f8f4ec';
        });
    });

    // Earnings row hover effects
    const earningRows = document.querySelectorAll('.earning-row');
    earningRows.forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.borderLeft = '4px solid #FFB347';
        });
        row.addEventListener('mouseleave', () => {
            row.style.borderLeft = 'none';
        });
    });

    console.log('💰 Earnings page loaded successfully!');
    console.log('📊 Ready for PHP/MySQL database integration');
    console.log('🔗 Use data-value & data-breakdown attributes');
});

// Database population function (ready for AJAX/PHP)
// function updateEarnings(data) {
//     document.querySelector('[data-value="total"]').textContent = '₱' + data.total;
//     document.querySelector('[data-value="today"]').textContent = '₱' + data.today;
//     // etc...
// }