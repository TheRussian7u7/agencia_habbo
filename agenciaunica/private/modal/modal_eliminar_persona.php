<?php require_once('../private/procesos/eliminar_persona.php'); ?>

<!-- Modal para Eliminar Administradores -->
<div class="modal fade" id="deleteAdminModal" tabindex="-1" aria-labelledby="deleteAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAdminModalLabel">Eliminar Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabs -->
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
                            <form id="deleteAdminForm-<?= $admin['id'] ?>" method="post" action="../private/procesos/eliminar_persona.php">
                                <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                                
                                <p>¿Está seguro de que desea eliminar al administrador?</p>
                                <button type="submit" class="btn btn-danger w-100">Eliminar</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
