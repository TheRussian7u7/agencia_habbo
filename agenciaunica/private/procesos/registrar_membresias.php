<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base de datos
    require_once('db.php');

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $duracion = $_POST['duracion'];
    $beneficios = $_POST['beneficios'];

    // Preparar la consulta SQL
    $sql = "INSERT INTO modificar_membresias (nombre, precio, duracion, beneficios) VALUES (?, ?, ?, ?)";

    // Preparar la declaración
    if ($stmt = $conn->prepare($sql)) {
        // Enlazar los parámetros
        $stmt->bind_param("ssss", $nombre, $precio, $duracion, $beneficios);

        // Ejecutar la declaración y redirigir
        if ($stmt->execute()) {
            // Redirigir a otra página en caso de éxito
            header("Location: /agenciaunica/public/profile.php?status=success");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al ejecutar la declaración: " . $stmt->error . "</div>";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Error al preparar la declaración: " . $conn->error . "</div>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>
