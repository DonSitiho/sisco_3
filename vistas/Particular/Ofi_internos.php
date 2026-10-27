<?php include_once('../../plantillas/Particular/header.php'); 
include_once('../../ajax/conexion.php'); 
//consulta a oficios internos
$consuta_oficios = mysqli_query($conexion, "SELECT revisado
                                            FROM oficios_conocimiento ");
$total_oficios = 0;
$oficios_revizados = 0;
$oficioss_pendientes = 0;
while ($row_oficios = mysqli_fetch_assoc($consuta_oficios)){
  $revisado = $row_oficios['revisado'];
  switch ($revisado){
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
               <li class=""><a href="../Direcciones/historial.php"> <i class="fa fa-mail"></i>Historial </a></li>
          <li class=""><a href="estadisticas.php"> <i class="fa fa-area-chart"></i>Estadisticas </a></li>
           
                <!-- Sidebar Navidation Menus--><span class="heading">Oficios del titular</span>
              <li class=""><a href="oficios_titular.php"> <i class="fa fa-mail"></i>Oficios </a></li>
               <li class="active"><a href="Ofi_internos.php"> <i class="fa fa-mail"></i>Oficios y/o Tarjetas de conocimiento </a></li>
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
        
        <div class="content-inner" >
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom"><?php echo($nom_direccion); ?></h2>
            </div>
          </header>
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Principal</a></li>
              <li class="breadcrumb-item active">Oficios y/o Tarjetas de Conocimiento  Internas</li>
              <li> <!-- collapse --></li>
            </ul>
          </div>
<!-- ******************************************      hasta aqui llega el header *************************-->
<div class="conteiner-fuid">
<div class ="card">
 <!-- Aqui va el nav -->
 <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Historial <span class="badge badge-secondary"><?=$total_oficios?></span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="º-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pendientes <span class="badge badge-secondary"><?=$oficioss_pendientes?></span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Revisadas <span class="badge badge-secondary"><?=$oficios_revizados?></span></a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><!-- contenido Historial -->
  <div class="container-fluid">
    <div class="table-wrapper table-responsive">
       <br>
      
           <div class="table-title">
            <div class="row card-header ">
               <div class="col-md-8">
                <div class="d-flex align-items-center">
                      <h3 class="h4">Oficios y/o Tarjetas de Conocimiento  Internas</h3>
                     
                     </div>
                    </div>
        <br>
        
                 <div class=" col-md-5" style="width:100% !important;">
                               
                               
                                </div>
                                <div class="col-md-1">
                               
                           </div>
               <div class=" col-md-5">
                               
                                <div class="form-group-material">
                              <input  type="text"  id="q1" onkeyup="load(1);" class="input-material">
                              <label for="register-username" class="label-material">Buscar</label>
                            </div>
                               </div>
                               <div class="col-md-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-rounded" type="button" onclick="load(1);" style="border-radius: 50px !important;" >
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </span>
                            </div>
           
        
     
            </div>
        </div>
        
        <div class='clearfix'></div>
      
        <div id="loader"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados1"></div><!-- Carga de datos ajax aqui -->
        <div class='outer_div'></div><!-- Carga de datos ajax aqui -->


    </div>
</div>

  </div><!-- fin del contenido del Historial -->
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <!-- Oficios Pendientes -->
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="container-fluid">
    <div class="table-wrapper table-responsive">
       <br>
      
           <div class="table-title">
            <div class="row card-header ">
               <div class="col-md-8">
                <div class="d-flex align-items-center">
                      <h3 class="h4">Pendientes</h3>
                     
                     </div>
                    </div>
        <br>
        
                 <div class=" col-md-5" style="width:100% !important;">
                               
                               
                                </div>
                                <div class="col-md-1">
                               
                           </div>
               <div class=" col-md-5">
                               
                                <div class="form-group-material">
                              <input  type="text"  id="q1P" onkeyup="loadP(1);" class="input-material">
                              <label for="register-username" class="label-material">Buscar</label>
                            </div>
                               </div>
                               <div class="col-md-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-rounded" type="button" onclick="load(1);" style="border-radius: 50px !important;" >
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </span>
                            </div>
           
        
     
            </div>
        </div>
        
        <div class='clearfixP'></div>
      
        <div id="loaderP"></div><!-- Carga de datos ajax aqui -->
        <div id="resultadosP"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados1P"></div><!-- Carga de datos ajax aqui -->
        <div class='outer_divP'></div><!-- Carga de datos ajax aqui -->


    </div>
</div>

  </div>
  <!-- Fin de oficios Pendientes -->
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
  <!-- Oficios Revisados -->
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="container-fluid">
    <div class="table-wrapper table-responsive">
       <br>
      
           <div class="table-title">
            <div class="row card-header ">
               <div class="col-md-8">
                <div class="d-flex align-items-center">
                      <h3 class="h4">Oficios Revisados </h3>
                     
                     </div>
                    </div>
        <br>
        
                 <div class=" col-md-5" style="width:100% !important;">
                               
                               
                                </div>
                                <div class="col-md-1">
                               
                           </div>
               <div class=" col-md-5">
                               
                                <div class="form-group-material">
                              <input  type="text"  id="q1R" onkeyup="loadR(1);" class="input-material">
                              <label for="register-username" class="label-material">Buscar</label>
                            </div>
                               </div>
                               <div class="col-md-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-rounded" type="button" onclick="loadR(1);" style="border-radius: 50px !important;" >
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </span>
                            </div>
           
        
     
            </div>
        </div>
        
        <div class='clearfixR'></div>
      
        <div id="loaderR"></div><!-- Carga de datos ajax aqui -->
        <div id="resultadosR"></div><!-- Carga de datos ajax aqui -->
        <div id="resultados1R"></div><!-- Carga de datos ajax aqui -->
        <div class='outer_divR'></div><!-- Carga de datos ajax aqui -->


    </div>
</div>

  </div>
  <!-- Fin de  Oficios Revisados -->
  </div>
</div>
            <!-- fin del nav -->
</div>
</div>

 
    
<?php include('../../plantillas/Particular/foother.php'); ?>
<?php include('../../html/Particular/modal_Ofi_conocimiento.php'); ?>		
<script src="../../js/Particular/controlador_Ofi_conocimiento.js"></script>

