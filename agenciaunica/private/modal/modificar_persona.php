<?php
require_once('../private/procesos/modificar_prersona.php');
$administradores = obtenerAdministradores();
?>

<!-- Modal para Modificar Administradores -->
<div class="modal fade" id="modificarModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAdminModalLabel">Modificar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="adminTab" role="tablist">
                    <?php foreach ($administradores as $index => $admin) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $index === 0 ? 'active' : '' ?>" id="tab-<?= $admin['id'] ?>" data-bs-toggle="tab" href="#admin-<?= $admin['id'] ?>" role="tab" aria-controls="admin-<?= $admin['id'] ?>" aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                Administrador <?= $admin['id'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <?php foreach ($administradores as $index => $admin) : ?>
                        <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" id="admin-<?= $admin['id'] ?>" role="tabpanel" aria-labelledby="tab-<?= $admin['id'] ?>">
                            <form id="adminForm-<?= $admin['id'] ?>" method="post" action="../private/procesos/modificar_prersona.php">
                                <input type="hidden" name="id" value="<?= $admin['id'] ?>">

                                <!-- Sección de Datos -->
                                <h6>Datos del Administrador</h6>
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="nombre-<?= $admin['id'] ?>">Nombre</label>
                                        <input type="text" class="form-control" id="nombre-<?= $admin['id'] ?>" name="nombre" value="<?= htmlspecialchars($admin['nombre']) ?>" required>
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="rango-<?= $admin['id'] ?>">Rango</label>
                                        <input type="text" class="form-control" id="rango-<?= $admin['id'] ?>" name="rango" value="<?= htmlspecialchars($admin['rango']) ?>" required>
                                    </div>
                                </div>

                                <!-- Sección de Configuraciones de Personaje -->
                                <h6>Configuraciones de Personaje</h6>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="cara-<?= $admin['id'] ?>">Selección de rostros</label>
                                        <select class="form-select" id="cara-<?= $admin['id'] ?>" name="cara" required>
                                            <?php
                                            $caras = [
                                                "agr" => "Enojado",
                                                "sad" => "Triste",
                                                "srp" => "Sorprendido",
                                                "eyb" => "Dormido",
                                                "none" => "Ninguno"
                                            ];
                                            $cara = $caras[htmlspecialchars($admin['cara'])] ?? "Ninguno";
                                            ?>
                                            <option value="#" hidden>Actualmente estás: <?= $cara ?></option>
                                            <?php foreach ($caras as $key => $value): ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="accion-<?= $admin['id'] ?>">Selección de acciones:</label>
                                        <select class="form-select" id="accion-<?= $admin['id'] ?>" name="accion" required>
                                            <?php
                                            $acciones = [
                                                "wav" => "Saludar",
                                                "sit" => "Sentarse",
                                                "none" => "Ninguno"
                                            ];
                                            $accion = $acciones[htmlspecialchars($admin['accion'])] ?? "Ninguno";
                                            ?>
                                            <option value="#" hidden>Actualmente estás con la acción de: <?= $accion ?></option>
                                            <?php foreach ($acciones as $key => $value): ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="bebida-<?= $admin['id'] ?>">Selección de bebidas:</label>
                                        <select class="form-select" id="bebida-<?= $admin['id'] ?>" name="bebida" required>
                                            <?php
                                            $bebidas = [
                                                "crr=1" => "Vaso de agua",
                                                "crr=2" => "Zanahoria",
                                                "crr=3" => "Nieve",
                                                "crr=5" => "Fumar coca",
                                                "crr=667" => "Vino tinto",
                                                "#" => "Ninguno"
                                            ];
                                            $bebida = $bebidas[htmlspecialchars($admin['bebida'])] ?? "Ninguno";
                                            ?>
                                            <option value="#" hidden>Actualmente estás con una bebida de: <?= $bebida ?></option>
                                            <?php foreach ($bebidas as $key => $value): ?>
                                                <option value="<?= $key ?>"><?= $value ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>