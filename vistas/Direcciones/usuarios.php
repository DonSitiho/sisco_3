<?php include_once('../../plantillas/Direcciones/header.php') ?>
<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>


<?php
if (($id_direccion == 8888 && $nivelAcceso == 2 && $subdireccion == 0 && $depto == 0 && $activo == 1) || ($id_direccion != 8888 && $nivelAcceso == 2 && ($subdireccion == 0 || $depto == 0) && $activo == 1)) {
?>

    <div class="container-fluid mt-4">
        <!-- CARD PRINCIPAL -->
        <div class="card shadow-sm border-0 rounded-4">

            <!-- HEADER -->
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold text-primary mb-1">
                            <i class="bi bi-people-fill"></i>
                            Usuarios SECOEM
                        </h3>

                        <small class="text-muted">
                            Administración de usuarios del sistema
                        </small>
                    </div>

                    <!-- BOTON -->
                    <button type="button"
                        class="btn btn-success rounded-pill px-4 shadow-sm"
                        data-toggle="modal"
                        data-target="#addUsuarioModal">

                        <i class="bi bi-person-plus-fill"></i>
                        Agregar Usuario
                    </button>
                </div>
            </div>
        </div>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 p-4">
                <!-- TABLA -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="tablaUsuarios" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Usuario</th>
                                    <th>Dirección</th>
                                    <th>Subdirección</th>
                                    <th>Departamento</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "No tienes los permisos necesarios para ingresar a esta ventana";
}
?>

<!-- Page Footer-->
<?php
include_once('../../plantillas/Direcciones/foother.php');
include("../../html/Direcciones/modal_add_usuario.php");
include("../../html/Direcciones/modal_edit_usuario.php");
?>
<script src="../../js/Direcciones/controlador_alta_usuarios.js"></script>

