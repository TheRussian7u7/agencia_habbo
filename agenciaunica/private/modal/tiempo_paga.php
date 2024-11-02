<!-- Modal para toma de tiempo -->
<div class="modal fade" id="tomaTiempoModal" tabindex="-1" aria-labelledby="tomaTiempoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tomaTiempoLabel">Toma de Tiempo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="tomaTiempoForm" method="POST">
          <div class="mb-3">
            <label for="codigoInput" class="form-label">Código de Usuario</label>
            <input type="text" class="form-control" id="codigoInput" name="codigo" required>
          </div>
          <button type="submit" class="btn btn-primary">Iniciar Tiempo</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById('tomaTiempoForm').addEventListener('submit', function (e) {
  e.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

  const codigo = document.getElementById('codigoInput').value;
  const mensajeError = document.getElementById('mensajeError');

  // Realizar la petición AJAX
  fetch('../private/procesos/toma_tiempo.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `codigo=${codigo}`
  })
    .then(response => response.json())
    .then(data => {
      if (data.exito) {
        alert('Tiempo iniciado correctamente.');
        mensajeError.style.display = 'none';
        document.getElementById('tomaTiempoForm').reset();
      } else {
        mensajeError.textContent = 'El código ingresado no es válido.';
        mensajeError.style.display = 'block';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      mensajeError.textContent = 'Hubo un problema al procesar la solicitud.';
      mensajeError.style.display = 'block';
    });
});

</script>
