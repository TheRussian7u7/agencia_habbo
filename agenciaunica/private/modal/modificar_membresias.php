<?php require_once('../private/procesos/modificar_membresias.php'); ?>

<!-- Modal para Modificar Membresías -->
<div class="modal fade" id="editMembershipModal" tabindex="-1" aria-labelledby="editMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMembershipModalLabel">Modificar Membresía</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabs -->
                <ul class="nav nav-tabs" id="membershipTab" role="tablist">
                    <?php foreach ($membresias as $index => $membresia) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $index === 0 ? 'active' : '' ?>" id="tab-<?= $membresia['id'] ?>" data-bs-toggle="tab" href="#membership-<?= $membresia['id'] ?>" role="tab" aria-controls="membership-<?= $membresia['id'] ?>" aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                Membresía <?= $membresia['id'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-3">
                    <?php foreach ($membresias as $index => $membresia) : ?>
                        <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" id="membership-<?= $membresia['id'] ?>" role="tabpanel" aria-labelledby="tab-<?= $membresia['id'] ?>">
                            <form id="membershipForm-<?= $membresia['id'] ?>" method="post" action="../private/procesos/modificar_membresias.php">
                                <input type="hidden" name="id" value="<?= $membresia['id'] ?>">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nombre-<?= $membresia['id'] ?>" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre-<?= $membresia['id'] ?>" name="nombre" value="<?= htmlspecialchars($membresia['nombre']) ?>">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="precio-<?= $membresia['id'] ?>" class="form-label">Precio</label>
                                        <input type="text" class="form-control" id="precio-<?= $membresia['id'] ?>" name="precio" value="<?= htmlspecialchars($membresia['precio']) ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="duracion-<?= $membresia['id'] ?>" class="form-label">Duración</label>
                                        <input type="text" class="form-control" id="duracion-<?= $membresia['id'] ?>" name="duracion" value="<?= htmlspecialchars($membresia['duracion']) ?>">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="beneficios-<?= $membresia['id'] ?>" class="form-label">Beneficios</label>
                                        <textarea class="form-control" id="beneficios-<?= $membresia['id'] ?>" name="beneficios"><?= htmlspecialchars($membresia['beneficios']) ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Guardar cambios</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>