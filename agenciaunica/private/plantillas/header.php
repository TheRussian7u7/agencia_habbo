<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>AGENCIA HABBO: TWITCH</title>
 
  <!--favicon-->
  <link rel="icon" href="/agenciaunica/private/assets/images/favicon.png" type="image/x-icon">
  
  <!-- Vector CSS -->
  <link href="/agenciaunica/private/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  
  <!-- Bootstrap core CSS-->
  <link href="/agenciaunica/private/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/agenciaunica/private/assets/css/bootstrap.css">
  
  <!-- Icons boostrap CSS-->
  <link href="/agenciaunica/private/assets/css/icons.css" rel="stylesheet" type="text/css" />
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- DATATABLE-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  

</head>



<?php
require_once('../private/procesos/db.php'); // Incluye el archivo de conexión a la base de datos

session_start(); // Inicia la sesión si no está iniciada

// Verifica si el usuario está autenticado y tiene un rol asignado
if (isset($_SESSION['rol_id'])) {
  $rol = $_SESSION['rol_id'];

  // Dependiendo del rol, incluye el menú correspondiente
  switch ($rol) {
    case 1:
      require_once('../private/menus/menu_rangos_bajos.php');
      break;
    case 2:
      require_once('../private/menus/menu_rangos_medio.php');
      break;
    case 3:
      require_once('../private/menus/menu_rangos_altos.php');
      break;
    case 4:
      require_once('../private/menus/menu_rangos_dueños.php');
      break;
    default:
      
      header('Location: /agenciaunica/login.php'); 
      exit();
  }
} else {
  // Si no hay rol definido, redirige a la página de inicio de sesión
  header('Location: /agenciaunica/login.php');
  exit();
}
?>