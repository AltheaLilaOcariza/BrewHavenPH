<?php 
    $title = "Delivery Status | BrewHaven Cafe PH";
    $extra_css = [
        '../assets/css/includes.css',
        '../assets/css/deliveryStatus.css'
    ];

    include '../includes/header.php';
?>

<main class="container">

    <?php include '../includes/nav.php'; ?>

    <section class="delivery-section">

        <div class="delivery-header">
            <h1>Delivery Status</h1>

            <p>
                Track your BrewHaven orders for delivery live and stay updated in real time.
            </p>

            <div class="live-indicator">
                <span class="live-dot"></span>
                Live Updates Every 1 Minute
            </div>
        </div>

        <div class="delivery-card">

            <table class="delivery-table">

                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Delivery Status</th>
                    </tr>
                </thead>

                <tbody id="deliveryTableBody">
                    <!-- Dynamic rows -->
                </tbody>

            </table>

        </div>

    </section>

</main>

<script>

async function loadDeliveries() {

    try {

        const response = await fetch("../backend/get_deliveries.php");

        const data = await response.json();

        const tableBody = document.getElementById("deliveryTableBody");

        tableBody.innerHTML = "";

        if (!data.success || data.deliveries.length === 0) {

            tableBody.innerHTML = `
                <tr class="empty-row">
                    <td colspan="2">
                        No deliveries found.
                    </td>
                </tr>
            `;

            return;
        }

        data.deliveries.forEach(delivery => {

            let statusClass = "";

            switch (delivery.delivery_status.toUpperCase()) {

                case "PENDING":
                statusClass = "status-pending";
                break;

                case "READY":
                    statusClass = "status-ready";
                    break;

                case "PICKED UP":
                    statusClass = "status-picked-up";
                    break;

                case "DELIVERED":
                    statusClass = "status-delivered";
                    break;

                case "DELIVERED":
                    statusClass = "status-delivered";
                    break;

                case "CANCELLED":
                    statusClass = "status-cancelled";
                    break;

                default:
                    statusClass = "status-pending";
            }

            tableBody.innerHTML += `
                <tr>
                    <td>#${delivery.order_id}</td>

                    <td>
                        <span class="status-badge ${statusClass}">
                            ${delivery.delivery_status}
                        </span>
                    </td>
                </tr>
            `;
        });

    } catch (error) {

        console.error("Failed to load deliveries:", error);
    }
}

// Initial load
loadDeliveries();

// Poll every 1 minute
setInterval(loadDeliveries, 60000);

</script>

<?php 
$login_link = '../admin/login.php';
include '../includes/footer.php'; 
?>