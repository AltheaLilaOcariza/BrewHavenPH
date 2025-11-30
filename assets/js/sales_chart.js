//Need Backend, we will try to work with this soom :)
// sales_chart.js - Chart.js implementation for BrewHaven Cafe sales reports
document.addEventListener('DOMContentLoaded', function() {
    initializeSalesChart();
});

function initializeSalesChart() {
    const ctx = document.getElementById('salesChart');
    
    if (!ctx) {
        console.warn('Sales chart canvas not found');
        return;
    }
    
    // Sample sales data based on your products
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ube Latte', 'Espresso', 'Cappuccino', 'Biko', 'Cassava Cake', 'Matcha Latte'],
            datasets: [{
                label: 'Units Sold',
                data: [45, 38, 32, 28, 25, 22],
                backgroundColor: [
                    '#FFD88F',
                    '#A0522D', 
                    '#D04F4F',
                    '#ABC06F',
                    '#5a3927',
                    '#C0392B'
                ],
                borderColor: [
                    '#F4D03F',
                    '#8B4513',
                    '#A93226',
                    '#8BC34A',
                    '#3E2723',
                    '#922B21'
                ],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#5a3927',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.95)',
                    titleColor: '#A0522D',
                    bodyColor: '#5a3927',
                    borderColor: '#FFD88F',
                    borderWidth: 1,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(160, 82, 45, 0.1)'
                    },
                    ticks: {
                        color: '#5a3927',
                        font: {
                            size: 11
                        }
                    },
                    title: {
                        display: true,
                        text: 'Units Sold',
                        color: '#5a3927',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#5a3927',
                        font: {
                            size: 11,
                            weight: 'bold'
                        }
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
    
    // Add resize handler for better responsiveness
    window.addEventListener('resize', function() {
        salesChart.resize();
    });
    
    return salesChart;
}

// Function to update chart with new data (for future use)
function updateSalesChart(newData) {
    // This can be used later when you have real data from database
    console.log('Update chart with new data:', newData);
}
