<?php
if(isset($_GET['id'])){
	$fiolioBruto=$_GET['id'];
	require_once('../../php/conexion.php');
	
	                        $newFolio = substr($fiolioBruto, 0, 9); // devuelve "d"
	                        $nom_direccion='';
	                        $sacar_copias=mysqli_query($conexion,"SELECT id_datos_c FROM `datos_correspondencia` WHERE `folio` LIKE '%$newFolio%'");
							$direcciones='';
							echo('<div class="col-lg-12">
                  <div class="recent-updates card" style="border-radius: 25px !important;">
                    
                    <div class="card-header" style="margin:3px !important;padding:3px !important; border-radius: 25px !important;   border-color:rgba(171,113,255,0.55);
	background:rgba(253,253,253,1.00) !important; ">
                      <h3 class="h4">Con copia para:</h3>
                    </div>
                    <div class="card-body no-padding">');
	                       $contador=0;
	                        while($rows_copias=mysqli_fetch_assoc($sacar_copias)){
		                        $id_direcciones=$rows_copias['id_datos_c'];
		                        $buscar_id_direcciones=mysqli_query($conexion, "SELECT id_direcciones FROM datos_correspondencia WHERE id_datos_c='$id_direcciones'");
								while($rows_direcciones=mysqli_fetch_assoc($buscar_id_direcciones)){
									$direcciones=$rows_direcciones['id_direcciones'];
									$consulta_nombres=mysqli_query($conexion,"SELECT nombre_direccion FROM direcciones_secoem where id_direccion='$direcciones'");
									$row_nom=mysqli_fetch_assoc($consulta_nombres);
									$nom1=$row_nom['nombre_direccion'];
									if($contador==0){
										//no imprime nada	
									}else{
										echo(' <!-- Item-->
                      <div class="item d-flex justify-content-between" style="margin:0px !important;padding:0px !important;">
                        <div class="info d-flex" style="margin:0px !important;padding:0px !important;">
                          <div class="" style="margin:0px !important;padding:0px !important;"><i class="icon-rss-feed"></i></div>
                          <div class="" style="margin:0px !important;padding:0px !important;">
                            <h6 class="text-center">'.$nom1.'</h6>
                            
                          </div>
                        </div>
                       
                      </div>');	
									}
									$contador++;
								
									
									
								}
								
	                        }
	echo'    </div>
                </div>';
}else{
echo('no llego el folio');
}

//SACAR COPIAS
							/*	*/
?>