<?php
// Conexión a la base de datos
include('db.php');

// Verificar si se han proporcionado los parámetros necesarios
if (isset($_GET['codigo']) && isset($_GET['accion'])) {
    $codigo = $_GET['codigo'];
    $accion = $_GET['accion'];
    $tiempo_actual = time();

    // Validar el código y la acción
    $acciones_validas = ['pausar', 'ausente'];
    if (!in_array($accion, $acciones_validas)) {
        echo "Acción inválida.";
        exit();
    }

    // Preparar la consulta para obtener los datos del usuario
    $sql = "SELECT * FROM ascender_y_tomartime WHERE codigo = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $codigo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $estado_tiempo = $data['estado_tiempo'];
            $tiempo_inicio = (int) $data['tiempo_inicio']; // En segundos
            $tiempo_acumulado = (int) $data['tiempo_acumulado']; // En segundos

            if ($accion === 'pausar') {
                // Pausar el tiempo
                $tiempo_transcurrido = $tiempo_actual - $tiempo_inicio;
                $tiempo_acumulado += $tiempo_transcurrido;

                $sql = "UPDATE ascender_y_tomartime SET estado_tiempo = 'pausado', tiempo_acumulado = ? WHERE codigo = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('is', $tiempo_acumulado, $codigo);
                    $stmt->execute();
                    echo "Tiempo pausado correctamente.";
                } else {
                    echo "Error al preparar la declaración para pausar: " . $conn->error;
                }
            } elseif ($accion === 'ausente') {
                // Marcar como ausente
                $tiempo_transcurrido = $tiempo_actual - $tiempo_inicio;
                $tiempo_acumulado -= $tiempo_transcurrido;
                if ($tiempo_acumulado < 0) $tiempo_acumulado = 0;

                $sql = "UPDATE ascender_y_tomartime SET estado_tiempo = 'ausente', tiempo_acumulado = ? WHERE codigo = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param('is', $tiempo_acumulado, $codigo);
                    $stmt->execute();
                    echo "Tiempo marcado como ausente.";
                } else {
                    echo "Error al preparar la declaración para marcar como ausente: " . $conn->error;
                }
            }
        } else {
            echo "No se encontraron datos para el código proporcionado.";
        }

        $stmt->close();
    } else {
        echo "Error al preparar la declaración inicial: " . $conn->error;
    }
} else {
    echo "Código o acción no proporcionados.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
