<?php
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM modificar_administradores WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirigir a otra página en caso de éxito
            header("Location: /agenciaunica/public/profile.php?status=success");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al eliminar registro: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la declaración: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>