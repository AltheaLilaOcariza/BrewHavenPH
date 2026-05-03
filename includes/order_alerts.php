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

    /*let confirmBtn = document.querySelection(".confirm");

    confirmBtn.addEventListener("click", function (){
        startPrepTimer(36000); //10 minutes prep time
    });

    function startPrepTimer(seconds){
        let timeLeft = seconds;
        let prepSection = document.getElementById("prepSection");
        let prepTimer = document.getElementById("prepTimer");

        prepSection.style.display = "block";

        document.querySelector(".confirm").style.display = "none";
        document.querySelector(".cancel").style.display = "none";

        let timer = setInterval(function (){
            timeLeft--;
            prepTimer.textContent = timeLeft;

            if(timeLeft <= 5){
                prepTimer.style.color = "red";
            }

            if(timeLeft <= 0){
                clearInterval(timer);
                orderReady();
            }
        }, 36000);
    }

    function orderReady(){
        alert("Your order is ready for pick-up/delivery! ☕")
    }*/
}

if (action === "cancel") {
    if (status === "cancel") {
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