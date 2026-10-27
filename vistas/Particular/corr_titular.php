<?php
include_once( "../../plantillas/Particular/header.php" );
include( "../../php/conexion.php" );
$cant_corr = mysqli_query( $conexion, "SELECT tipo_oficio, folio, id_estatus1  FROM datos_correspondencia where tipo_oficio=0" );
$c_t = 0;
$c_c = 0;
$c_o = 0;
$titular_original = 0;
$titular_copia = 0;
$finalizado=0;
$seguimiento=0;
$bandeja=0;
$pendientes=0;
while ( $row_corr1 = mysqli_fetch_assoc( $cant_corr ) ) {
	$corres_folio = $row_corr1[ 'folio' ];
	$c_o_o = substr( $corres_folio, -1 );
	$tipo_doc = $row_corr1[ 'tipo_oficio' ];
	//saber si es para el titular o de conocimiento
	if ( $tipo_doc == 0 ) {
		$c_o++; //para el secretario
		//saber si es copia para el titular
		if ( $c_o_o == 1 ) {
			//ES ORIGINAL TITULAR
			$titular_original++;
		} else {
			//ES COPIA DEL TITULAR
			$titular_copia++;
		}
	} else {
		$c_c++; //conocimiento secretario
	}
	// verificar estatus correspondencia
	$corres_status = $row_corr1[ 'id_estatus1' ];
	switch ( $corres_status ) {
		case 1:
			if($c_o_o == 1){
				$pendientes++;
			}
			
			break;
		case 2:
			if($c_o_o == 1){
				$bandeja++;
			}
			
			break;
		case 3:
			if($c_o_o == 1){
				$seguimiento++;
			}
			
			break;
		case 6:
			if($c_o_o == 1){
				$finalizado++;
			}
			
			break;
	}

	$c_t++;
}

?>
         <!-- *************************** menu *****************-->
     
         
          <ul class="list-unstyled">
            <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
            <li class=""><a href="perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
             <!-- Sidebar Navidation Menus--><span class="heading">Menú</span>
            <li ><a href="index.php"> <i class="icon-home"></i>Principal </a></li>
                <li class=""><a href="corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>
                    <li class=""><a href="corr_finalizado.php"> <i class="fa fa-address-card"></i>Finalizados </a></li>
                       <li class=""><a href="../Direcciones/historial.php"> <i class="fa fa-mail"></i>Historial </a></li>
             <li class=""><a href="estadisticas.php"> <i class="fa fa-area-chart"></i>Estadisticas </a></li>
               <!-- Sidebar Navidation Menus--><span class="heading">Oficios del titular</span>
              <li class=""><a href="oficios_titular.php"> <i class="fa fa-mail"></i>Oficios </a></li>
              <li class="" ><a href="Ofi_internos.php"> <i class="fa fa-id-badge"></i>Oficios y/o Tarjetas de conocimiento </a></li>
            
         
         <!--   <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>Example dropdown </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>-->
        
          </ul><span class="heading">Extras</span>
          <ul class="list-unstyled">            
            <li> <a href="c_rpfecha_part.php"> <i class="fa fa-id-badge"></i>Reporte por fecha </a></li>
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
              <h2 class="no-margin-bottom"><?php echo($nom_direccion). " ( Correspondencia para el Secretarío )"; ?></h2>
            </div>
          </header>
		<!-- ************************************** contenido ***************************** -->
			<div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
            
            </ul>
          </div>
            <section class="dashboard-counts no-padding-bottom" style="margin-top: -35px !important;">
            <div class="container-fluid"  >
              <div class="row bg-white has-shadow">
                <!-- Item -->
                <div class="col-xl-4 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="icon-bill"></i></div>
                    <div class="title"><span>Total Secretario</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>
                    </div>
                    <div class="number"><strong class="num"><?php echo($c_o); ?></strong></div><!--meter titular de correspondencia-->
                  </div>
                </div>
                <!-- Item -->
                <div class="col-xl-4 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-user"></i></div>
                    <div class="title"><span>titular - Original.</span>
                      <div >
                            <p>
  <a class=" btn-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    ver mas...
  </a>

</p>
                      </div>
                    </div>
                    <div class="number"><strong class="num"><?php echo($titular_original); ?></strong></div><!--meter total de correspondencia-->
                  
              

                  </div>
                </div>
                
                <!-- Item -->
                <div class="col-xl-4 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="icon-padnote"></i></div>
                    <div class="title"><span class="text-sm">Titular - Copia.</span>
                      <div class="progress">
                        <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
                    </div>
                    <div class="number"><strong class="num"><?php echo($titular_copia); ?></strong></div><!--meter copias de correspondencia-->
                  </div>
                </div>
               
                <!-- Item -->
                
              </div>
              <div class="collapse" id="collapseExample">
  <div class="card card-body">
   <h4 class="text-center">Correspondencia Para el Secretarío</h4>
   <div class="row">
   	<div class="col-md-3">
   		<h1><span class="badge badge-warning">Pendientes: <span class="badge badge-light"><?=$pendientes ?></span> </span></h1>
   	</div>
   	<div class="col-md-3">
   		<h1><span class="badge badge-info">Bandeja: <span class="badge badge-light"><?=$bandeja ?></span> </span></h1>
   	</div>
   	<div class="col-md-3">
   		<h1><span class="badge badge-primary">Seguimiento: <span class="badge badge-light"><?=$seguimiento ?></span> </span></h1>
   	</div>
   	<div class="col-md-3">
   		<h1><span class="badge badge-secondary">Finalizados: <span class="badge badge-light"><?=$finalizado ?></span> </span></h1>
   	</div>
   </div>
  </div>
</div>
            </div>
          </section>
            
          <section class="tables" style="margin-top: -35px !important;">   
            <div class="container-fluid">
            	<div class="col-md-12">
        <div class="table-wrapper">
            
       <div class="table-title">
            <div class="row card-header ">
           <div class="row">
           	<div class="col-md-12">
                <div class="d-flex align-items-center">
                      <h3 class="h4">Correspondencia Para el Secretario</h3>
                     
                     </div>
                    </div>
           </div>
               
                <div class='col-md-12 pull-right' >
       
				<div id="custom-search-input">
                  <div class="row">
                    <div class="col-6">
                        <div class="form-group-material" id="elige_area_oficio">
                            <label for="q" class="" style="margin-buttom: 12px !important;">Estatus: </label>
                            <select class="mi-selector form-control mb-6" id="q" name="q" required
                                class="input-material" onchange="load(1);">
                                <option value="0">Todos los registros</option>
                                
                                           <option value="1" class="text-success">Original Titular</option>
                                           <option value="2">Copia-Titilar</option>
                                          
                                       
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group-material">
                            <label for="q1" class="" style="margin-buttom: 12px !important;">Teclee su búsqueda ...
                            </label>
                            <input type="text" class="form-control" placeholder="Buscador en tiempo real " id="q1"
                                name="q1" onkeyup="load(1);">
                        </div>                        
                    </div>
                </div>
                </div>
			</div>
			  
           
            </div>
          
        </div>
        
			

	
            
			<div class='clearfix'></div>
		    
			<div id="loader"></div><!-- Carga de datos ajax aqui -->
		
			<div id="resultados" ></div><!-- Carga de datos ajax aqui -->
			<div class='outer_div'></div><!-- Carga de datos ajax aqui -->
			
			
      
    </div>
                    </div>
            </div>
          </section>
          <!-- Page Footer-->
        <?php include_once('../../plantillas/Direcciones/foother.php') ?>
         
      <?php include("../../html/Direcciones/modal_view_corresp_original.php");?><!-- MODIFICAR -->
			 <?php include("../../html/Direcciones/modal_view_corresp_copia.php");?><!-- MODIFICAR -->
    <script src="../../js/Particular/controlador_titular.js"></script><!-- MODIFICAR -->
 	            
  	           <!-- <script src="../../js/jquery.counterup.min.js"></script>--><!-- animacion contador --><!-- este va en el index -->
  	           <!--  <script src="../../js/jquery.waypoints.js"></script>--><!-- animacion contador --><!-- este va en el index -->
  	             <!-- este va en el index contador-->
	  	    <!--       <script>
				 $('.num').counterUp({delay:20, time:2000});	   
  
 </script>-->