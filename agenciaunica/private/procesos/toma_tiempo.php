<?php
session_start();
include 'db.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $usuario_encargado = $_SESSION['usuario_id']; // ID del usuario encargado

    // Verificar si el código existe
    $sql_check = "SELECT * FROM sistema_asctim WHERE codigo = '$codigo'";
    $result_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // Registrar el tiempo si el código es válido
        $sql_insert = "
            INSERT INTO tiempos_de_paga (codigo_id, id_usuario_encargado, tiempo_inicio, estado_tiempo) 
            VALUES ('$codigo', $usuario_encargado, NOW(), 'iniciado')
        ";

        if (mysqli_query($conn, $sql_insert)) {
            echo json_encode(['exito' => true]);
        } else {
            echo json_encode(['exito' => false, 'error' => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['exito' => false, 'error' => 'Código no encontrado.']);
    }
}
?>
