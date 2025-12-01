document.addEventListener("DOMContentLoaded", () => {

    // ADD ITEM TO CART
    document.querySelectorAll('.order-btn, .best-seller-order-btn').forEach(btn => {
        btn.addEventListener('click', () => {

            const item_id = btn.dataset.id;
            const name = btn.dataset.name;
            const price = btn.dataset.price;
            const image = btn.dataset.image;

            fetch('../actions/add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `item_id=${encodeURIComponent(item_id)}&name=${encodeURIComponent(name)}&price=${encodeURIComponent(price)}&image=${encodeURIComponent(image)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    let itemBox = document.querySelector("#item-" + item_id);

                    // If item doesn't exist, create a new element
                    if (!itemBox) {
                        const ordersLeft = document.querySelector(".orders-left");
                        const newItemHTML = `
                        <section class="order-item" id="item-${item_id}">
                            <section class="item-img" style="background-image:url(${image})"></section>
                            <section class="item-details">
                                <p class="item-name">${name}</p>
                                <p class="item-price">₱${price}</p>
                                <p class="item-subtotal">Subtotal: ₱${data.subtotal}</p>
                            </section>
                            <section class="qty-control">
                                <button class="minus" data-id="${item_id}">−</button>
                                <span class="qty">${data.qty}</span>
                                <button class="plus" data-id="${item_id}">+</button>
                            </section>
                        </section>`;
                        ordersLeft.insertAdjacentHTML("beforeend", newItemHTML);

                        // Attach event listeners to new buttons
                        const newPlus = ordersLeft.querySelector(`#item-${item_id} .plus`);
                        const newMinus = ordersLeft.querySelector(`#item-${item_id} .minus`);
                        newPlus.addEventListener("click", () => updateQty(item_id, "plus"));
                        newMinus.addEventListener("click", () => updateQty(item_id, "minus"));

                    } else {
                        // Item exists → update quantity & subtotal
                        itemBox.querySelector(".qty").textContent = data.qty;
                        itemBox.querySelector(".item-subtotal").textContent =
                            "Subtotal: ₱" + data.subtotal;
                    }

                    // Update total due
                    document.querySelector(".orders-right .value:nth-of-type(4)").textContent =
                        "₱" + data.total;

                    // Optional: alert
                    // alert(`${name} added to cart!`);
                }
            })
            .catch(err => console.error(err));
        });
    });

    // INITIAL PLUS & MINUS BUTTONS
    document.querySelectorAll(".plus").forEach(btn => {
        btn.addEventListener("click", () => updateQty(btn.dataset.id, "plus"));
    });

    document.querySelectorAll(".minus").forEach(btn => {
        btn.addEventListener("click", () => updateQty(btn.dataset.id, "minus"));
    });

});

// UPDATE QUANTITY FUNCTION
function updateQty(item_id, action) {

    fetch("../actions/update_qty.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `item_id=${item_id}&action=${action}`
    })
    .then(res => res.json())
    .then(data => {

        // Item removed
        if (data.removed) {
            document.querySelector("#item-" + item_id)?.remove();
            document.querySelector(".orders-right .value:nth-of-type(4)").textContent =
                "₱" + data.total;

            if (data.total === 0) {
                document.querySelector(".orders-left").innerHTML =
                    "<p class='empty-msg'>Your cart is empty.</p>";
            }
            return;
        }

        // Update qty & subtotal
        const itemBox = document.querySelector("#item-" + item_id);
        if (itemBox) {
            itemBox.querySelector(".qty").textContent = data.qty;
            itemBox.querySelector(".item-subtotal").textContent =
                "Subtotal: ₱" + data.subtotal;
        }

        // Update total due
        document.querySelector(".orders-right .value:nth-of-type(4)").textContent =
            "₱" + data.total;
    })
    .catch(err => console.error(err));
}