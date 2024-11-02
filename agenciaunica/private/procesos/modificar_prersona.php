<?php
require_once('db.php');

function obtenerAdministradores() {
    global $conn;
    $sql = "SELECT id, nombre, rango, cara, accion, bebida, fecha FROM modificar_administradores";
    $result = $conn->query($sql);

    $administradores = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $administradores[] = $row;
        }
    }

    return $administradores;
}

$administradores = obtenerAdministradores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $rango = $_POST['rango'];
    $cara = $_POST['cara'];
    $bebida = $_POST['bebida'];
    $accion = $_POST['accion'];

    $stmt = $conn->prepare("UPDATE modificar_administradores SET nombre = ?, rango = ?, cara = ?, bebida = ?, accion = ? WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("sssssi", $nombre, $rango, $cara, $bebida, $accion, $id);

        if ($stmt->execute()) {
            // Redirigir a otra página en caso de éxito
            header("Location: /agenciaunica/public/profile.php?status=success");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error actualizando registro: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la declaración: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>