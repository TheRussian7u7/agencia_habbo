<?php
// Conexión a la base de datos
include('db.php');

// Inicializar las variables
$tiempo_transcurrido = 0;
$tiempo_actual = time(); // Asigna el tiempo actual para evitar problemas si no se define en los bloques

// Obtener el id_usuario basado en el usuario_registro de la tabla registro_usuario
$sql = "SELECT id FROM registro_usuario WHERE usuario_registro = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Usuario no encontrado.";
    exit;
}

$row = $result->fetch_assoc();
$id_usuario = $row['id'];

// Obtener los datos del usuario de la tabla ascender_y_tomartime
$sql = "SELECT * FROM ascender_y_tomartime WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No se encontraron datos para el usuario.";
    exit;
}

$data = $result->fetch_assoc();

// Asignar datos a variables
$estado_tiempo = $data['estado_tiempo'];
$tiempo_inicio = (int) $data['tiempo_inicio']; // En segundos desde el último inicio
$tiempo_acumulado = (int) $data['tiempo_acumulado']; // En segundos
$tiempo_restado = (int) $data['tiempo_restado']; // En segundos
$horas_para_proximo_ascenso = (int) $data['horas_para_proximo_ascenso']; // En segundos
$codigo = $data['codigo'];
$firma = $data['firma'];
$mision_actual = $data['mision_nueva'];
$rango = $data['rango'];

// Verificar el estado antes de calcular o modificar el tiempo
if ($estado_tiempo === 'iniciado') {
    // Calcular el tiempo transcurrido desde que se inició el tiempo
    $tiempo_transcurrido = $tiempo_actual - $tiempo_inicio; // En segundos

    // Sumar el tiempo transcurrido al tiempo acumulado
    $tiempo_acumulado += $tiempo_transcurrido;

    // Actualizar el tiempo de inicio para el próximo cálculo
    $tiempo_inicio = $tiempo_actual;

    // Guardar el tiempo acumulado y el nuevo tiempo de inicio en la base de datos
    $sql = "UPDATE ascender_y_tomartime SET tiempo_acumulado = ?, tiempo_inicio = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $tiempo_acumulado, $tiempo_inicio, $id_usuario);
    $stmt->execute();
} elseif ($estado_tiempo === 'ausente') {
    // Calcular el tiempo transcurrido desde que se inició el tiempo
    $tiempo_transcurrido = $tiempo_actual - $tiempo_inicio; // En segundos

    // Restar el tiempo transcurrido del tiempo acumulado
    $tiempo_acumulado -= $tiempo_transcurrido;
    if ($tiempo_acumulado < 0) $tiempo_acumulado = 0; // Evitar tiempos negativos

    // Guardar el tiempo acumulado actualizado y el nuevo tiempo de inicio en la base de datos
    $sql = "UPDATE ascender_y_tomartime SET tiempo_acumulado = ?, tiempo_inicio = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $tiempo_acumulado, $tiempo_actual, $id_usuario);
    $stmt->execute();
}

// Calcular el tiempo total
$tiempo_total = $tiempo_acumulado + $horas_para_proximo_ascenso;

// Función para convertir segundos a formato HH:MM:SS
function segundos_a_tiempo($segundos)
{
    $horas = floor($segundos / 3600);
    $minutos = floor(($segundos % 3600) / 60);
    $segundos = $segundos % 60;
    return sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);
}

// Formatear los tiempos
$horas_acumulado = segundos_a_tiempo($tiempo_acumulado);
$tiempo_restado = segundos_a_tiempo($tiempo_restado);
$tiempo_total = segundos_a_tiempo($tiempo_total);

// Calcular el tiempo recorriendo (si el tiempo está en estado "iniciado")
if ($estado_tiempo === 'iniciado') {
    $tiempo_recorrido = segundos_a_tiempo($tiempo_actual - $tiempo_inicio);
} else {
    $tiempo_recorrido = '00:00:00'; // No se está recorriendo tiempo si no está en estado "iniciado"
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
