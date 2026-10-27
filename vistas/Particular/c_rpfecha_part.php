<?php include_once('../../plantillas/Particular/header.php');
include_once('../../ajax/conexion.php');
//consulta a oficios internos
$consuta_oficios = mysqli_query($conexion, "SELECT revisado
                                            FROM oficios_conocimiento ");
$total_oficios = 0;
$oficios_revizados = 0;
$oficioss_pendientes = 0;
while ($row_oficios = mysqli_fetch_assoc($consuta_oficios)) {
  $revisado = $row_oficios['revisado'];
  switch ($revisado) {
    case 0:
      $oficioss_pendientes++;
      break;
    case 1:
      $oficios_revizados++;
      break;
  }
  $total_oficios++;
}

?>



<ul class="list-unstyled">
    <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
    <li class=""><a href="perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
    <!-- Sidebar Navidation Menus--><span class="heading">Menú</span>
    <li class=""><a href="index.php"> <i class="icon-home"></i>Principal </a></li>
    <li><a href="corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>

    <li class=""><a href="corr_finalizado.php"> <i class="fa fa-address-card"></i>Finalizados </a></li>
    <li class=""><a href="../Direcciones/historial.php"> <i class="fa fa-mail"></i>Historial <b class="text-danger">
                (nuevo) </b></a></li>
    <li class=""><a href="estadisticas.php"> <i class="fa fa-area-chart"></i>Estadisticas </a></li>

    <!-- Sidebar Navidation Menus--><span class="heading">Oficios del titular</span>
    <li class=""><a href="oficios_titular.php"> <i class="fa fa-mail"></i>Oficios </a></li>
    <li class=""><a href="Ofi_internos.php"> <i class="fa fa-mail"></i>Oficios y/o Tarjetas de conocimiento <b
                class="text-danger"> (nuevo) </b></a></li>
    <!--   <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>-->

</ul><span class="heading">Extras</span>
<ul class="list-unstyled">
    <li class="active"> <a href="c_pfecha.php"> <i class="fa fa-id-badge"></i>Reporte por fecha </a></li>
    <!-- <li> <a href="c_prangofolios.php"> <i class="material-icons">date_range</i>Por folios </a></li> -->
</ul>
<ul class="list-unstyled">
    <li> <a href="../../ajax/General/Cerrar_sesion.php"> <i class="icon-close"></i>Cerrar Sesión </a></li>

</ul>
</nav>

<div class="content-inner">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom"><?php echo ($nom_direccion); ?></h2>
        </div>
    </header>
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
            <li class="breadcrumb-item active">Reporte: Correspondencia por Rango de Fechas</li>
            <li>
                <!-- collapse -->
            </li>
        </ul>
    </div>
    
        
            <!-- ********* hasta aqui llega el header  *******************-->
            <div class="container-fluid card">
                <div class="table-wrapper">
                    <form action="../../r_pfecha_part.php" method="POST" target="_blank">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Consulta por rango de fechas y área SECOEM<b></b></h2>
                                </div>
                                <div class="col-sm-4">
                                    <h2><b></b></h2>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal" style="border-radius: 25px !important;">
                                        Excel
                                    </button>



                                </div>
                                <div class="col-sm-1">
                                    <input type="image" src="../../images/printer6.png" alt="Enviar" width="40"
                                        height="">
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12 mx-auto'>
                            <div id="custom-search-input">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group-material">
                                            <label for="q4" class="" style="margin: 0px !important;">Selecciona el
                                                Remitente</label>
                                            <select class="form-control mb-3" id="q4" name="q4" required
                                                class="input-material" onkeyup="load(1);" style="border-radius: 25px !important;">
                                                <option value="0">Remitente...</option>
                                                <?php
                                                $remitenet=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS");
                                                while($dep=mysqli_fetch_assoc($remitenet)){
                                                $emisor=$dep['sigla'].'-'.($dep['nombre']);
                                                echo('<option value="'.$dep['id_dependencia'].'">'.$emisor.'</option>');
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group-material">
                                            <label for="q" class="" style="margin: 0px !important;">Fecha inicial
                                            </label>
                                            <input id="q" type="date" name="q" required class="input-material"
                                                onkeyup="load(1);" style="border-radius: 25px !important;" style="border-radius: 25px !important;">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group-material">
                                            <label for="q1" class="" style="margin: 0px !important;">Fecha final
                                            </label>
                                            <input id="q1" type="date" name="q1" required class="input-material"
                                                onkeyup="load(1);" style="border-radius: 25px !important;">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group-material">
                                            <label for="q2" class="" style="margin-buttom: 12px !important;">Selecciona:
                                            </label>
                                            <select class="form-control mb-3" id="q2" name="q2" required
                                                class="input-material" onkeyup="load(1);" style="border-radius: 25px !important;">
                                                <option value="0">Todas las áreas de SECOEM...</option>
                                                <?php                                
                                    $direccion=mysqli_query($conexion, "SELECT * FROM direcciones_secoem");
                                    while($row_direc=mysqli_fetch_assoc($direccion)){
                                        echo('<option value="'.$row_direc['id_direccion'].'">'.($row_direc['nombre_direccion']).'</option>');
                                    }
                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">

                                    </div>
                                    <div class="input-group col-2">
                                        <span class="input-group-btn text-right">
                                            <button class="form-control btn btn-info"
                                                style="margin-top : 12px !important; border-radius: 25px !important;"  type="button"
                                                onclick="load(1);">Generar consulta </button>
                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div class="row"></div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class='clearfix'></div>
            <hr>
            <div id="loader"></div><!-- Carga de datos ajax aqui -->
            <div id="resultados"></div><!-- Carga de datos ajax aqui -->
            <div class='outer_div card'></div><!-- Carga de datos ajax aqui -->


   
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label-info" id="exampleModalLabel">Seleccionar Campos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form action="">
                <!-- for para sacar calumnas de la tabla -->
                <?php 
                 $consultar = mysqli_query($conexion, "SHOW COLUMNS FROM datos_correspondencia WHERE field IN ('folio','f_recepcion','id_remitente','cargo','Nombre','num_oficio','f_oficio','id_destinatarios','cargo_destinatario','asunto_destinatario','asunto_particular','indicaciones_destinatario','anexo_destinatario','	leyenda_destinatario', 'obs_part', 'id_direcciones', 'f_turnado', 'instrucciones_direcciones')");
               
                 while($dep=mysqli_fetch_assoc($consultar)){
                  

                    echo '<div class="form-check">
                              <input type="checkbox" class="form-check-input" checked value ="'.$dep['Field'].'" id="'.$dep['Field'].'" name="operacion[]">
                              <label class="form-check-label" for="'.$dep['Field'].'">'.$dep['Field'].'</label>
                         </div>';

                
      
                 }
            ?>
            
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 25px !important;">Close</button>
                <button type="reset" class="btn btn-secondary" style="border-radius: 25px !important;">Restaurar</button>
                <a href="#" onclick="excel(1);">
                    <button type="button" class="btn btn-success" style="border-radius: 25px !important;">Generar Excel</button>
                </a>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- <?php include('../../plantillas/Particular/foother.php'); ?> -->
<?php include_once '../../plantillas/footer.php'; ?>
<?php include('../../html/Particular/modal_view_corresp_part.php'); ?>
<!-- <script src="../../js/Particular/controlador_Ofi_conocimiento.js"></script> -->
<script src="../../js/Particular/scriptcodatecorres.js"></script>
