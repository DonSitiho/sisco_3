<div id="editUsuarioModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="editarUsuario" id="editarUsuario">
                <div class="modal-header">
                    <h4 class="modal-title">Editar datos del usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" class="form-control " readonly name="id" id="id" required>
                        <div class="form-group col-md-4">
                            <label class="label-material" for="nombres_edit">Nombre(s)</label>
                            <input type="text" class="form-control" name="nombres_edit" id="nombres_edit">
                            <span id="error-nombres_edit"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="label-material" for="app_edit">Apellido Paterno</label>
                            <input type="text" class="form-control" name="app_edit" id="app_edit">
                            <span id="error-app_edit"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label-material" for="apm_edit">Apellido Materno</label>
                            <input type="text" class="form-control" name="apm_edit" id="apm_edit">
                            <span id="error-apm_edit"></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="label-material" for="nick_name_edit">Usuario </label>
                            <input type="text" class="form-control" name="nick_name_edit" id="nick_name_edit">
                            <span id="error-nick_name_edit"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label-material" for="password_edit">Contraseña</label>
                            <input type="password" class="form-control" name="password_edit" id="password_edit">
                            <span id="error-password_edit"></span>
                        </div>
                    </div>

                    <?php
                    // Condicion para agregar un nuevo usuario con direccion, subdireccion y departamento.
                    if ($id_direccion == 8888 && $subdireccion == 0) {
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="direccion1_edit">Direcciónes </label>
                                    <select class="form-control" id="direccion1_edit" name="direccion1_edit">
                                        <?php
                                        // Obtener todas las direcciones de secoem. 
                                        $direcciones = mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                                        if ($direcciones->num_rows != 0) {
                                            echo ('<option value="">Selecciona una subdirección</option>');
                                            while ($row = mysqli_fetch_assoc($direcciones)) {
                                                echo ('<option value="' . $row['id_direccion'] . '">' . $row['nombre_direccion'] . ' - ' . $row['siglas'] . '</option>');
                                            }
                                        } else {
                                            echo ('<option value="">No hay direcciónes disponibles</option>');
                                        }
                                        ?>
                                    </select>
                                    <span id="error-direccion1_edit"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="" for="subdireccion1_edit">Subdirecciónes / OIC</label>
                                <select name="subdireccion1_edit" id="subdireccion1_edit" class="form-control">
                                    <option selected>Primero selecciona una dirección</option>

                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="" for="departamento1_edit">Departamentos</label>
                                <select id="departamento1_edit" name="departamento1_edit" class="form-control">
                                    <option selected>Primero selecciona una subdirección</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="" for="roles_edit">Roles</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="roles_edit" id="admin" value="2">
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="roles_edit" id="capturista" value="1">
                                    <label class="form-check-label" for="capturista">Capturista</label>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-warning" value="Editar">
                </div>
            </form>
        </div>
    </div>
</div>