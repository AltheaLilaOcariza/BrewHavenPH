const ctx = document.getElementById('salesChart').getContext('2d');

fetch('../backend/salesChart.php')
    .then(res => res.json())
    .then(data => {
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.months, // Dynamic X-axis labels
                datasets: [{
                    label: 'Sales (PHP)',
                    data: data.sales, // Dynamic sales data
                    backgroundColor: '#FFD88F',
                    borderColor: '#FFB347',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(err => console.error('Error fetching sales data:', err));