<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $rango = $_POST['rango'];

    $stmt = $conn->prepare("INSERT INTO modificar_administradores (nombre, rango) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $nombre, $rango);

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

    $conn->close();
}
?>