<?php include("../../plantillas/Particular/header.php"); ?>
         <!-- *************************** menu *****************-->
     
         
          <ul class="list-unstyled">
            <!-- Sidebar Navidation Menus--><span class="heading">Usuario</span>
            <li class=""><a href="perfil_usuario.php"> <i class="icon-user"></i>Perfil </a></li>
             <!-- Sidebar Navidation Menus--><span class="heading">Menú</span>
            <li ><a href="index.php"> <i class="icon-home"></i>Principal </a></li>
                <li class="active"><a href="corr_autorizada.php"> <i class="fa fa-legal"></i>Autorizada </a></li>
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
              <h2 class="no-margin-bottom"><?php echo($nom_direccion); ?></h2>
            </div>
          </header>
         <!-- ********************************** meni *****************-->
          <!-- Breadcrumb-->
           <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
              <li class="breadcrumb-item active">Corresp. Autorizada</li>
              <li> <!-- collapse --></li>
            </ul>
          </div>
           <p class="navbar-nav ml-auto"><!-- collapse -->
  
  
          
          <section class="tables">   
            <div class="container-fluid">
            	<div class="col-md-12">
        <div class="table-wrapper">
            
       <div class="table-title">
            <div class="row card-header ">
               <div class="col-md-8">
                <div class="d-flex align-items-center">
                      <h3 class="h4">Correspondencia Autorizada</h3>
                     
                     </div>
                    </div>
                <div class='col-md-4 pull-right' >
       
				<div id="custom-search-input">
                            <div class="input-group col-md-12">
                               
                                <div class="form-group-material">
                              <input  type="text"  id="q" onkeyup="load(1);" class="input-material">
                              <label for="register-username" class="label-material">Buscar</label>
                            </div>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-rounded" type="button" onclick="load(1);" style="border-radius: 50px !important;" >
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </span>
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
          
    <!-- JavaScript files-->
    <?php include("../../plantillas/Particular/foother.php"); ?>
     <?php include("../../html/Particular/modal_view_corresp_autorizada.php");?><!-- va en esta pagina-->

  
    <!-- Main File-->
   
   
    <script src="../../js/Particular/controlador_autorizada.js"></script><!-- va en esta pagina-->
 	       
    <script src="../../plantilla/js/charts-custom.js"></script>
 	                      
  	
  </body>
</html>