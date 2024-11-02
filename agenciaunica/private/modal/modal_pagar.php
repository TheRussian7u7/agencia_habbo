<!-- Modal para registrar pago -->
<div class="modal fade" id="registrarPagaModal" tabindex="-1" aria-labelledby="registrarPagaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarPagaModalLabel">Registrar Paga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="registroPagaForm" method="POST" action="../private/procesos/procesar_paga.php">
                <div class="modal-body">
                    <!-- Nombre del usuario (se puede autocompletar si se extrae de la base de datos) -->
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" maxlength="16" required>
                    </div>

                    <div class="mb-3">
                        <label for="rango_usuario" class="form-label">Rango</label>
                        <select class="form-control" id="rango_usuario" name="rango_usuario" required>
                            <option disabled selected value="">Selecciona el rango</option>
                            <option value="Seguridad">Seguridad</option>
                            <option value="Tecnico">Tecnico</option>
                            <option value="Logistica">Logistica</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Director">Director</option>
                            <option value="Presidente">Presidente</option>
                            <option value="Operativo">Operativo</option>
                            <option value="Junta directiva">JTD</option>
                            <option value="ADMIN">ADMIN</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>

                    <!-- Total de la paga -->
                    <div class="mb-3">
                        <label for="total_paga" class="form-label">Total de la Paga</label>
                        <input type="number" step="0.01" class="form-control" id="total_paga" maxlength="2" name="total_paga" required>
                    </div>

                    <!-- Tipo de pago (nomina, bonificación, completo) -->
                    <div class="mb-3">
                        <label class="form-label">Tipo de Pago</label><br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="nomina" name="tipo_pago" value="nomina" required>
                            <label class="form-check-label" for="nomina">Nómina</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="bonificacion" name="tipo_pago" value="bonificacion" required>
                            <label class="form-check-label" for="bonificacion">Bonificación</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="completo" name="tipo_pago" value="completo" required>
                            <label class="form-check-label" for="completo">Completo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="Ascenso" name="tipo_pago" value="Ascenso" required>
                            <label class="form-check-label" for="Ascenso">Ascenso en ves de paga</label>
                        </div>
                    </div>

                    <!-- Placa de guarda paga -->
                    <div class="mb-3">
                        <label class="form-label">¿Tiene placa de guarda paga?</label><br>
                        <input type="checkbox" id="placa_guarda" name="placa_guarda" value="si">
                        <label for="placa_guarda">Sí</label>
                        <input type="checkbox" id="No_placa_guarda" name="No_placa_guarda" value="no">
                        <label for="No_placa_guarda">No</label>
                    </div>



                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estado de paga</label>
                        <select class="form-select" name="estatus" id="estatus">
                            <option value="">Seleccionar descripción</option>
                            <option value="Pagado">Pagado</option>
                            <option value="No Pagado">No pagado</option>
                        </select>
                    </div>

                    <!-- Comentarios adicionales -->
                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Comentarios (opcional)</label>
                        <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Registrar Paga</button>
                </div>
            </form>
        </div>
    </div>
</div>