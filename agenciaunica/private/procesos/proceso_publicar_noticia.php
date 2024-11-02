<?php
// proceso_publicar_noticia.php

// Conectar a la base de datos
require 'db.php'; // Asegúrate de que este archivo tenga la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger los datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $id_tipo = $_POST['id_tipo'];
    
    // Obtener la fecha actual
    $fecha = date('Y-m-d H:i:s'); // Formato de fecha y hora

    // Preparar la consulta SQL para insertar la nueva publicación
    $stmt = $conn->prepare("INSERT INTO publicaciones (titulo, descripcion, fecha, id_tipo) VALUES (?, ?, ?, ?)");
    
    if ($stmt) {
        $stmt->bind_param("sssi", $titulo, $descripcion, $fecha, $id_tipo);

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
    
    // Cerrar la conexión
    $conn->close();
}
?>
