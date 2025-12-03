<?php if (isset($_GET['status'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let status = "<?= $_GET['status'] ?>";
let action = "<?= $_GET['action'] ?>";

let message = "";

if (action === "sent") message = (status === "success") ? "Thank you very much for submitting a feedback!" : "Failed to send feedback.";
if (action === "deleted") message = (status === "success") ? "Feedback sucessfully deleted" : "Failed to delete feedback.";

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