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
    const categoryFilter = document.getElementById("categoryFilter");
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
    if (searchInput) {
        searchInput.addEventListener("input", filterProducts);
    }
    
    // Category filter
    if (categoryFilter) {
        categoryFilter.addEventListener("change", filterProducts);
    }

});

// Get product id of selected item
document.addEventListener("DOMContentLoaded", function() {

    const cards = document.querySelectorAll('.product-card');
    let selectedID = null;

    cards.forEach(card => {
        card.addEventListener('click', () => {

            // Remove selected class on all cards
            cards.forEach(c => c.classList.remove('selected'));

            // Highlight clicked card
            card.classList.add('selected');

            // Get the ID
            selectedID = card.dataset.id;

            console.log("Selected Product ID:", selectedID);

            // If you want to load this into the right panel later:
            // loadProductDetails(selectedID);
        });
    });

});

document.addEventListener("DOMContentLoaded", function () {
    const cards = document.querySelectorAll('.product-card');
    let selectedID = null;

    cards.forEach(card => {
        card.addEventListener('click', () => {

            // Remove selected class on all cards
            cards.forEach(c => c.classList.remove('selected'));

            // Highlight clicked card
            card.classList.add('selected');

            // Get the ID
            selectedID = card.dataset.id;

            console.log("Selected Product ID:", selectedID);

            // Fetch item info from PHP
            fetch('../backend/get_item.php?id=' + selectedID)
                .then(res => res.json())
                .then(data => {
                    console.log(data); // Shows full product info
                    document.querySelector(".right-panel input[type='number']").value = selectedID;
                    document.querySelector(".right-panel input[type='text']").value = data.name;
                    // Populate right panel
                    document.querySelector('input[name="product_name"]').value = data.name;
                    document.querySelector('input[name="price"]').value = data.price;
                    document.querySelector('select[name="status"]').value = data.status;
                    document.querySelector('select[name="category"]').value = data.category;
                    document.querySelector('textarea[name="description"]').value = data.description;

                    // Product Image
                    const imageBox = document.getElementById('productImage');
                    imageBox.style.backgroundImage = `url('${data.image}')`;
                })
                .catch(err => console.log("Error fetching product:", err));
        });
    });
});






