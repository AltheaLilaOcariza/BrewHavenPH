<?php if (isset($_GET['status'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let status = "<?= $_GET['status'] ?>";
let action = "<?= $_GET['action'] ?>";

// safely pass PHP variable to JS
let orderID = <?= isset($manager) ? $manager->getLastOrderId() : 'null' ?>;

let message = "";

if (action === "order") {
    if (status === "success") {
        message = "Order sent successfully!\nOrder No: " + orderID;
    } else {
        message = "Failed to send order.";
    }
}

if (action === "cancel") {
    if (status === "success") {
        message = "Order canceled successfully";
    } else {
        message = "Failed to Cancel order.";
    }
}

Swal.fire({
    title: (status === "success") ? "Success!" : "Error",
    text: message,
    icon: (status === "success") ? "success" : "error",
    timer: 2000, 
    timerProgressBar: true,
    showConfirmButton: false
}).then(() => {
    window.location.href = "menu.php"; // redirect automatically
});
</script>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] == 'empty_cart'): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Cart is empty',
        text: 'You need to add items before you can place an order.',
        timer: 2000, 
        timerProgressBar: true,
        showConfirmButton: false
    }).then(() => {
        window.location.href = "menu.php"; // redirect automatically
    });
</script>
<?php endif; ?>