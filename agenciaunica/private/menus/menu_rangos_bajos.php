<?php
$nombre_usuario = isset($_SESSION['usuario_registro']) ? $_SESSION['usuario_registro'] : 'usuario_registro';
$rol = isset($_SESSION['rol_id']) ? $_SESSION['rol_id'] : 1; // 1 por defecto, si no está definido

// Mapear el rol a una descripción
$roles = [
  1 => 'Rango Bajo',
  2 => 'Rango Medio',
  3 => 'Rango Alto',
  4 => 'Rango dueño'
];
?>

<!-- MENU PRINCIPAL -->
<nav class="navbar navbar-dark fixed-top" style="background-color: #2d1b32;" aria-label="Light offcanvas navbar">
  <div class="container-fluid">

    <div class="d-flex justify-content-between w-100">

      <!-- Título del Menú con Offcanvas -->
      <a class="navbar-brand" href="#" data-bs-toggle="offcanvas" data-bs-target="#userInfoCanvas" aria-controls="userInfoCanvas">
        PERFIL
      </a>

      <style>
        .avatar-container {
          width: 100px;
          height: 100px;
          overflow: hidden;
          border-radius: 50%;
          border: 3px solid white;
          display: flex;
          justify-content: center;
          align-items: center;
        }

        .avatar-image {
          width: 100%;
          height: auto;
        }

        .virtual-money-container {
          background-color: #4e2a57;
          padding: 10px 15px;
          border-radius: 12px;
          box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
          display: inline-block;
        }

        .money-icon {
          font-size: 30px;
          margin-bottom: 5px;
        }

        @media (max-width: 576px) {
          .avatar-container {
            width: 80px;
            height: 80px;
          }

          .virtual-money-container {
            font-size: 0.9rem;
          }
        }
      </style>

      <!-- Offcanvas para Información del Usuario -->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="userInfoCanvas" aria-labelledby="userInfoCanvasLabel" style="background-color: #2d1b32; color: white;">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="userInfoCanvasLabel">Perfil del Usuario</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-center">
          <!-- Avatar del Usuario -->
          <div class="avatar-kekos mx-auto mb-3">
            <img src="https://www.habbo.es/habbo-imaging/avatarimage?user=<?php echo htmlspecialchars($nombre_usuario); ?>&direction=3&head_direction=3&gesture=sml&action=none&size=b" alt="Avatar" class="avatar-image">
          </div>

          <?php
          $rol_descripcion = isset($roles[$rol]) ? $roles[$rol] : 'Rango Desconocido';
          // Obtener el id_usuario a partir del nombre de usuario
          $sql_usuario = "SELECT id FROM registro_usuario WHERE usuario_registro = ?";
          $stmt = $conn->prepare($sql_usuario);
          $stmt->bind_param("s", $nombre_usuario);
          $stmt->execute();
          $result = $stmt->get_result();

          // Consultar los créditos del usuario
          if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $id_usuario = $usuario['id'];

            $sql_creditos = "SELECT creditos FROM dinero_digital WHERE id_usuario = ?";
            $stmt_creditos = $conn->prepare($sql_creditos);
            $stmt_creditos->bind_param("i", $id_usuario);
            $stmt_creditos->execute();
            $result_creditos = $stmt_creditos->get_result();

            if ($result_creditos->num_rows > 0) {
              $dinero = $result_creditos->fetch_assoc();
              $creditos = $dinero['creditos'];
            } else {
              $creditos = 0; // Si no tiene créditos registrados
            }
          } else {
            $creditos = 0; // Si no se encontró el usuario
          }

          // Consultar rangos
          $sql_usuario = "
    SELECT ru.id, ru.usuario_registro, r.rango 
    FROM registro_usuario ru 
    JOIN rangos r ON ru.Rango_asignado = r.id_rango 
    WHERE ru.usuario_registro = ?";
          $stmt = $conn->prepare($sql_usuario);
          $stmt->bind_param("s", $nombre_usuario);
          $stmt->execute();
          $result = $stmt->get_result();

          // Verificar si se encontró el usuario
          if ($row = $result->fetch_assoc()) {
            $rango = $row['rango'];
          } else {
            $rango = 'Rango Desconocido';
          }

          // 1. Obtener el codigo_usuario a partir del id_persona
          $sql_codigo = "SELECT codigo_usuario FROM sistema_asctim WHERE id_persona = ?";
          $stmt_codigo = $conn->prepare($sql_codigo);
          $stmt_codigo->bind_param("i", $id_usuario);
          $stmt_codigo->execute();
          $result_codigo = $stmt_codigo->get_result();
          $codigo_usuario = $result_codigo->fetch_assoc()['codigo_usuario'] ?? '';

          // 2. Obtener la misión actual desde la tabla ascensos
          $sql_mision = "SELECT mision_actual FROM ascensos WHERE codigo_id = ?";
          $stmt_mision = $conn->prepare($sql_mision);
          $stmt_mision->bind_param("s", $codigo_usuario);
          $stmt_mision->execute();
          $result_mision = $stmt_mision->get_result();
          $mision_actual = $result_mision->fetch_assoc()['mision_actual'] ?? 'Sin misión registrada';

          // 3. Obtener el tiempo y estado desde tiempos_de_paga
          $sql_tiempo = "SELECT tiempo_acumulado, estado_tiempo FROM tiempos_de_paga WHERE codigo_id = ?";
          $stmt_tiempo = $conn->prepare($sql_tiempo);
          $stmt_tiempo->bind_param("s", $codigo_usuario);
          $stmt_tiempo->execute();
          $result_tiempo = $stmt_tiempo->get_result();
          $row_tiempo = $result_tiempo->fetch_assoc();

          $tiempo_acumulado = $row_tiempo['tiempo_acumulado'] ?? '0 horas';
          $estado_tiempo = $row_tiempo['estado_tiempo'] ?? 'Desconocido';

          ?>

          <hr>
          <p class="badge">Datos personales</p>
          <!-- Información del Usuario -->
          <p class="text-white">id usuario: <?php echo htmlspecialchars($id_usuario); ?></p>
          <p class="text-white">Nombre usuario: <?php echo htmlspecialchars($nombre_usuario); ?></p>
          <p class="text-white">Rango: <?php echo htmlspecialchars($rango); ?></p>

          <HR>
          </HR>
          <p class="badge">Datos de trabajo</p>
          <p class="text-white">Código: <?php echo htmlspecialchars($codigo_usuario); ?></p>
          <p class="text-white">Misión: <?php echo htmlspecialchars($mision_actual); ?></p>
          <p class="text-white">Tiempo total: <?php echo htmlspecialchars($tiempo_acumulado); ?></p>
          <p class="text-white">Estatus de tiempo: <?php echo htmlspecialchars($estado_tiempo); ?></p>

          <hr>
          <!-- Dinero Virtual -->
          <div class="virtual-money-container mt-4">
            <h5>Créditos:</h5>
            <h3 id="virtualBalance">$ <?php echo $creditos; ?></h3>
          </div>

        </div>
      </div>

      <style>
        .avatar-kekos {
          width: 100px;
          height: 100px;
          overflow: hidden;
          border-radius: 50%;
          border: 3px solid white;
          display: flex;
          justify-content: center;
          align-items: center;
        }

        .avatar-image {
          width: 100%;
          height: auto;
        }

        @media (max-width: 576px) {
          .avatar-kekos {
            width: 100px;
            height: 100px;
          }
        }

        
      </style>

      <div class="avatar-container">
        <img src="/agenciaunica/private/assets/images/favicon.png" alt="Avatar" class="avatar-image">
      </div>


      <!-- Botón de la hamburguesa alineado a la derecha -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarDark"
        aria-controls="offcanvasNavbarDark" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-end text-white" style="background-color: #2d1b32;" tabindex="-1" id="offcanvasNavbarDark"
      aria-labelledby="offcanvasNavbarDarkLabel">

      <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="userInfoCanvasLabel">MENU DE ALTOS</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav flex-grow-1 pe-3">

          <!-- Menú de navegación -->
          <li class="nav-item">
            <a class="nav-link text-white" href="index.php?page=HOM"><i class="fas fa-home me-2"></i>Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-info-circle me-2"></i>Información
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="index.php?page=RAG">
                  <i class="fas fa-medal"></i> Rangos
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-gem"></i> Membresías
                </a>
              </li>
            </ul>
          </li>    
          
          <li class="nav-item">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <button class="btn btn-danger"> <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</button>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>


<!-- Modal para Confirmar Cierre de Sesión -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Cerrar sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas cerrar sesión?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="../private/modal/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
      </div>
    </div>
  </div>
</div>

<style>
  .avatar-container {
    width: 50px;
    height: 50px;
    overflow: hidden;
    border-radius: 50%;
    border: 2px solid #d4af37;
    /* Dorado antiguo */
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 0 12px #d4af37;
  }

  .avatar-image {
    width: 100%;
    height: auto;
  }

  .navbar-toggler-icon {
    background-image: url('/agenciaunica/private/images//menu/ghost.png');
    /* Icono gótico */
    background-size: cover;
  }

  .navbar-nav .nav-link {
    color: #d4af37;
    /* Dorado suave */
    transition: color 0.3s ease;
    font-family: 'Cinzel', serif;
    /* Fuente con aire gótico */
  }

  .navbar-nav .nav-link:hover {
    color: white;
    text-shadow: 0 0 10px #d4af37;
  }

  .text-gold {
    color: #d4af37;
  }

  @media (max-width: 576px) {
    .avatar-container {
      width: 40px;
      height: 40px;
    }
  }
</style>
