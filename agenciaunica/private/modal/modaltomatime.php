<!-- Modal para Tomar Tiempo -->
<div class="modal fade" id="tomaTiempoModal" tabindex="-1" role="dialog" aria-labelledby="tomaTiempoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tomaTiempoModalLabel">Toma de Tiempo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="timeTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="form-tab" data-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="true">Formulario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabla-tab" data-toggle="tab" href="#tabla" role="tab" aria-controls="tabla" aria-selected="false">Tabla de Datos</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <!-- Formulario -->
                    <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
                        <form method="post" action="../private/procesos/accion.php">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" id="codigo" name="codigo" class="form-control" required>
                            </div>
                            <button type="submit" name="accion" value="iniciar" class="btn btn-primary">Iniciar</button>
                            <button type="submit" name="accion" value="pausar" class="btn btn-warning">Pausar</button>
                            <button type="submit" name="accion" value="ausente" class="btn btn-danger">Marcar Ausente</button>
                        </form>
                    </div>

                    <!-- Tabla de Datos -->
                    <div class="tab-pane fade" id="tabla" role="tabpanel" aria-labelledby="tabla-tab">
                        <h2>Usuarios</h2>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Tiempo Corriendo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datos_usuario as $usuario): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($usuario['codigo']); ?></td>
                                        <td>
                                            <?php
                                            // Calcular el tiempo corriendo
                                            $tiempo_inicio = isset($usuario['tiempo_inicio']) ? (int)$usuario['tiempo_inicio'] : 0;
                                            $tiempo_actual = time(); // Asumiendo que `time()` da el tiempo actual en segundos
                                            $tiempo_corriendo = $tiempo_actual - $tiempo_inicio;
                                            echo segundos_a_tiempo($tiempo_corriendo);
                                            ?>
                                        </td>
                                        <td>
                                            <!-- Acciones -->
                                            <a href="../private/procesos/accion.php?codigo=<?php echo urlencode($usuario['codigo']); ?>&accion=pausar" class="btn btn-warning">Pausar</a>
                                            <a href="../private/procesos/accion.php?codigo=<?php echo urlencode($usuario['codigo']); ?>&accion=ausente" class="btn btn-danger">Marcar Ausente</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>