<!-- Modal de búsqueda de código y ascenso -->
<style>
    .modal-md {
        max-width: 500px;
        /* Ajusta según tu necesidad */
    }
</style>

<div class="modal fade" id="modalAscenderPersona" tabindex="-1" aria-labelledby="modalAscensoLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAscensoLabel">Sistema de Ascensos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Sección de búsqueda -->
                <div id="busqueda-codigo">
                    <label for="codigo">Ingrese el código de 5 letras:</label>
                    <input type="text" id="codigo" maxlength="6" class="form-control" placeholder="Código de usuario">
                    <button class="btn btn-primary mt-2" id="buscarCodigo">Buscar</button>
                </div>

                <!-- Sección de datos encontrados -->
                <div id="datos-usuario" style="display: none;">
                    <h5>Información del último ascenso</h5>
                    <p><strong>Encargado del último ascenso:</strong> <span id="encargado"></span></p>
                    <p><strong>Firma del encargado:</strong> <span id="firmaEncargado"></span></p>
                    <h5>Información del Usuario</h5>
                    <p><strong>Rango actual:</strong> <span id="rangoActual"></span></p>
                    <p><strong>Firma del usuario:</strong> <span id="firmaUsuario"></span></p>
                    <p><strong>Misión actual:</strong> <span id="misionActual"></span></p>
                    <p><strong>Tiempo desde el último ascenso:</strong> <span id="tiempoUltimoAscenso"></span></p>

                    <button class="btn btn-secondary mt-3" id="regresarBusqueda">Regresar</button>
                    <button class="btn btn-primary mt-3" id="verificarTiempo">Siguiente</button>
                </div>

                <!-- Sección de ascenso -->
                <div id="seccion-ascenso" style="display: none;">
                    <h5>Registrar Ascenso</h5>
                    <form id="formAscenso">
                        <input type="hidden" name="id_codigo" id="idCodigo">
                        <input type="hidden" name="id_usuario_encargado" value="<?php echo $_SESSION['id_usuario']; ?>">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="firmaEncargadoInput">Firma del encargado:</label>
                                    <input type="text" id="firmaEncargadoInput" name="firma_encargado" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="firmaPersona">Firma de la persona:</label>
                                    <input type="text" id="firmaPersona" name="firma_persona" class="form-control">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="usuarioAscendido">Usuario Ascendido:</label>
                                    <input type="text" id="usuarioAscendido" name="usuario_ascendido" class="form-control">
                                </div>

                                <div class="col-md-5 mb-4">
                                    <label for="nuevoRango">Rango:</label>
                                    <select id="nuevoRango" name="rango" class="form-select">
                                        <option value="2">Seguridad</option>
                                        <option value="3">Tecnico</option>
                                    </select>
                                </div>

                                <div class="col-md-5 mb-4">
                                    <label for="misionNueva">Nueva Misión:</label>
                                    <input type="text" id="misionNueva" name="mision_nueva" class="form-control">
                                </div>
                            </div>
                        </div>


                        <button type="button" class="btn btn-secondary" id="regresarDatos">Regresar</button>
                        <button type="submit" class="btn btn-success">Registrar Ascenso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Buscar código
        $('#buscarCodigo').click(function() {
            const codigo = $('#codigo').val().trim();
            if (codigo.length === 6) {
                $.ajax({
                    url: '../private/procesos/ascender.php',
                    method: 'POST',
                    data: {
                        accion: 'buscar',
                        codigo: codigo
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#encargado').text(response.encargado);
                            $('#firmaEncargado').text(response.firma_encargado);
                            $('#rangoActual').text(response.rango);
                            $('#firmaUsuario').text(response.firma);
                            $('#misionActual').text(response.mision_actual);
                            $('#tiempoUltimoAscenso').text(response.tiempo_ultimo_ascenso);
                            $('#idCodigo').val(response.id_codigo);

                            $('#busqueda-codigo').hide();
                            $('#datos-usuario').show();
                        } else {
                            alert('Código no encontrado.');
                        }
                    }
                });
            } else {
                alert('El código debe tener 5 caracteres.');
            }
        });

        // Verificar tiempo antes de ascender
        $('#verificarTiempo').click(function() {
            const tiempo = $('#tiempoUltimoAscenso').text();
            if (tiempo === '00:00:00') {
                $('#datos-usuario').hide();
                $('#seccion-ascenso').show();
            } else {
                alert('No se puede ascender. Debe esperar un tiempo mínimo.');
            }
        });

        // Función para regresar a la sección de búsqueda
        $('#regresarBusqueda').click(function() {
            $('#datos-usuario').hide();
            $('#busqueda-codigo').show();
        });

        // Función para regresar a los datos encontrados desde la sección de ascenso
        $('#regresarDatos').click(function() {
            $('#seccion-ascenso').hide();
            $('#datos-usuario').show();
        });

        // Registrar ascenso
        $('#formAscenso').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '../private/procesos/ascender.php',
                method: 'POST',
                data: $(this).serialize() + '&accion=ascender',
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });
    });
</script>