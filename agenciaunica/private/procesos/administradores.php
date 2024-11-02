<?php
require_once('db.php');

$sql_admin = "SELECT `id`, `nombre`, `rango`,`cara`,`accion`,`bebida` FROM `modificar_administradores`";
$result_admin = $conn->query($sql_admin);

// Almacenar los resultados en un array
$administradores = [];
if ($result_admin->num_rows > 0) {
    while ($row = $result_admin->fetch_assoc()) {
        $administradores[] = $row;
    }
}

// Preparar la consulta para las membresías
$sql_membership = "SELECT `id`, `nombre`, `precio`, `duracion`, `beneficios` FROM `modificar_membresias`";
$stmt = $conn->prepare($sql_membership);

// Ejecutar la consulta
$stmt->execute();
$result_membership = $stmt->get_result();

// Almacenar los resultados en un array
$membresias = [];
if ($result_membership->num_rows > 0) {
    while ($row = $result_membership->fetch_assoc()) {
        $membresias[] = $row;
    }
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>

<!--ADMINISTRADORES-->

<section class="section category">
    <h2 class="section__title">Administradores y dueños del Reino</h2>

    <div class="category__container container grid">
        <?php foreach ($administradores as $admin) : ?>
            <div class="category__data text-center">
                <img src="https://www.habbo.es/habbo-imaging/avatarimage?user=<?= htmlspecialchars($admin['nombre']) ?>&direction=3&head_direction=3&gesture=<?= htmlspecialchars($admin['cara']) ?>&action=<?= htmlspecialchars($admin['accion']) ?>,<?= htmlspecialchars($admin['bebida']) ?>&size=l"
                    class="category__img img-fluid mx-auto mb-2" alt="Avatar de <?= htmlspecialchars($admin['nombre']) ?>">

                <h3 class="category__title"><?= htmlspecialchars($admin['nombre']) ?></h3>
                <span class="badge"><?= htmlspecialchars($admin['rango']) ?></span>

            </div>
        <?php endforeach; ?>
    </div>
</section>


<!--MEMBRESIAS-->

<section class="section new" id="new">
    <h2 class="section__title">Membresías</h2>

    <div class="new__container container">
        <div class="swiper new-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($membresias as $membresia) : ?>
                    <div class="new__content swiper-slide">
                        <div class="new__tag">New</div>

                        <a class="custom-block-image-wrap">
                            <?php
                            $imagenes = [
                                1 => 'private/images/images/membresias/diamante.jpg',
                                2 => 'private/images/images/membresias/guarda_paga_plus.jpg',
                                3 => 'private/images/images/membresias/level_up.jpg',
                                4 => 'private/images/images/membresias/premium.jpg',
                                5 => 'private/images/images/membresias/regla_libre.jpg',
                                6 => 'private/images/images/membresias/guarda_paga.jpg'
                            ];
                            $imagenSrc = $imagenes[$membresia['id']] ?? 'private/assets/images/mantenimiento.png';
                            ?>
                            <img src="<?= htmlspecialchars($imagenSrc) ?>" class="new__img img-fluid" alt="Membresía">
                        </a>

                        <h3 class="new__title"><?= htmlspecialchars($membresia['nombre']) ?></h3>
                        <span class="new__subtitle">Duración: <?= htmlspecialchars($membresia['duracion']) ?></span>

                        <div class="new__prices">
                            <span class="new__price"><?= htmlspecialchars($membresia['precio']) ?> Creditos</span>
                        </div>

                        <p class="new__description">
                            <?= htmlspecialchars($membresia['beneficios']) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>