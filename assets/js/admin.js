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

//search box and dropdown
document.addEventListener("DOMContentLoaded", function() {

    const searchInput = document.querySelector(".search-box input");
    const categoryFilter = document.querySelector("#categoryFilter");
    const cards = document.querySelectorAll(".product-card");

    function filterProducts() {
        const searchValue = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value.toLowerCase();

        cards.forEach(card => {
            const name = card.dataset.name;
            const category = card.dataset.category;

            const matchName = name.includes(searchValue);
            const matchCategory = (selectedCategory === "all") || (selectedCategory === category);

            if (matchName && matchCategory) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    }

    // Search filter
    searchInput.addEventListener("input", filterProducts);

    // Category filter
    categoryFilter.addEventListener("change", filterProducts);

});




