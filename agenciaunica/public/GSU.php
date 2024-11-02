
<style>
  .bg-theme {
    background-image: url('/agenciaunica/private/eventos/halloween/img/fondo.jpeg');
    /* Cambia esto */
    justify-content: center;
    align-items: center;
  }
</style>

<body class="bg-theme">
    

<section>
    <br>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tabla de Usuarios</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>RANGO</th>
                            <th>PREVILEGIOS</th>
                            <th>ASCENSOS</th>
                            <th>TIMES TOMADOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>goblinslayer</td>
                            <td>Supervisor</td>
                            <td>imagenes</td>
                            <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#ascensosModal">9</button></td>
                            <td><button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#timesModal">11</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NOMBRE</th>
                            <th>RANGO</th>
                            <th>PREVILEGIOS</th>
                            <th>ASCENSOS</th>
                            <th>TIMES TOMADOS</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para ASCENSOS -->
    <div class="modal fade" id="ascensosModal" tabindex="-1" aria-labelledby="ascensosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ascensosModalLabel">Detalles de Ascensos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Persona</th>
                                <th>M.A</th>
                                <th>M.N</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-01-15</td>
                                <td>Goblinslayer88</td>
                                <td>TWT- Agente C -XDD #2</td>
                                <td>TWT- Agente B -XDD #3</td>
                            </tr>
                            <tr>
                                <td>2023-01-15</td>
                                <td>-Miel</td>
                                <td>TWT- Agente C -XDD #2</td>
                                <td>TWT- Agente B -XDD #3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para TIMES TOMADOS -->
    <div class="modal fade" id="timesModal" tabindex="-1" aria-labelledby="timesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timesModalLabel">Detalles de Times Tomados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Persona</th>
                                <th>Rango</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2023-09-01</td>
                                <td>Goblinslayer</td>
                                <td>Supervisor</td>
                            </tr>
                            <tr>
                                <td>2023-09-15</td>
                                <td>-miel</td>
                                <td>Manager</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</section>
</body>