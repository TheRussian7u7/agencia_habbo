<?php
session_start();

require_once('private/procesos/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = isset($_POST['login_usuario']) ? htmlspecialchars($_POST['login_usuario']) : '';
    $password = isset($_POST['login_password']) ? htmlspecialchars($_POST['login_password']) : '';

    // Verificar si los datos están completos
    if (!empty($usuario) && !empty($password)) {
        // Preparar y ejecutar la consulta
        $sql = "SELECT id, password_registro, rol_id FROM registro_usuario WHERE usuario_registro = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password_registro, $rol_id);
            $stmt->fetch();

            // Verificar la contraseña
            if (password_verify($password, $password_registro)) {
                // Credenciales válidas, iniciar sesión
                $_SESSION['id_usuario'] = $id; // Almacenar el ID del usuario en la sesión
                $_SESSION['usuario_registro'] = $usuario;
                $_SESSION['rol_id'] = $rol_id;

                // Redirigir al usuario a la página principal
                header("Location: /agenciaunica/public/index.php");
                exit();
            } else {
                // Contraseña incorrecta
                echo "<script>
                        alert('Contraseña incorrecta.');
                        window.location.href = '/agenciaunica/login.php';
                      </script>";
            }
        } else {
            // Usuario no encontrado
            echo "<script>
                    alert('Usuario no encontrado.');
                    window.location.href = '/agenciaunica/login.php';
                  </script>";
        }

        $stmt->close();
    } else {
        // Campos no completados
        echo "<script>
                alert('Por favor, complete todos los campos.');
                window.location.href = '/agenciaunica/login.php';
              </script>";
    }
}

$conn->close();
?>

<?php require_once('private/plantillas/headerlogin.php'); ?>

<body>

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

    <div class="scroll-top position-fixed">
        <a class="btn btn-outline-primary btn-floating d-flex align-items-center justify-content-center" href="index.php" style="width: 100px; height: 50px;">
            <!-- Texto para pantallas grandes -->
            <span class="d-none d-md-inline">Regresar</span>
            <!-- Ícono para pantallas pequeñas -->
            <i class="d-md-none">Regresar</i>
        </a>
    </div>
    <!-- Wrapper for centering the card -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card card-authentication1 mx-auto my-5" style="max-width: 400px;">
            <div class="card-body">
                <div class="text-center">
                    <img src="private/assets/images/logo-icon.png" alt="logo icon" class="img-fluid" style="max-width: 200px;">
                </div>
                <div class="card-title text-uppercase text-center py-3">Iniciar sesión</div>
                <form id="loginForm" method="POST">
                    <div class="form-group">
                        <label for="exampleInputUsername">Nombre de Habbo:</label>
                        <input type="text" id="exampleInputUsername" name="login_usuario" class="form-control" placeholder="Nombre habbo">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleInputPassword">Contraseña:</label>
                        <input type="password" id="exampleInputPassword" name="login_password" class="form-control" placeholder="Contraseña">
                    </div>
                    <br>
                    <div class="form-check">
                        <input type="checkbox" id="user-checkbox" name="remember_me" class="form-check-input" <?php echo isset($_COOKIE['login_usuario']) ? 'checked' : ''; ?> />
                        <label class="form-check-label" for="user-checkbox">Recordar contraseña</label>
                    </div>
                    <br>
                    <div class="text-center">
                    <button type="submit" class="btn btn-light btn-block waves-effect waves-light">Iniciar sesión</button>
                    </div>
                    
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">No tienes cuenta? <a href="register.php">Registrate gratis</a></p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php require_once('private/plantillas/footer.php'); ?>
</body>