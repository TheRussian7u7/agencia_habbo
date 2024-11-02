<?php
// Incluir archivo de conexión
include('db.php');

// Consulta para la última noticia
$sql_noticia = "SELECT titulo, descripcion, fecha FROM publicaciones WHERE id_tipo = 1 ORDER BY fecha DESC LIMIT 1";
$result_noticia = $conn->query($sql_noticia);
$noticia = $result_noticia->fetch_assoc();

// Consulta para la última actualización
$sql_actualizacion = "SELECT titulo, descripcion, fecha FROM publicaciones WHERE id_tipo = 2 ORDER BY fecha DESC LIMIT 1";
$result_actualizacion = $conn->query($sql_actualizacion);
$actualizacion = $result_actualizacion->fetch_assoc();

// Consulta para la última publicación de blog
$sql_blog = "SELECT titulo, descripcion, fecha FROM publicaciones WHERE id_tipo = 3 ORDER BY fecha DESC LIMIT 1";
$result_blog = $conn->query($sql_blog);
$blog = $result_blog->fetch_assoc();

// Cerrar conexión
$conn->close();
?>