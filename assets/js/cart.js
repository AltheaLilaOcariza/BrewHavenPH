document.addEventListener("click", function(e) {
    if (e.target.classList.contains("add-to-cart")) {

        const btn = e.target;

        fetch("add_to_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: 
                "id=" + btn.dataset.id +
                "&name=" + encodeURIComponent(btn.dataset.name) +
                "&price=" + btn.dataset.price +
                "&image=" + encodeURIComponent(btn.dataset.image)
        })
        .then(() => {
            window.location.href = "order.php";
        });
    }
});
