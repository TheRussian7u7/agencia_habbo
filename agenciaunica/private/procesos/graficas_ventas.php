<?php
include 'db.php'; // Asegúrate de tener tu conexión a la base de datos aquí

// Consulta para obtener las ventas de la tabla 'ventas'
$query = "SELECT v.id_venta, v.descripcion, v.nombre_comprador, v.precio, v.fecha_compra, v.fecha_vencimiento, v.vendedor_id, v.estatus, v.fecha_de_venta, u.nombre_usuario AS vendedor 
          FROM ventas v 
          LEFT JOIN usuarios u ON v.vendedor_id = u.id_usuario";
$result = $conn->query($query);

// Inicializar los datos para la gráfica y tabla
$ganancias = [];
$placasVendidas = [];
$ventas = [];

while ($row = $result->fetch_assoc()) {
    // Agregar las ventas para la tabla
    $ventas[] = [
        'descripcion' => $row['descripcion'],
        'nombre_comprador' => $row['nombre_comprador'],
        'fecha_compra' => $row['fecha_compra'],
        'vendedor' => $row['vendedor'],
        'estatus' => ($row['fecha_vencimiento'] > date("Y-m-d")) ? 'Activo' : 'Caducado'
    ];

    // Sumar ganancias por tipo de placa (descripción)
    if (!isset($ganancias[$row['descripcion']])) {
        $ganancias[$row['descripcion']] = 0;
    }
    $ganancias[$row['descripcion']] += $row['precio'];

    // Contar la cantidad de placas vendidas por tipo
    if (!isset($placasVendidas[$row['descripcion']])) {
        $placasVendidas[$row['descripcion']] = 0;
    }
    $placasVendidas[$row['descripcion']]++;
}

// Retornar los datos como JSON
echo json_encode([
    'ganancias' => $ganancias,
    'placasVendidas' => $placasVendidas,
    'ventas' => $ventas
]);

$conn->close();
?>