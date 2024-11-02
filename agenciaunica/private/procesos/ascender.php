<?php
include 'db.php'; // Conexión a la base de datos

if ($_POST['accion'] === 'buscar') {
    $codigo = $_POST['codigo'];
    $query = "SELECT a.*, s.* 
              FROM ascensos a 
              JOIN sistema_asctim s ON a.codigo_id = s.id 
              WHERE s.codigo_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $codigo);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        echo json_encode(['success' => true, 'encargado' => $result['id_usuario_encargado'], 
                          'firma_encargado' => $result['firma_encargado'], 
                          'rango' => $result['rango'], 
                          'firma' => $result['firma'], 
                          'mision_actual' => $result['mision_actual'], 
                          'tiempo_ultimo_ascenso' => $result['tiempo_ultimo_ascenso'], 
                          'id_codigo' => $result['codigo_id']]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($_POST['accion'] === 'ascender') {
    $id_codigo = $_POST['id_codigo'];
    $id_usuario_encargado = $_POST['id_usuario_encargado'];
    $firma_encargado = $_POST['firma_encargado'];
    $usuario_ascendido = $_POST['usuario_ascendido'];
    $rango = $_POST['rango'];
    $mision_nueva = $_POST['mision_nueva'];

    $tiempo = ($rango === 'Seguridad') ? '00:30:00' : '00:20:00';

    $query = "INSERT INTO ascensos (codigo_id, usuario_ascendido, id_usuario_encargado, firma_encargado, rango, mision_nueva, tiempo_ultimo_ascenso) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('issssss', $id_codigo, $usuario_ascendido, $id_usuario_encargado, $firma_encargado, $rango, $mision_nueva, $tiempo);

    if ($stmt->execute()) {
        echo "Ascenso registrado correctamente.";
    } else {
        echo "Error al registrar el ascenso.";
    }
}
?>
