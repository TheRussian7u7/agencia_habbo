<div class="modal fade" id="modificarModalpublicaciones" tabindex="-1" aria-labelledby="modificarModalpublicacionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificarModalpublicacionesLabel">Modificar Publicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="noticia-tab" data-bs-toggle="tab" href="#noticia" role="tab" aria-controls="noticia" aria-selected="true">Noticia</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="actualizacion-tab" data-bs-toggle="tab" href="#actualizacion" role="tab" aria-controls="actualizacion" aria-selected="false">Actualización</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="publicacion-tab" data-bs-toggle="tab" href="#publicacion" role="tab" aria-controls="publicacion" aria-selected="false">Publicación</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="noticia" role="tabpanel" aria-labelledby="noticia-tab">
                        <form id="modificarNoticiaForm" method="post" action="../private/procesos/proceso_modificar_publicacion.php">
                            <input type="hidden" name="id_publicacion" id="id_publicacion">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="id_tipo" class="form-label">Tipo:</label>
                                <select class="form-select" id="id_tipo" name="id_tipo">
                                    <option value="1">Noticia</option>
                                    <option value="2">Actualización</option>
                                    <option value="3">Publicación</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="actualizacion" role="tabpanel" aria-labelledby="actualizacion-tab">
                        <!-- Similar al anterior para Actualización -->
                    </div>
                    <div class="tab-pane fade" id="publicacion" role="tabpanel" aria-labelledby="publicacion-tab">
                        <!-- Similar al anterior para Publicación -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" form="modificarNoticiaForm" class="btn btn-success">Modificar</button>
            </div>
        </div>
    </div>
</div>