<?php
// Conexión a la base de datos
include('db.php'); // Asegúrate de tener el archivo db.php para la conexión a tu base de datos

// Consulta SQL
$query = "SELECT id, id_usuario, fecha_pago, nombre_usuario, rango_usuario, total_paga, tipo_pago, tiene_placa_guarda, comentarios, estado FROM paga WHERE 1";
$result = $conn->query($query);

// Preparar datos para el JSON
$pagas = [];
$totalPagado = 0;
$gastoSemana = [
    'Miercoles' => 0,
    'Domingo' => 0
];
$rangoPagos = [];

// Procesar los datos
while($row = $result->fetch_assoc()) {
    $pagas[] = $row;
    
    // Calcular gasto por día
    if ($row['tipo_pago'] === 'Miercoles') {
        $gastoSemana['Miercoles'] += $row['total_paga'];
    } elseif ($row['tipo_pago'] === 'Domingo') {
        $gastoSemana['Domingo'] += $row['total_paga'];
    }
    
    // Total pagado
    $totalPagado += $row['total_paga'];

    // Sumar paga por rango
    if (!isset($rangoPagos[$row['rango_usuario']])) {
        $rangoPagos[$row['rango_usuario']] = 0;
    }
    $rangoPagos[$row['rango_usuario']] += $row['total_paga'];
}

// Devolver los datos en formato JSON
echo json_encode([
    'pagas' => $pagas,
    'gastoSemana' => $gastoSemana,
    'totalPagado' => $totalPagado,
    'rangoPagos' => $rangoPagos
]);
?>