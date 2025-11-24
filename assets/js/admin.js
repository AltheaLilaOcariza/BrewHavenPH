//selectable product card
document.addEventListener("DOMContentLoaded", function() {

    console.log("JS loaded");

    const cards = document.querySelectorAll('.product-card');

    console.log("Cards found:", cards.length);

    cards.forEach(card => {
        card.addEventListener('click', () => {
            console.log("Card clicked:", card);

            cards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
        });
    });

});





