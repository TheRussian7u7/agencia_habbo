<?php
// Iniciar sesión y conectar a la base de datos
session_start();
require_once('db.php');  // Asegúrate de tener el archivo de conexión correcto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : '';
    $rango_usuario = isset($_POST['rango_usuario']) ? $_POST['rango_usuario'] : '';
    $total_paga = isset($_POST['total_paga']) ? $_POST['total_paga'] : 0;
    $tipo_pago = isset($_POST['tipo_pago']) ? $_POST['tipo_pago'] : '';
    $tiene_placa_guarda = isset($_POST['placa_guarda']) ? 'si' : 'no';  // Checkbox: si está marcada, se guarda 'si', sino 'no'
    $comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : '';
    $estatus = isset($_POST['estatus']) ? $_POST['estatus'] : '';

    // Validar ID de usuario de sesión (si está autenticado)
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];

        // Preparar la consulta para insertar en la tabla 'paga'
        $sql = "INSERT INTO paga (id_usuario, nombre_usuario, rango_usuario, total_paga, tipo_pago, tiene_placa_guarda, comentarios, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("issdssss", $id_usuario, $nombre_usuario, $rango_usuario, $total_paga, $tipo_pago, $tiene_placa_guarda, $comentarios, $estatus);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Redirigir al usuario con éxito
                echo "<script>
                        alert('Paga registrada exitosamente.');
                        window.location.href = '/agenciaunica/public/gestion_de_pagas.php';  // Cambiar a la página de destino correspondiente
                      </script>";
            } else {
                // Manejo de errores
                echo "<script>
                        alert('Error al registrar la paga. Intenta nuevamente.');
                        window.location.href = '/agenciaunica/public/index.php';
                      </script>";
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            // Manejo de errores en la preparación de la consulta
            echo "<script>
                    alert('Error en la preparación de la consulta.');
                    window.location.href = '/agenciaunica/public/index.php';
                  </script>";
        }
    } else {
        // Manejo de errores si la sesión no tiene un usuario válido
        echo "<script>
                alert('No se encontró sesión activa. Por favor, inicia sesión.');
                window.location.href = 'login.php';
              </script>";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
