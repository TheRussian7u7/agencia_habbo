<body class="bg-theme">

  <style>
    .bg-theme {
      background-image: url('/agenciaunica/private/eventos/halloween/img/fondo.jpeg');
      /* Cambia esto */
      justify-content: center;
      align-items: center;
    }
  </style>

  <div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->

      <style>
        .card {
          background-color: #2c2f33;
          border-radius: 10px;
          padding: 20px;
        }

        .text-white {
          color: #fff;
        }

        .btn {
          border-radius: 5px;
          padding: 10px 20px;
        }

        .progress-bar {
          background-color: #4caf50;
        }

        .card {
          background-color: #5e4b8a;
          /* Color de fondo púrpura */
          color: #ffffff;
          /* Color de texto (blanco) */
          border: 2px solid #a57db5;
          /* Color de borde (púrpura más claro) */
          border-radius: 10px;
          padding: 20px;
        }
      </style>

      <div class="card mt-3">
        <div class="card-body">
          <div class="row text-center">
            <!-- Total Orders -->
            <div class="col-12 col-lg-3 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">9526 <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                <div class="progress my-3" style="height: 3px;">
                  <div class="progress-bar" style="width: 55%;"></div>
                </div>
                <p class="mb-0 text-white small-font">Total Orders <span class="float-right">+4.2% <i class="fa fa-long-arrow-up"></i></span></p>
              </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-3 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">8323 <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                <div class="progress my-3" style="height: 3px;">
                  <div class="progress-bar" style="width: 55%;"></div>
                </div>
                <p class="mb-0 text-white small-font">Total Revenue <span class="float-right">+1.2% <i class="fa fa-long-arrow-up"></i></span></p>
              </div>
            </div>
            <!-- Visitors -->
            <div class="col-12 col-lg-3 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">6200 <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                <div class="progress my-3" style="height: 3px;">
                  <div class="progress-bar" style="width: 55%;"></div>
                </div>
                <p class="mb-0 text-white small-font">Visitors <span class="float-right">+5.2% <i class="fa fa-long-arrow-up"></i></span></p>
              </div>
            </div>
            <!-- Messages -->
            <div class="col-12 col-lg-3 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">5630 <span class="float-right"><i class="fa fa-envira"></i></span></h5>
                <div class="progress my-3" style="height: 3px;">
                  <div class="progress-bar" style="width: 55%;"></div>
                </div>
                <p class="mb-0 text-white small-font">Messages <span class="float-right">+2.2% <i class="fa fa-long-arrow-up"></i></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php require_once('../private/procesos/mostrar_publicaciones.php'); ?>

      <div class="card mt-3">
        <div class="card-body">
          <div class="row text-center" style="max-height: 400px; overflow-y: auto;">
            <!-- Última Noticia -->
            <div class="col-12 col-lg-4 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">Última Noticia <span class="float-right"><i class="fa fa-newspaper-o"></i></span></h5>
                <h1>
                  <p class="mb-0 text-white"><?php echo $noticia['titulo']; ?></p>
                </h1>
                <p class="mb-0 text-white">
                  <?php echo substr($noticia['descripcion'], 0, 5500); ?>
                </p>
                <p class="text-white small-font"><?php echo $noticia['fecha']; ?></p>
              </div>
            </div>

            <!-- Actualización Importante -->
            <div class="col-12 col-lg-4 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">Actualización Importante <span class="float-right"><i class="fa fa-exclamation-circle"></i></span></h5>
                <h1>
                  <p class="mb-0 text-white"><?php echo $actualizacion['titulo']; ?></p>
                </h1>
                <p class="mb-0 text-white">
                  <?php echo substr($actualizacion['descripcion'], 0, 5500); ?>
                </p>
                <p class="text-white small-font"><?php echo $actualizacion['fecha']; ?></p>
              </div>
            </div>

            <!-- Publicación de Blog -->
            <div class="col-12 col-lg-4 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">Publicación de Blog <span class="float-right"><i class="fa fa-newspaper-o"></i></span></h5>
                <h1>
                  <p class="mb-0 text-white"><?php echo $blog['titulo']; ?></p>
                </h1>
                <p class="mb-0 text-white">
                  <?php echo substr($blog['descripcion'], 0, 5500); ?>
                </p>
                <p class="text-white small-font"><?php echo $blog['fecha']; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CANALES DE INSTAGRAM Y DE WHATSAPP -->
      <div class="card mt-3">
        <div class="card-body">
          <div class="row text-center">
            <div class="col-12 col-lg-4 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">Canal de WhatsApp <span class="float-right"></span></h5>
                <p class="text-white small-font">Contáctanos por WhatsApp para publicaciones o noticias</p>
                <p class="mb-0 text-white">¿Qué esperas para entrar?</p>
                <a href="https://whatsapp.com/channel/0029Vajlw9FDTkK9NgHlz81t" class="btn btn-success mt-3">Entrar al canal</a>
              </div>
            </div>
            <div class="col-12 col-lg-4 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">Canal de Instagram <span class="float-right"></span></h5>
                <p class="text-white small-font">Síguenos en Instagram para actualizaciones</p>
                <p class="mb-0 text-white">Explora nuestras últimas publicaciones y novedades.</p>
                <a href="https://www.instagram.com/twitchagency_hbb?igsh=emdjdW9rcDJwajZ3" class="btn btn-info mt-3">Visitar Instagram</a>
              </div>
            </div>
            <div class="col-12 col-lg-4 mb-3">
              <div class="border-dark p-3 bg-dark">
                <h5 class="text-white mb-0">Canal de Twitter <span class="float-right"></span></h5>
                <p class="text-white small-font">Mantente al día con nuestras últimas noticias en Twitter.</p>
                <p class="mb-0 text-white">Síguenos para actualizaciones en tiempo real.</p>
                <a href="https://twitter.com" class="btn btn-primary mt-3">Visitar Twitter</a>
              </div>
            </div>
          </div>
        </div>
      </div>


      <!--HORARIOS-->
      <br>
      <div class="card text-white">
        <div class="card-body">
          <h3 class="text-white">Horario de paga en domingos</h3>
          <hr>
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
              <!-- Primer conjunto de banderas -->
              <div class="carousel-item active">
                <div class="row text-center">
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/Ar.png" class="img-fluid" alt="Bandera de Argentina" style="max-width: 80px; height: auto;">
                      <h5>Argentina</h5>
                      <h5>Hora: 6:00 PM</h5>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/Mex.png" class="img-fluid" alt="Bandera de México" style="max-width: 80px; height: auto;">
                      <h5>México</h5>
                      <h5>Hora: 3:00 PM</h5>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/ECUADOR.png" class="img-fluid" alt="Bandera de Ecuador" style="max-width: 80px; height: auto;">
                      <h5>Ecuador</h5>
                      <h5>Hora: 4:00 PM</h5>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Segundo conjunto de banderas -->
              <div class="carousel-item">
                <div class="row text-center">
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/Chile.png" class="img-fluid" alt="Bandera de Chile" style="max-width: 80px; height: auto;">
                      <h5>Chile</h5>
                      <h5>Hora: 6:00 PM</h5>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/Colombia.png" class="img-fluid" alt="Bandera de Colombia" style="max-width: 80px; height: auto;">
                      <h5>Colombia</h5>
                      <h5>Hora: 4:00 PM</h5>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/usa.jpg" class="img-fluid" alt="Bandera de Estados Unidos" style="max-width: 80px; height: auto;">
                      <h5>Estados Unidos</h5>
                      <h5>Hora: 5:00 PM</h5>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Tercer conjunto de banderas -->
              <div class="carousel-item">
                <div class="row text-center">
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/Bolivia.png" class="img-fluid" alt="Bandera de Bolivia" style="max-width: 80px; height: auto;">
                      <h5>Bolivia</h5>
                      <h5>Hora: 5:00 PM</h5>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/España.jfif" class="img-fluid" alt="Bandera de España" style="max-width: 80px; height: auto;">
                      <h5>España</h5>
                      <h5>Hora: 11:00 PM</h5>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="flag-container">
                      <img src="../private/assets/images/banderas/Peru.jfif" class="img-fluid" alt="Bandera de Perú" style="max-width: 80px; height: auto;">
                      <h5>Perú</h5>
                      <h5>Hora: 4:00 PM</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <br>
      <div class="row">
        <div class="col-12 col-lg-8 col-xl-8 ">
          <div class="card text-white h-100 card "> <!-- Añadido h-100 -->
            <div class="card-header">Visitas</div>
            <div class="card-body">
              <div class="chart-container-1" style="background-color: white;">
                <canvas id="chart1" style="height: 300px;"></canvas> <!-- Altura del gráfico -->
              </div>
            </div>

            <!-- Aplicando mb-1 a la fila -->
            <div class="row m-0 row-group text-center border-top border-light mb-1">
              <div class="col-12 col-lg-4">
                <div class="p-3">
                  <h5 class="mb-0">45.87M</h5>
                  <small class="mb-0">Overall Visitor <span><i class="fa fa-arrow-up"></i> 2.43%</span></small>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="p-3">
                  <h5 class="mb-0">15:48</h5>
                  <small class="mb-0">Visitor Duration <span><i class="fa fa-arrow-up"></i> 12.65%</span></small>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="p-3">
                  <h5 class="mb-0">245.65</h5>
                  <small class="mb-0">Pages/Visit <span><i class="fa fa-arrow-up"></i> 5.62%</span></small>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Incluye Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
          const ctx = document.getElementById('chart1').getContext('2d');
          const chart1 = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico
            data: {
              labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'], // Etiquetas del eje X
              datasets: [{
                label: 'Visitas Mensuales',
                data: [22, 40, 100, 12, 34, 92], // Datos del gráfico
                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color de fondo (rojo claro)
                borderColor: 'rgba(255, 99, 132, 1)', // Color de borde (rojo más intenso)
                borderWidth: 2
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        </script>

        <br>

        <br>
        <?php
include('../private/procesos/db.php');

$sql = "
SELECT 
    u.id AS id_usuario,
    u.usuario_registro AS nombre_usuario,
    r.rango AS rango_asignado,  -- Obtener el nombre del rango
    COALESCE(a.total_ascensos, 0) AS total_ascensos,
    COALESCE(t.total_tiempos, 0) AS total_tiempos,
    COALESCE(a.total_ascensos, 0) + COALESCE(t.total_tiempos, 0) AS total_logros
FROM 
    registro_usuario u
LEFT JOIN (
    SELECT id_usuario_encargado, COUNT(*) AS total_ascensos 
    FROM ascensos 
    GROUP BY id_usuario_encargado
) a ON u.id = a.id_usuario_encargado
LEFT JOIN (
    SELECT id_usuario_encargado, COUNT(*) AS total_tiempos 
    FROM tiempos_de_paga 
    GROUP BY id_usuario_encargado
) t ON u.id = t.id_usuario_encargado
LEFT JOIN rangos r ON u.Rango_asignado = r.id_rango  -- Hacer JOIN con la tabla rangos
ORDER BY total_logros DESC
LIMIT 3;
";

$result = $conn->query($sql);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>


        <div class="col-12 col-lg-4 col-xl-4">
          <div class="card card text-white h-100">
            <div class="card-header">Top de trabajadores del mes</div>
            <div class="card-body">
              <div class="row mb-1">
                <?php
                $trofeos = ['text-warning', 'text-secondary', 'text-warning'];
                foreach ($usuarios as $index => $usuario): ?>
                  <!-- Lugar dinámico (1º, 2º, 3º) -->
                  <div class="col-4 text-center text-white">
                    <i class="fa fa-trophy fa-3x <?= $trofeos[$index]; ?>"></i>
                    <p class="mt-2"><?= ($index + 1) ?>º Lugar</p>
                    <p><?= htmlspecialchars($usuario['nombre_usuario']); ?></p>
                    <img src="https://www.habbo.es/habbo-imaging/avatarimage?user=<?= urlencode($usuario['nombre_usuario']); ?>&direction=3&head_direction=3&gesture=sml&action=&size=l"
                      alt="Imagen de perfil <?= ($index + 1) ?>º lugar"
                      class="rounded-circle mt-2"
                      style="width: 100px; height: 140px;">
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center text-white">
                <thead>
                  <tr>
                    <th>Rango</th>
                    <th>Usuario</th>
                    <th>Ascensos</th>
                    <th>Tiempos</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                      <td><?= htmlspecialchars($usuario['rango_asignado']); ?></td>
                      <td><?= htmlspecialchars($usuario['nombre_usuario']); ?></td>
                      <td><?= $usuario['total_ascensos']; ?></td>
                      <td><?= $usuario['total_tiempos']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <br>
        <style>
          .card-body p,
          .table th,
          .table td {
            color: #000000;
            text-shadow: 0 0 3px #00ff99, 0 0 5px #00ff99;
          }
        </style>

      </div><!--End Row-->