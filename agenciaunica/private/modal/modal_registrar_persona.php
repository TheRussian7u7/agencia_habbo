

<div class="modal fade" id="registerAdminModal" tabindex="-1" aria-labelledby="registerAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerAdminModalLabel">Registrar Nuevo Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerAdminForm" method="post" action="../private/procesos/registrar_persona.php" autocomplete="off" novalidate>
                    <div class="row"> <!-- Cambiado de form-row a row -->
                        <div class="col-12 col-md-6 mb-3"> <!-- Agregado mb-3 para espacio -->
                            <label for="nombre">Nombre</label>
                            <br>
                            <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off">
                        </div>
                        <div class="col-12 col-md-6 mb-3"> <!-- Agregado mb-3 para espacio -->
                            <label for="rango">Rango</label>
                            <select class="form-control" name="rango" id="rango">
                                <option value="">Seleccionar</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Manager">Manager</option>
                                <option value="Founder">Fundador</option>
                                <option value="Dueño">Dueño</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>