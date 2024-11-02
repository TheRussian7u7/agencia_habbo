<?php require_once('../private/procesos/eliminar_membresias.php'); ?>

<div class="modal fade" id="deleteMembershipModal" tabindex="-1" aria-labelledby="deleteMembershipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMembershipModalLabel">Eliminar Membresía</h5>
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
                            <form id="deleteMembershipForm-<?= $membresia['id'] ?>" method="post" action="../private/procesos/eliminar_membresias.php">
                                <input type="hidden" name="id" value="<?= $membresia['id'] ?>">
                                
                                <p>¿Está seguro de que desea eliminar la membresía?</p>
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