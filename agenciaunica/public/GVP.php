
<div class="container mt-4">
    <div class="card bg-dark text-light">
        <div class="card-header">
            <h5 class="card-title">Gestión de Ventas de Placas</h5>
        </div>
        <div class="card-body">
            <!-- Gráfica de Ganancias y Tipo de Placas Vendidas -->
            <canvas id="ventasChart" style="max-height: 400px;"></canvas>
            <hr>
            <!-- Tabla de Ventas -->
            <div class="table-responsive">
                <table class="table table-striped mt-3" style="background-color: #444; color: white;">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Nombre del Comprador</th>
                            <th>Fecha de Compra</th>
                            <th>Vendedor</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody id="tablaVentas">
                        <!-- Los datos de las ventas se cargarán aquí -->
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
        url: '../private/procesos/graficas_ventas.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Crear Gráfica de Ventas
            var ctxVentas = document.getElementById('ventasChart').getContext('2d');
            var ventasChart = new Chart(ctxVentas, {
                type: 'bar',
                data: {
                    labels: Object.keys(data.placasVendidas), // Tipos de placas vendidas
                    datasets: [{
                        label: 'Total Ganado',
                        data: Object.values(data.ganancias), // Ganancias por cada tipo de placa
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
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

            // Llenar la tabla de ventas
            var tablaVentas = $('#tablaVentas');
            data.ventas.forEach(function(venta) {
                var estatusColor = venta.estatus === 'Activo' ? 'green' : 'red';
                tablaVentas.append(`
                    <tr>
                        <td>${venta.descripcion}</td>
                        <td>${venta.nombre_comprador}</td>
                        <td>${venta.fecha_compra}</td>
                        <td>${venta.vendedor}</td>
                        <td style="color:${estatusColor}">${venta.estatus}</td>
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
