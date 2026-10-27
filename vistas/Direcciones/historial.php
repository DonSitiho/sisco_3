<?php include_once('../../plantillas/Direcciones/header.php') ?>

<?php
	
	$id_direccion=$_SESSION['id_direccion'];
	
	$nivel_acceso=$_SESSION['nivel_acceso'];
	if($id_direccion==2 && $nivel_acceso==2){
		echo('  <ul class="list-unstyled">
            <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
            <li class=""><a href="../Particular/perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
            <!-- Sidebar Navidation Menus--><span class="heading">Menú-Correspondencia</span>
            <li class=""><a href="../Particular/index.php"> <i class="icon-home"></i>Principal </a></li>
                <li><a href="../Particular/corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>
               <li class=""><a href="../Particular/corr_finalizado.php"> <i class="fa fa-address-card"></i>Finalizados </a></li>
               <li class="active"><a href="../Direcciones/historial.php"> <i class="fa fa-mail"></i>Historial <b class="text-danger"> (nuevo) </b></a></li>
            <li class=""><a href="../Particular/estadisticas.php"> <i class="fa fa-area-chart"></i>Estadisticas </a></li>
              <!-- Sidebar Navidation Menus--><span class="heading">Oficios del titular</span>
              <li class=""><a href="../Particular/oficios_titular.php"> <i class="fa fa-mail"></i>Oficios </a></li>
              
              <li class="" ><a href="../Particular/Ofi_internos.php"> <i class="fa fa-id-badge"></i>Oficios y/o Tarjetas de conocimiento </a></li>
         
       
        
          </ul>
          <span class="heading">Extras</span>
          <ul class="list-unstyled">
            <li> <a href="../../ajax/General/Cerrar_sesion.php"> <i class="icon-close"></i>Cerrar Sesión </a></li>
            
          </ul>');
	}else{
			echo('<ul class="list-unstyled">
           
            <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
            <li class=""><a href="perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
             
            <!-- Sidebar Navidation Menus--><span class="heading">Menú</span>
            <li class=""><a href="index.php"> <i class="ico-email"></i>Principal </a></li>');
          
	$id_direccion=$_SESSION['id_direccion'];
	
	$nivel_acceso=$_SESSION['nivel_acceso'];
		
	if($id_direccion==2 && $nivel_acceso==1){
		echo('  <li class=""><a href="historial.php"> <i class="icon-user"></i>Historial </a></li>');
	}
		echo(' <li class=""><a href="corr_seguimiento.php"> <i class="icon-ios-email"></i>Correspondencia Seguimiento </a></li>
                <li class=""><a href="corr_finalizada.php"> <i class="icon-website"></i>Correspondencia finalizada </a></li>
                  <li class=""><a href="ofi_internos.php"> <i class="icon-padnote"></i>Oficios y/o Tarjetas de conocimiento <b class="text-danger"> (nuevo) </b></a></li>
                <li class=""><a href="corr_consulta.php">
                <i class="icon-list-1"></i>Reporte / consulta</a></li>
               <!-- <li><a href="corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>
           
            <li><a href="#" class="disabled"> <i class="fa fa-bar-chart disabled"></i>Estadisticas</a></li>-->
         
         <!--   <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>-->
        
          </ul>
          <span class="heading">Extras</span>
          <ul class="list-unstyled">
            <li> <a href="../../ajax/General/Cerrar_sesion.php"> <i class="icon-close"></i>Cerrar Sesión </a></li>
            
          </ul>');	 
	}
	
	?>

</nav>

<div class="content-inner">
    <!-- Page Header-->
    <center>
        <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom"><?php echo($nom_direccion); ?></h2>
            </div>
        </header>
    </center>

    <!-- ************************************** contenido ***************************** -->
    <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Principal</a></li>

        </ul>
    </div>
    <?php if($id_direccion==2 ){
		
	
			?>
    <section class="tables" style="margin-top: -35px !important;">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="table-wrapper">

                    <div class="table-title">
                        <div class="row card-header ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <h3 class="h4">Historial Correspondencia</h3>

                                    </div>
                                </div>
                            </div>

                            <div class='col-md-12 pull-right'>

                                <div id="custom-search-input">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-group-material" id="filt_remitente">
                                                <center><label>Selecciona un Remitente :</label></center>
                                                <select class="mi-selector form-control redondo " id="filtro_remitente"
                                                    name="filtro_remitente" style="border-radius: 25px !important; width: 100%" onchange="load(1);">
                                                    <option value=" ">Selecciona un Remitente ...</option>
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
                                        <div class="col-5">
                                            <div class="form-group-material">
                                                <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee
                                                    su
                                                    búsqueda ...
                                                </label>
                                                <input type="text" class="form-control redondo"  style="border-radius: 25px !important;" 
                                                    placeholder="Buscador en tiempo real " id="q1" name="q1"
                                                    onkeyup="load(1);">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group-material">
                                                <label>Selecciona el área :</label>
                                                <select class="form-control redondo" id="id_nivel1" name="id_nivel1" onchange="load(1);" style="border-radius: 25px !important; ">

                                                </select>
                                                <!--<input type="text" name="idEje"  id="idEje" class="form-control redondo" required>-->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group-material">
                                                <label></label>
                                                <select class="form-control redondo" id="id_nivel2" name="id_nivel2" onchange="load(1);" style="border-radius: 25px !important; ">

                                                </select>
                                                <!--<input type="text" name="idArea"  id="idArea" class="form-control redondo" required>-->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group-material">
                                                <label></label>
                                                <select class="form-control redondo" id="id_nivel3" name="id_nivel3" onchange="load(1);" style="border-radius: 25px !important;">

                                                </select>
                                                <!--<input type="text" name="idObj"  id="idObj" class="form-control redondo" required>-->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group-material">
                                                <label></label>
                                                <select class="form-control redondo" id="id_nivel4" name="id_nivel4" onchange="load(1);" style="border-radius: 25px !important; " >

                                                </select>
                                                <!--<input type="text" name="idObj"  id="idObj" class="form-control redondo" required>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="card" style="margin-bottom: 0px !important;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Original_titular"
                                                onkeyup="load(1);">
                                            <label class="custom-control-label" for="Original_titular"><span
                                                    class="badge badge-success">Original-Titular

                                                </span></label>
                                        </div><small class="text-center">Adjuntar Respuesta (Obligatorio)</small>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Con_original"
                                                onkeyup="load(1);">
                                            <label class="custom-control-label" for="Con_original"><span
                                                    class="badge badge-info">Conocimiento-Original
                                                </span></label>
                                        </div> <small class="text-center">Opcion a adjuntar repuesta</small>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="copia_titular"
                                                onkeyup="load(1);">
                                            <label class="custom-control-label" for="copia_titular"><span
                                                    class="badge badge-light">Copia-Titular

                                                </span></label>
                                        </div><small class="text-center">De conocimiento</small>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="conoci_copia"
                                                onkeyup="load(1);">
                                            <label class="custom-control-label" for="conoci_copia"><span
                                                    class="badge badge-light">Conocimiento-Copia


                                                </span></label>
                                        </div><small class="text-center">De conocimiento</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class='clearfix'></div>

                    <div id="loader"></div><!-- Carga de datos ajax aqui -->

                    <div id="resultados"></div><!-- Carga de datos ajax aqui -->
                    <div class='outer_div'></div><!-- Carga de datos ajax aqui -->



                </div>
            </div>
        </div>
    </section>
    <!-- Page Footer-->
    <?php include_once('../../plantillas/Direcciones/foother.php') ?>

    <?php include("../../html/Direcciones/modal_view_corresp_historial.php");?>
    <script src="../../js/Direcciones/controlador_historial.js"></script><!-- MODIFICAR -->
    <script src="../../js/Direcciones/combos.js"></script><!-- MODIFICAR -->
    <?php }else{
	echo("<br><h1  class='text-center'>Usted No tiene los permisos para acceder a esta sección!!</h1>");
} ?>
    <!-- <script src="../../js/jquery.counterup.min.js"></script>-->
    <!-- animacion contador -->
    <!-- este va en el index -->
    <!--  <script src="../../js/jquery.waypoints.js"></script>-->
    <!-- animacion contador -->
    <!-- este va en el index -->
    <!-- este va en el index contador-->
    <!--       <script>
				 $('.num').counterUp({delay:20, time:2000});	   
  
 </script>-->