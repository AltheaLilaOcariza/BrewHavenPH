<?php if (isset($_GET['status'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let status = "<?= $_GET['status'] ?>";
let action = "<?= $_GET['action'] ?>";

let message = "";

if (action === "add") message = (status === "success") ? "Product added successfully!" : "Failed to add product.";
if (action === "edit") message = (status === "success") ? "Product updated successfully!" : "Failed to update product.";
if (action === "delete") message = (status === "success") ? "Product deleted successfully!" : "Failed to delete product.";

Swal.fire({
    title: (status === "success") ? "Success!" : "Error",
    text: message,
    icon: (status === "success") ? "success" : "error",
    confirmButtonText: "OK"
}).then(() => {
    history.replaceState(null, null, "manage_menu.php");
});
</script>
<?php endif; ?>