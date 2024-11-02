<!-- Modal para registrar compra -->
<div class="modal fade" id="registrarVentaModal" tabindex="-1" aria-labelledby="registrarVentaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registrarVentaModalLabel">Registrar Compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="registroVentaForm" method="POST" action="../private/procesos/registrar_venta.php">
        <div class="modal-body">
          <!-- Descripción (Select) -->
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <select class="form-select" id="descripcion" name="descripcion" required>
              <option value="">Seleccionar descripción</option>
              <option value="Placa vip">Placa vip</option>
              <option value="Fila exclusiva">Fila exclusiva</option>
              <option value="Guarda paga">Guarda paga</option>
              <!-- Agrega más opciones según sea necesario -->
            </select>
          </div>
          
          <!-- Nombre del comprador -->
          <div class="mb-3">
            <label for="nombre_comprador" class="form-label">Nombre del Comprador</label>
            <input type="text" class="form-control" id="nombre_comprador" name="nombre_comprador" required>
          </div>
          
          <!-- Precio -->
          <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
          </div>
          
          <!-- Fecha de compra -->
          <div class="mb-3">
            <label for="fecha_compra" class="form-label">Fecha de Compra</label>
            <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
          </div>

          <!-- Fecha de vencimiento (autogenerado por JavaScript) -->
          <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
            <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" readonly>
          </div>

          <!-- Estatus (se calculará según la fecha de vencimiento) -->
          <input type="hidden" id="estatus" name="estatus">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-success">Registrar Compra</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Función para calcular la fecha de vencimiento automáticamente
  document.getElementById('fecha_compra').addEventListener('change', function() {
      let fechaCompra = new Date(this.value); // Convertir la fecha de compra a objeto Date

      // Sumar un mes a la fecha de compra
      fechaCompra.setMonth(fechaCompra.getMonth() + 1);

      // Formatear la nueva fecha en YYYY-MM-DD
      let fechaVencimiento = fechaCompra.toISOString().split('T')[0];

      // Colocar la fecha de vencimiento calculada en el campo correspondiente
      document.getElementById('fecha_vencimiento').value = fechaVencimiento;
  });
</script>