<?php
// Incluir archivo de conexión a la base de datos
require_once('db.php');

// Verificar si se han enviado datos del formulario para eliminación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Preparar la consulta de eliminación
    $sql_delete = "DELETE FROM `modificar_membresias` WHERE `id` = ?";
    $stmt = $conn->prepare($sql_delete);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Eliminación exitosa
        // Redirigir a la misma página para evitar el reenvío del formulario
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Manejar errores
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

?>