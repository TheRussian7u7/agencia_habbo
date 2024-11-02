

<div class="container mt-4">
    <div class="card bg-dark text-light">
        <div class="card-header">
            <h5 class="card-title">Gestión de Pagas</h5>
        </div>
        <div class="card-body">
            <!-- Gráfica de Pagas por Rango -->
            <canvas id="pagoChart" style="max-height: 400px;"></canvas>
            <hr>
            <!-- Tabla de Trabajadores y Pagas -->
            <div class="table-responsive">
                <table class="table table-striped mt-3" style="background-color: #444; color: white;">
                    <thead>
                        <tr>
                            <th>Trabajador</th>
                            <th>Rango</th>
                            <th>Paga Total</th>
                            <th>Fecha de Pago</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="tablaPaga">
                        <!-- Aquí se llenarán los datos dinámicos -->
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Petición AJAX para obtener los datos
    $.ajax({
        url: '../private/procesos/grafica_pagas.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Crear Gráfica de Pagos por Rango
            var ctxPago = document.getElementById('pagoChart').getContext('2d');
            var pagoChart = new Chart(ctxPago, {
                type: 'bar',
                data: {
                    labels: Object.keys(data.rangoPagos), // Nombres de los rangos
                    datasets: [{
                        label: 'Paga Total por Rango',
                        data: Object.values(data.rangoPagos), // Paga total por cada rango
                        backgroundColor: 'rgba(0, 255, 255, 0.8)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
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

            // Llenar la tabla de trabajadores
            var tablaPaga = $('#tablaPaga');
            data.pagas.forEach(function(paga) {
                var estadoColor = paga.estado === 'Pagado' ? 'green' : 'red';
                tablaPaga.append(`
                    <tr>
                        <td>${paga.nombre_usuario}</td>
                        <td>${paga.rango_usuario}</td>
                        <td>${paga.total_paga}</td>
                        <td>${paga.fecha_pago}</td>
                        <td style="color:${estadoColor}">${paga.estado}</td>
                    </tr>
                `);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los datos: ", error);
        }
    });
});
</script>

