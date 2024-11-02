<?php
session_start();

require_once('private/procesos/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Sanitizar y validar usuario
	$usuario = isset($_POST['registro_usuario']) ? htmlspecialchars(trim($_POST['registro_usuario'])) : '';

	// Validar contraseña (en este caso, solo asegurarse de que no esté vacía)
	$password = isset($_POST['registro_password']) ? trim($_POST['registro_password']) : '';

	// Obtener la IP del usuario actual
	$ip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

	// Verificar si los datos están completos y válidos
	if (!empty($usuario) && !empty($password)) {
		// Verificar si el usuario ya existe
		$sql = "SELECT id FROM registro_usuario WHERE usuario_registro = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0) {
			// Usuario ya existe
			echo "<script>
                    alert('El usuario ya existe.');
                    window.location.href = '/agenciaunica/register.php';
                  </script>";
		} else {
			// Verificar cantidad de registros desde la misma IP
			$sql_ip = "SELECT COUNT(*) AS total_registros FROM registro_usuario WHERE ip_registro = ?";
			$stmt_ip = $conn->prepare($sql_ip);
			$stmt_ip->bind_param("s", $ip_usuario);
			$stmt_ip->execute();
			$stmt_ip->store_result();

			$stmt_ip->bind_result($total_registros);
			$stmt_ip->fetch();

			if ($total_registros >= 1) {
				echo "<script>
                        alert('Se han registrado más de 2 veces desde esta IP. Por favor, contacte al soporte.');
                        window.location.href = '/agenciaunica/register.php';
                      </script>";
				exit;
			}

			// Usuario no existe y no hay más de 2 registros desde la misma IP, proceder con el registro
			$password_hashed = password_hash($password, PASSWORD_DEFAULT);
			$rol_id = 1; // Asignar rol inicial
            $rango_asignado = 1; // Valor por defecto para el rango
			$fecha_registro = date('Y-m-d H:i:s'); // Obtener la fecha actual

			// Insertar registro de usuario con IP
			$sql_insert = "INSERT INTO registro_usuario (usuario_registro, password_registro, rol_id, fecha_registro, ip_registro, Rango_asignado) VALUES (?,?, ?, ?, ?, ?)";
			$stmt_insert = $conn->prepare($sql_insert);
			$stmt_insert->bind_param("ssisss", $usuario, $password_hashed, $rol_id, $fecha_registro, $ip_usuario, $rango_asignado);

			if ($stmt_insert->execute()) {
				echo "<script>
                        alert('Registro exitoso. Ahora puedes iniciar sesión.');
                        window.location.href = '/agenciaunica/login.php';
                      </script>";
			} else {
				echo "<script>
                        alert('Error en el registro. Por favor, inténtelo nuevamente.');
                        window.location.href = '/agenciaunica/registro.php';
                      </script>";
			}
		}

		$stmt->close();
		$stmt_ip->close();
	} else {
		// Campos no completados o inválidos
		echo "<script>
                alert('Por favor, complete todos los campos correctamente.');
                window.location.href = '/agenciaunica/registro.php';
              </script>";
	}
}

$conn->close();
?>



<?php require_once('private/plantillas/headerlogin.php'); ?>

<body class="bg-theme bg-theme1 d-flex flex-column min-vh-100">

    <!-- Botón de regresar -->
    <div class="scroll-top position-fixed">
    <a class="btn btn-outline-primary btn-floating d-flex align-items-center justify-content-center" href="index.php" style="width: 100px; height: 50px;">
            <!-- Texto para pantallas grandes -->
            <span class="d-none d-md-inline">Regresar</span>
            <!-- Ícono para pantallas pequeñas -->
            <i class="d-md-none">Regresar</i>
        </a>
    </div>

    <style>
        .scroll-top {
            position: fixed;
            top: 20px;
            /* Cambia 'bottom' a 'top' */
            right: 20px;
            z-index: 1000;
        }

        .scroll-top a {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .scroll-top {
                top: 15px;
                /* Cambia 'bottom' a 'top' */
                right: 15px;
            }


            .scroll-top a {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
        }

        @media (min-width: 576px) and (max-width: 768px) {
            .scroll-top {
                bottom: 20px;
                right: 20px;
            }

            .scroll-top a {
                width: 80px;
                height: 45px;
                font-size: 22px;
            }
        }
    </style>

    <!-- Contenido de la página -->
    <div class="container d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="text-center">
                        <img src="private/assets/images/logo-icon.png" alt="logo icon" width="200" height="200">
                    </div>
                    <div class="card-title text-uppercase text-center py-3">Registrar usuario</div>
                    <form action="" method="POST">
                        <div class="form-group">
                            <span>Ingresar nombre de habbo:</span>
                            <label for="exampleInputName" class="sr-only">Name</label>
                            <div class="position-relative has-icon-right">
                                <input type="text" id="exampleInputName" name="registro_usuario" class="form-control input-shadow" placeholder="Ingresa tu habbo:">

                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <span>Ingresar nueva contraseña:</span>
                            <label for="exampleInputPassword" class="sr-only">Password</label>
                            <div class="position-relative has-icon-right">
                                <input type="password" id="exampleInputPassword" name="registro_password" class="form-control input-shadow" placeholder="Nueva contraseña:">
                            </div>
                        </div>
<br>
                        <div class="form-group">
                            <div class="icheck-material-white">
                                <input class="form-check-input" type="checkbox" id="user-checkbox" name="remember_me" />
                                <label class="form-check-label" for="user-checkbox">Acepto los </label>
                                <span data-bs-toggle="modal" data-bs-target="#termsModal" style="cursor:pointer; color:blue; text-decoration:underline;">Términos y Condiciones</span>
                                <?php require_once('private/modal/terminos_condiciones.php'); ?>
                            </div>
                        </div>
                        <br>

                        <div class="text-center">

                        <button type="submit" class="btn btn-light btn-block waves-effect waves-light">Registrar</button>

                        </div>

                        <div class="card-footer text-center py-3">
                            <p class="text-warning mb-0">¿Tienes cuenta? <a href="login.php"> Inicia sesión</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('private/plantillas/footer.php'); ?>
</body>