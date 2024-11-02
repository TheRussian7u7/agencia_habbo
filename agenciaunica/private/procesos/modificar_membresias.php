<?php
// Incluir archivo de conexión a la base de datos
require_once('db.php');

// Verificar si se han enviado datos del formulario para actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $duracion = isset($_POST['duracion']) ? $_POST['duracion'] : '';
    $beneficios = isset($_POST['beneficios']) ? $_POST['beneficios'] : '';

    // Preparar la consulta de actualización
    $sql_update = "UPDATE modificar_membresias SET nombre = ?, precio = ?, duracion = ?, beneficios = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param('ssssi', $nombre, $precio, $duracion, $beneficios, $id);

    if ($stmt->execute()) {
        // Actualización exitosa
        // Redirigir a la misma página para evitar el reenvío del formulario
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Manejar errores
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Preparar la consulta para obtener todas las membresías
$sql_membership = "SELECT id, nombre, precio, duracion, beneficios FROM modificar_membresias";
$stmt = $conn->prepare($sql_membership);
$stmt->execute();
$result_membership = $stmt->get_result();

// Almacenar los resultados en un array
$membresias = [];
if ($result_membership->num_rows > 0) {
    while ($row = $result_membership->fetch_assoc()) {
        $membresias[] = $row;
    }
}

$stmt->close();
$conn->close();
?>