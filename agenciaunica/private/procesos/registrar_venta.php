<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $nombre_comprador = isset($_POST['nombre_comprador']) ? $_POST['nombre_comprador'] : '';
    $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
    $fecha_compra = isset($_POST['fecha_compra']) ? $_POST['fecha_compra'] : '';
    $fecha_vencimiento = isset($_POST['fecha_vencimiento']) ? $_POST['fecha_vencimiento'] : '';
    $estatus = ''; // Se calculará según la fecha de vencimiento

    // Verificar que la sesión tiene el ID del vendedor
    if (isset($_SESSION['id_usuario'])) {
        $vendedor_id = $_SESSION['id_usuario']; // Usamos el id del usuario registrado como vendedor

        // Calcular el estatus según la fecha de vencimiento
        $fecha_actual = date('Y-m-d');
        if ($fecha_actual > $fecha_vencimiento) {
            $estatus = 'Vencido';
        } else {
            $estatus = 'Activo';
        }

        // Insertar la venta en la tabla ventas
        $sql = "INSERT INTO ventas (descripcion, nombre_comprador, precio, fecha_compra, fecha_vencimiento, vendedor_id, estatus, fecha_de_venta)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssis", $descripcion, $nombre_comprador, $precio, $fecha_compra, $fecha_vencimiento, $vendedor_id, $estatus);

        
        if ($stmt->execute()) {
            // Redirigir con éxito
            echo "<script>
                    alert('Compra registrada exitosamente.');
                    window.location.href = '/agenciaunica/public/index.php';
                  </script>";
        } else {
            // Error en la inserción
            echo "<script>
                    alert('Error al registrar la compra.');
                    window.location.href = '/agenciaunica/public/index.php';
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('No se encontró la sesión del vendedor.');
                window.location.href = '/agenciaunica/login.php';
              </script>";
    }
}

$conn->close();
?>
