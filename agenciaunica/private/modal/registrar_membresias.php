<!-- Modal para Registrar Membresías -->
<div class="modal fade" id="registroModal" tabindex="-1" aria-labelledby="registroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registroModalLabel">Registrar Membresía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registroForm" method="post" action="../private/procesos/registrar_membresias.php">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" placeholder="Ingrese nombre" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-4">
                            <label for="precio" class="form-label">Precio:</label>
                            <input type="number" class="form-control" placeholder="Ingrese precio" id="precio" name="precio" step="0.01" required>
                        </div>
                        <div class="col-md-4">
                            <label for="duracion" class="form-label">Duración:</label>
                            <input type="text" class="form-control" placeholder="Ejemplo: 3 o 5 días" id="duracion" name="duracion" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="beneficios" class="form-label">Beneficios:</label>
                        <textarea class="form-control" id="beneficios" placeholder="Ingrese los beneficios de la placa" name="beneficios" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>