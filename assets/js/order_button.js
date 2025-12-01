// Add to Cart Functionality and display to order.php
document.querySelectorAll('.order-btn, .best-seller-order-btn').forEach(btn => {
    btn.addEventListener('click', () => {

        const item_id = btn.dataset.id;
        const name = btn.dataset.name;
        const price = btn.dataset.price;
        const image = btn.dataset.image;

        fetch("../actions/add_to_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `item_id=${item_id}&name=${name}&price=${price}&image=${image}`
        })
        .then(res => res.text())
        .then(data => {
            alert(name + " added to cart!");
        });
    });
});
