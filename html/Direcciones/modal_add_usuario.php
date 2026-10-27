<div id="addUsuarioModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="add_usuario" id="add_usuario" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar nuevo usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-4" >
                            <label class="label-material" for="nombres">Nombre(s)</label>
                            <input type="text" class="form-control" name="nombres" id="nombres">
                            <span id="error-nombres"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="label-material" for="app">Apellido Paterno</label>
                            <input type="text" class="form-control" name="app" id="app">
                            <span id="error-app"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label-material" for="apm">Apellido Materno</label>
                            <input type="text" class="form-control" name="apm" id="apm">
                            <span id="error-apm"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-material" for="nick_name">Usuario </label>
                            <input type="text" class="form-control" name="nick_name" id="nick_name">
                            <span id="error-nick_name"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label-material" for="password">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <span id="error-password"></span>
                        </div>
                    </div>

                    <?php
                    // Condicion para agregar un nuevo usuario con direccion, subdireccion y departamento.
                    if ($id_direccion == 8888 && $subdireccion == 0) {
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="direccion1">Direcciónes </label>
                                    <select class="form-control" id="direccion1" name="direccion1">
                                        
                                        <?php
                                        // Obtener todas las direcciones de secoem. 
                                        $direcciones = mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                                        if ($direcciones->num_rows != 0) {
                                            echo ('<option value="">Selecciona una dirección </option>');
                                            while ($row = mysqli_fetch_assoc($direcciones)) {
                                                echo ('<option value="' . $row['id_direccion'] . '">' . $row['nombre_direccion'] . ' - ' . $row['siglas'] . '</option>');
                                            }
                                        } else {
                                            echo ('<option value="">No hay direcciónes disponibles</option>');
                                        }
                                        ?>
                                    </select>
                                    <span id="error-direccion1"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="" for="subdireccion1">Subdirecciónes / OIC</label>
                                <select name="subdireccion1" id="subdireccion1" class="form-control">
                                    <option selected>Primero selecciona una dirección</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="" for="departamento1">Departamentos</label>
                                <select id="departamento1" name="departamento1" class="form-control">
                                    <option selected>Primero selecciona una subdirección</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="" for="roles">Roles</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="roles" id="admin" value="2">
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="roles" id="capturista" value="1">
                                    <label class="form-check-label" for="capturista">Capturista</label>
                                </div>
                                <span id="error-roles"></span>
                            </div>
                        </div>
                    <?php
                    } elseif ($subdireccion != 0) { //si es diferente a cero es un departamento
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="departamento">Departamento</label>
                                    <select class="form-control" id="departamento" name="departamento">
                                        <?php
                                        //Departamentos 
                                        $departamento = mysqli_query($conexion, "SELECT * FROM departamentos WHERE id_sub_oic='" . $subdireccion . "'");
                                        if ($departamento->num_rows != 0) {
                                            echo ('<option value="">Selecciona un departamento</option>');
                                            while ($row = mysqli_fetch_assoc($departamento)) {

                                                echo ('<option value="' . $row['id'] . '">' . $row['nombre_depto'] . '</option>');
                                            }
                                        } else {
                                            echo ('<option value="">No hay departamentos disponibles</option>');
                                        }
                                        ?>
                                    </select>
                                    <span id="error-departamento"></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else { // si no es una Subdirección
                    ?>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="subdireccion">Subdirecciónes / OIC</label>
                                    <select class="form-control " id="subdireccion" name="subdireccion">

                                        <?php
                                        //Sub Direccion o Organos internos de control
                                        if ($id_direccion == 2) {
                                            $where = " ";
                                        } else {
                                            $where = "WHERE id_direccion1='" . $id_direccion . "'";
                                        }
                                        $direccion = mysqli_query($conexion, "SELECT * FROM subdirecciones_oic $where");
                                        if ($direccion->num_rows != 0) {
                                            echo ('<option value="">Selecciona una subdirección</option>');
                                            while ($row = mysqli_fetch_assoc($direccion)) {

                                                echo ('<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>');
                                            }
                                        } else {
                                            echo ('<option value="">No hay subdirecciónes disponibles</option>');
                                        }
                                        ?>
                                    </select>
                                    <span id="error-subdireccion"></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" id="btnguardar" value="Agregar">
                </div>
            </form>
        </div>
    </div>
</div>
