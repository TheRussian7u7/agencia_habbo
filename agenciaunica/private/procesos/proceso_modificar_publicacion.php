<?php
include 'db.php'; // Incluir archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_publicacion = $_POST['id_publicacion'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $id_tipo = $_POST['id_tipo'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE publicaciones SET titulo = ?, descripcion = ?, id_tipo = ? WHERE id_publicacion = ?");
    
    if ($stmt) {
        $stmt->bind_param("ssii", $titulo, $descripcion, $id_tipo, $id_publicacion);

        if ($stmt->execute()) {
            // Redirigir a otra página en caso de éxito
            header("Location: /agenciaunica/public/index.php?status=success");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al ejecutar la declaración: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la declaración: " . $conn->error . "</div>";
    }
}
?>
