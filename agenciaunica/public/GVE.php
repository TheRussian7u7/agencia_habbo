


<div class="container mt-4" style="background-color: #333; color: white; border-radius: 5px; padding: 20px;">
    <div class="card bg-dark text-light">
        <div class="card-header">
            <h5 class="card-title">Gestión de Ventas</h5>
        </div>
        <div class="card-body">
            <canvas id="ventasChart" style="max-height: 400px;"></canvas>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped mt-3" style="background-color: #444; color: white;">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad Vendida</th>
                            <th>Ingreso Total</th>
                            <th>Fecha de Venta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Producto A</td>
                            <td>50</td>
                            <td>$2,500</td>
                            <td>2023-09-01</td>
                        </tr>
                        <tr>
                            <td>Producto B</td>
                            <td>30</td>
                            <td>$1,800</td>
                            <td>2023-09-02</td>
                        </tr>
                        <tr>
                            <td>Producto C</td>
                            <td>20</td>
                            <td>$1,200</td>
                            <td>2023-09-03</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var ctx = document.getElementById('ventasChart').getContext('2d');
    var ventasChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['2023-09-01', '2023-09-02', '2023-09-03'],
            datasets: [{
                label: 'Ventas Diarias',
                data: [2500, 1800, 1200],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>

<?php require_once('../private/plantillas/footer.php'); ?>