<script>
    const chartData = @json( $chartData);
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('barChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Vendas',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        data: chartData.vendas
                    },
                    {
                        label: 'Investimentos',
                        backgroundColor: 'rgba(210,214,222,1)',
                        borderColor: 'rgba(210,214,222,1)',
                        data: chartData.investimentos
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
