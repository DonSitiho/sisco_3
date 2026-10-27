<?php
include_once('../../plantillas/Direcciones/header.php');
include_once('../../conexion/conexion.php');
$consulta_user = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'");
$rows_user = mysqli_fetch_assoc($consulta_user);
$nombre_user = $rows_user['nombre_usr'];
$app = $rows_user['app'];
$apm = $rows_user['apm'];
$nick_name = $rows_user['nick_name'];


$errores = $_SESSION['errores'] ?? [];
$datos   = $_SESSION['datos']   ?? [];
$exito   = $_SESSION['exito']   ?? '';
// LIMPIAR SESSION
unset($_SESSION['errores'], $_SESSION['datos'], $_SESSION['exito']);


?>
<style>
    body {
        body background="'../../imgages/admin.png'">background-image: image('../../imgages/admin.png') !important;
    }
</style>


<!-- aqui va el menu -->
<?php include_once('../../plantillas/Direcciones/menu.php') ?>

<!-- ******************************************      hasta aqui llega el header *************************-->
<br>
<section class="client no-padding-top">
    <div class="conteiner-fluid" style="background-image:url(../../images/fondoPerfil.gif) !important; height: 100% !important; background-size: cover;
   height: 100%;
   width: 100% ;
   text-align: center; position: absolute;  top: 40px; opacity: 0.9; "> </div>
    <div class="container-fluid" style="position: absolute; left: 0.5%; top: 13%;">
        <div class="row">
            <!-- Work Amount  -->
            <div class="col-lg-8">
                <div class="work-amount card" style="border-radius: 25px !important">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                    href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3>Datos del Usuario</h3><small></small>
                        <?php if ($exito !== ''): ?>
                            <p class="exito"><?= htmlspecialchars($exito) ?></p>
                        <?php endif; ?>

                        <?php if (isset($errores['general'])): ?>
                            <p style="color: red;"><?= htmlspecialchars($errores['general']) ?></p>
                        <?php endif; ?>
                        <br>
                        <form action="../../ajax/Direcciones/perfil_usr.php" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group-material">
                                        <input type="text" name="id_user" value="<?php echo ($id_usuario); ?>" hidden="">
                                        <input id="nombre_usr" type="text" name="nombre_usr"
                                            class="input-material" value="<?= htmlspecialchars($datos['nombre_usr'] ?? $rows_user['nombre_usr']) ?>">
                                        <label for="nombre_usr" class="label-material">Nombre</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-material">
                                        <input id="app_usr" type="text" name="app_usr" class="input-material"
                                            value="<?= htmlspecialchars($datos['app'] ?? $rows_user['app']) ?>">
                                        <label for="app_usr" class="label-material">Apellido Paterno</label>
                                        <?php if (isset($errores['nombre_usr'])): ?>
                                            <span class="error"><?= $errores['nombre_usr'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group-material">
                                        <input id="apm_usr" type="text" name="apm_usr" class="input-material"
                                            value="<?= htmlspecialchars($datos['apm'] ?? $rows_user['apm']) ?>">
                                        <label for="apm_usr" class="label-material">Apellido Materno</label>
                                        <?php if (isset($errores['app_usr'])): ?>
                                            <span class="error"><?= $errores['app_usr'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-material">
                                        <input id="usuario" type="text" name="usuario" required class="input-material" disabled
                                            value="<?php echo ($nick_name); ?>">
                                        <label for="usuario" class="label-material">Usuario</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-material">
                                        <input id="contraseña_usr" type="password" name="contraseña_usr"
                                            class="input-material" value="">
                                        <label for="contraseña_usr" class="label-material">Contraseña</label>
                                        <?php if (isset($errores['contraseña_usr'])): ?>
                                            <span class="error"><?= $errores['contraseña_usr'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                            </div>
                            <center><button class="btn btn-sm btn-primary"
                                    style="border-radius: 20px !important;">Actualizar Datos</button></center>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Client Profile -->
            <div class="col-lg-4">
                <div class="client card" style="border-radius: 25px !important">
                    <div class="card-close">
                        <div class="dropdown">
                            <button type="button" id="closeCard2" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                            <div aria-labelledby="closeCard2" class="dropdown-menu dropdown-menu-right has-shadow"><a
                                    href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Cerrar</a></div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="client-avatar"><img src="<?php echo ($imagen); ?>" alt="..."
                                class="img-fluid rounded-circle" style=" width: 93% !important;
    height: 93% !important;
    border-radius: 900px !important;
    overflow: hidden !important;
    margin-left: 20px !important;">
                            <div class="status bg-green"></div>
                        </div>
                        <div class="client-title">
                            <h3><?php echo ($nombre_user . ' ' . $app); ?></h3><span>Administrador</span><a
                                data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                                aria-controls="collapseExample">Cambiar imagen</a>
                        </div>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <form method="post" action="../../php/Cambiar_imagen.php" enctype="multipart/form-data">
                                    <div class="form-group">


                                        <input type="file" class="form-control font-weight-bold" name="imagen"
                                            id="doc_resp" required accept="image/*">
                                    </div>

                                    <input type="submit" class="btn btn-primary" style="border-radius: 25px !important"
                                        value="Cambiar">
                                </form>
                            </div>
                        </div>
                        <!-- <div class="client-info">
                        <div class="row">
                          <div class="col-4"><strong>20</strong><br><small>Photos</small></div>
                          <div class="col-4"><strong>54</strong><br><small>Videos</small></div>
                          <div class="col-4"><strong>235</strong><br><small>Tasks</small></div>
                        </div>
                      </div>-->
                        <!-- <div class="client-social d-flex justify-content-between"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a><a href="#" target="_blank"><i class="fa fa-twitter"></i></a><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a><a href="#" target="_blank"><i class="fa fa-instagram"></i></a><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></div>-->
                    </div>
                </div>
            </div>
            <!-- Total Overdue             -->

        </div>
    </div>
</section>

<?php include_once('../../plantillas/Direcciones/foother.php'); ?>