
<?php
	
	/* Connect To Database*/
	require_once ("../conexion.php");

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){

	//$query = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query'], ENT_QUOTES)));	
	$fremte = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['fremte'], ENT_QUOTES)));
    $query1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['query1'], ENT_QUOTES)));
	$nivel1 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['nivel1'], ENT_QUOTES)));
	$nivel2 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['nivel2'], ENT_QUOTES)));
	$nivel3 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['nivel3'], ENT_QUOTES)));
	$nivel4 = mysqli_real_escape_string($conexion,(strip_tags($_REQUEST['nivel4'], ENT_QUOTES)));

     //Variables de los checkbOxes
	
	 session_start();
	$id_direccion=$_SESSION['id_direccion'];
	$id_usuario=$_SESSION['id_usuario'];
	$nivel_acceso=$_SESSION['nivel_acceso'];
	if($id_direccion==2 ){
	if($id_direccion==2 ){
		$decision=' ';
	}else{
		$decision=' dc.id_direcciones='.$id_direccion.' AND';
	}
	
	if($fremte>0){
        if($nivel1>0){
            if($nivel2>0){
                if($nivel3>0){
                    if($nivel4>0){
                        if($query1>''){

                            $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND dc.id_sub_oic=$nivel2 AND dc.id_departamento=$nivel3 AND dc.id_oficina=$nivel4 AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%' OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";

                        }else{

                            $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND dc.id_sub_oic=$nivel2 AND dc.id_departamento=$nivel3 AND dc.id_oficina=$nivel4 order by dc.folio";

                        }

                    }else{

                        if($query1>''){

                            $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND dc.id_sub_oic=$nivel2 AND dc.id_departamento=$nivel3 AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%' OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";

                        }else{

                            $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND dc.id_sub_oic=$nivel2 AND dc.id_departamento=$nivel3  order by dc.folio  ";	

                        }
                    }
                }else{

                    if($query1>''){

                        $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND dc.id_sub_oic=$nivel2 AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%' OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";

                    }else{

                        $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND dc.id_sub_oic=$nivel2 order by dc.folio  ";

                    }			
                }
            }else{

                if($query1>''){

                    $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' OR dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' OR dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' OR dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' OR dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' OR dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%' OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";

                }else{

                    $sWhere= " where".$decision." dc.id_remitente=$fremte AND dc.id_direcciones=$nivel1 order by dc.folio";

                }
            }
        } else {

            if($query1>''){
            $sWhere= " where".$decision." dc.id_remitente=$fremte AND (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' 
            OR dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' 
            OR dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' 
            OR dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' 
            OR dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' 
            OR dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' 
            OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%'  
            OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";

            }else {

                $sWhere=" where".$decision." dc.id_remitente=$fremte order by dc.folio  ";
            }
        }
    } else {

        if($query1>''){

            $sWhere= " where".$decision." (dc.id_datos_c LIKE '%".$query1."%' OR dc.folio LIKE '%".$query1."%' 
            OR dc.f_recepcion LIKE '%".$query1."%' OR dc.tipo_oficio LIKE '%".$query1."%' 
            OR dc.id_remitente LIKE '%".$query1."%' OR dc.cargo LIKE '%".$query1."%' 
            OR dc.Nombre LIKE '%".$query1."%' OR dc.num_oficio LIKE '%".$query1."%' 
            OR dc.f_oficio LIKE '%".$query1."%' OR dc.id_destinatarios LIKE '%".$query1."%' 
            OR dc.cargo_destinatario LIKE '%".$query1."%' OR dc.asunto_destinatario LIKE '%".$query1."%' 
            OR dc.instrucciones_direcciones LIKE '%".$query1."%' OR ds.nombre_direccion LIKE '%".$query1."%'  
            OR d.nombre LIKE '%".$query1."%' OR dependencias.nombre LIKE '%".$query1."%') order by dc.folio  ";

        }else {

            $sWhere=" order by dc.folio  ";
        }


    }
       
	
	$tables="datos_correspondencia as dc";
	$campos="dc.*, dependencias.*, ds.*, d.id_dependencia as did, d.identificador as dide, d.sigla as dsi, d.nombre as dnom";
      
	//VERIFICAR DE QUE DIRECCION ES 
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Cuente el número total de filas en su tabla*/
	$count_query   = mysqli_query($conexion,"SELECT count(*) AS numrows FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones ".$sWhere);
	
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($conexion);}
	$total_pages = ceil($numrows/$per_page);
	//consulta principal para recuperar los datos
	$query = mysqli_query($conexion,"SELECT $campos FROM (($tables INNER JOIN dependencias ON dependencias.id_dependencia=dc.id_remitente)
																	INNER JOIN dependencias as d ON d.id_dependencia=dc.id_destinatarios) 
																	INNER JOIN direcciones_secoem AS ds ON ds.id_direccion=dc.id_direcciones
																	$sWhere LIMIT $offset,$per_page");
	
	
	//echo $query;
	//loop through fetched data
	
	if ($numrows>0){
		
	?>
		<div class="card">
                  
                    
                    <div class="card-body">
                      <div class="table-responsive">   
                        <table class="table table-striped table-sm table-hover table-bordered">
				<thead>
				<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
					<tr class="text-center">
						
						<!--<th class='text-center'>Tipo</th>-->						
						<th><label class="label-busqueda1">Folio</label></th>
						<th><label class="label-busqueda1"># Oficio / Fecha</label></th>
						<th><label class="label-busqueda1">Remitente / Dependencia</label></th>
						<th><label class="label-busqueda1">Destinatario</label></th>
						<th><label class="label-busqueda1">Asunto</label></th>
						<th><label class="label-busqueda1">Turnado a:</label></th>
						<th><label class="label-busqueda1">Tipo Corres</label></th>
						<th><label class="label-busqueda1">Resumen</label></th>
						
						<!--<th class='text-center' colspan="3">Asunto</th>-->
				<!--		<th class='text-center' colspan="6">Opciones</th>-->
						
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){
							$id_remitente=$row['id_remitente'];
							$id_destinatario=$row['id_destinatarios'];
							$nombre_direccion=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS WHERE id_dependencia= '$id_remitente'");
							$datosRemitente=mysqli_fetch_assoc($nombre_direccion);
							$nombre_remitente=$datosRemitente['identificador'].' - '.$datosRemitente['nombre'];
							
							$nombre_direccion1=mysqli_query($conexion, "SELECT * FROM DEPENDENCIAS WHERE id_dependencia= '$id_destinatario'");
							$datosRemitente1=mysqli_fetch_assoc($nombre_direccion1);
							$nombre_destinatario=$datosRemitente1['identificador'].' - '.$datosRemitente1['nombre'];
							
							$corres_id=$row['id_datos_c'];
							
							$archivos=mysqli_query($conexion, "SELECT * FROM documentos WHERE id_datos_c1= '$corres_id'");
							$Datos_Archivos=mysqli_fetch_assoc($archivos);
							$ruta=$Datos_Archivos['ruta'];
							$nombre_documento=$Datos_Archivos['nombre_documento'];
							$pdf="  <a href='../".$ruta."' >".$nombre_documento."</a>";
						
							$corres_folio=$row['folio'];							
							$corres_f_recep=$row['f_recepcion'];
							$corres_tip_ofi=$row['tipo_oficio'];
							$corres_idRemte=$nombre_remitente;//Cambiar al NOmbre
							$corres_nomDep=$row['nombre'];							
							$corres_cargoRemte=$row['cargo'];
							$corres_nomRemte=$row['Nombre'];
							$corres_noOfi=$row['num_oficio'];							
							$corres_fOfi=$row['f_oficio'];
							$corres_idDestino=$nombre_destinatario;//Cambiar a nombre
							$corres_nomDestino=$row['dnom'];
							$corres_cargoDest=$row['cargo_destinatario'];							
							$corres_asuntoDoc=$row['asunto_destinatario'];
							$corres_indica=$row['indicaciones_destinatario'];
							$corres_anexoDest=$row['anexo_destinatario'];
							$corres_idDireccion=$row['id_direcciones'];
							$corres_nomDireccion=$row['nombre_direccion'];
							$corres_f_turnado=$row['f_turnado'];
							$corres_instruccDir=$row['instrucciones_direcciones'];
							$corres_f_recepArea=$row['f_recepArea'];
							$corres_obs=$row['leyenda_destinatario'];							
							$corres_status=$row['id_estatus1'];							
							$corres_fechCap=$row['fecha_cap_c'];
							$corres_id_sub_oic   = $row['id_sub_oic'];
							$corres_view_sub     = $row['view_sub_oic'];
							$corres_id_depto     = $row['id_departamento'];
							$corres_view_depto    = $row['view_dep'];				
							$finales++;
							//nombres SUBDIRECCION O Departamento
							$nombre_depto = "";
							$nombre_sub_dir = "";
                            
							if( $corres_id_sub_oic > 0 ){
								//echo "Entro";

								$consulta_sub = mysqli_query($conexion, "SELECT nombre FROM subdirecciones_oic WHERE id = '$corres_id_sub_oic'");
								$row_Sub_dir = mysqli_fetch_assoc($consulta_sub);
								$nombre_sub_dir ='<p class="form-text text-muted text-info" style="margin: 0px !important;">'. $row_Sub_dir['nombre'].'</p>';
								$boton_turnar = "Editar";
								$boton_turnar_class = "badge badge-warning";
                                
								if ($corres_id_depto > 0) {//Turnado a departamento
									//echo "ENTRO";
								$consulta_depto = mysqli_query($conexion, "SELECT nombre_depto FROM departamentos WHERE id = '$corres_id_depto'");
								$row_depto = mysqli_fetch_assoc($consulta_depto);
								$nombre_depto ='<p class="form-text text-muted text-primary" style="margin: 0px !important;">'. $row_depto['nombre_depto'].'</p>';
								//verificccar
								$boton_turnar = "Editar";
								$boton_turnar_class = "badge badge-warning";
								

								}else{
									//Consultar nombre subdireccion
								$nombre_depto =' ';
								//verificccar
								// if ($subdireccion != 0 ){
								// 	$boton_turnar = "Turnar";
								//    $boton_turnar_class = "badge badge-info";

								// }
								
								

								}
								

							}else{
								$nombre_sub_dir = "";
								$boton_turnar   = "Turnar";
								$boton_turnar_class = "badge badge-info";
							}
							$c_o_o = substr($corres_folio, -2);
							//echo $c_o_o;
							switch($corres_status){
									case 1:
							         $badge='<span class="badge badge-warning">Pendiente</span>';
								break;
								case 2:
							         $badge='<span class="badge badge-primary">Autorizada</span>';
								break;
								case 3:
									$badge='<span class="badge badge-info">En Seguimiento</span>';
									break;
								case 6:
									$badge='<span class="badge badge-success">Finalizado</span>';
									break;
							}
							
							if($corres_tip_ofi==0){// Es para el titular
								if($c_o_o=='01'){
								//ES ORIGINAL TITULAR
									$tipo_corres='<span class="badge badge-success">Original-Titular</span>';
							     }else{
								//ES COPIA DEL TITULAR
									$tipo_corres='<span class="badge badge-Secondary">Copia-Titular</span>';
							     }      
							
							}else{
								//No es para el titular
								if($c_o_o=='01'){
								//ES ORIGINAL COPIA
									$tipo_corres='<span class="badge badge-info">Conocimiento-Original</span>';
							      }else{
								//ES COPIA DE la COPIA
									$tipo_corres='<span class="badge badge-Secondary">Conocimiento-Copia</span>';
							      }
									
							}
						?>	
						<tr class=" text-center" style="font-size: 92% !important;">
							
							<td>
								<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?php echo $corres_folio."<br>".$badge;?></span></div>
							</td>
							
							<td>
								<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?php echo $corres_noOfi;?><br><?php echo $corres_fOfi;?></span></div>
							</td>
							<td>
								<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?php echo $corres_nomRemte;?><br><?php echo $corres_nomDep;?></span></div>
							</td>
							
							<!-- <td ><?php echo $corres_nomDep;?></td> -->
							
							<td >
								<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?php echo $corres_nomDestino;?></span></div>
							</td>

							<?php

							$longitud = 128;
							$cadena = trim(strip_tags($corres_asuntoDoc));
	
							if (strlen($cadena) > $longitud) {
								//Acortamos la cadena a la longitud dada
								$cadena = substr($cadena, 0, $longitud + 1);
	
								//Expresión regular de espacio en blanco
								$regExp = "/[\s]|&nbsp;/";
	
								//Dividimos la cadena en palabras y la guardamos en un array        
								$palabras = preg_split($regExp, $cadena, -1, PREG_SPLIT_NO_EMPTY);
	
								//Buscamos la expresión regular al final de la cadena
								preg_match($regExp, $cadena, $ultimo, 0, $longitud);
	
								if (empty($ultimo)) {
									//Si la última palabra no estaba seguida por un espacio en blanco,
									//la eliminamos del conjunto de palabras
									array_pop($palabras);
								}
	
								//Creamos la cadena resultante por la unión del conjunto de palabras
								$cadena = implode(' ', $palabras) . '&hellip;';
	
								//echo "<td >".$corres_nomDestino."></td>";
	
								echo "<td >";
								echo '<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span>' ?></span>
								<abbr title="<?php echo $corres_asuntoDoc ?>"><span class="campo-resultado-1"><?php echo $cadena; ?></span></abbr>
								</div>';
								<?php
								echo '</td>';
	
								//echo "<td >".$cadena."</td>";
	
							} else {
	
								echo "<td >";
								echo '<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1">' ?> <?php echo $corres_asuntoDoc; ?></span><label class="label-busqueda1">Asunto</label>
								</div>';
								<?php
								echo '</td>';
							}
	
	
							?>

							<td>
								<div class="campo-resultado" style="grid-area:1 / 1 / 2 / 2;"><span class="campo-resultado-1"><?=$corres_nomDireccion?><br><?=$nombre_sub_dir?><?=$nombre_depto?></span></div>	
							</td>

							<td class="text-center"><?php echo $tipo_corres;?></td>
							<!--<td colspan="3"><?php echo $corres_asuntoDoc;?></td>-->
							
							<!-- VERIFICAREMOS SI LA CORRESPONDENCIA ES ORIGINAL O COPIA-->
							<?php
							$c_o_o = 1;
							if($c_o_o==1){
								
							
							?>
							
							<td>
							
							
							
								<a href="?idcor=<?php echo $corres_id; ?>" class="editar"  data-target="#viewCorrespondenciaModalSeguimiento" data-toggle="modal" 
								data-vfolio="<?php echo $corres_folio;?>" 
								data-vfrecep="<?php echo date("d-m-Y",strtotime( $corres_f_recep));?>" 
								data-vnofi="<?php echo $corres_noOfi;?>" 
								data-vfofi="<?php echo date("d-m-Y",strtotime($corres_fOfi));?>" 
								data-vtofi="<?php echo $corres_tip_ofi;?>" 
								data-vidremi="<?php echo $corres_idRemte;?>" 
								data-vcargorem="<?php echo $corres_cargoRemte;?>" 
								data-vnomrem="<?php echo $corres_nomRemte;?>" 
								data-viddest="<?php echo $corres_idDestino;?>" 
								data-videst="<?php echo $corres_status;?>" 
								data-vcargodest="<?php echo $corres_cargoDest;?>" 
								data-vasuntodoc="<?php echo $corres_asuntoDoc;?>" 
								data-vanexodest="<?php echo $corres_anexoDest;?>" 
								data-vindidest="<?php echo $corres_indica;?>" 
								data-viddirec="<?php echo $corres_nomDireccion;?>" 
								data-vfturnado="<?php echo $corres_f_turnado;?>"
								data-vinstdir="<?php echo $corres_instruccDir;?>"
								data-idirecciones="<?php echo($corres_idDireccion); ?>" 
								data-vfreceparea="<?php echo $corres_f_recepArea;?>"							
								data-vobs="<?php echo $corres_obs;?>" 
								data-vstatus="<?php echo $corres_status;?>" 
								data-vfcapt="<?php echo $corres_fechCap;?>"
								 
								data-vid="<?php echo $corres_id;?>" onclick="mostrararchivos('<?php echo $corres_id;?>');"> <div class="statistic d-flex align-items-center "><div class="icon bg-green"><i class="icon-mail"></i></div></div></a>							
							</td>
						<?php
								}else{
								?>
								<td>
							
							
							
								<a href="?idcor=<?php echo $corres_id; ?>" class="editar"  data-target="#viewCorrespondenciaModalCopia" data-toggle="modal" 
								data-vfolio="<?php echo $corres_folio;?>" 
								data-vfrecep="<?php echo date("d-m-Y",strtotime( $corres_f_recep));?>" 
								data-vnofi="<?php echo $corres_noOfi;?>" 
								data-vfofi="<?php echo date("d-m-Y",strtotime($corres_fOfi));?>" 
								data-vtofi="<?php echo $corres_tip_ofi;?>" 
								data-vidremi="<?php echo $corres_idRemte;?>" 
								data-vcargorem="<?php echo $corres_cargoRemte;?>" 
								data-vnomrem="<?php echo $corres_nomRemte;?>" 
								data-viddest="<?php echo $corres_idDestino;?>" 
								data-videst="<?php echo $corres_status;?>" 
								data-vcargodest="<?php echo $corres_cargoDest;?>" 
								data-vasuntodoc="<?php echo $corres_asuntoDoc;?>" 
								data-vanexodest="<?php echo $corres_anexoDest;?>" 
								data-vindidest="<?php echo $corres_indica;?>" 
								data-viddirec="<?php echo $corres_nomDireccion;?>" 
								data-vfturnado="<?php echo $corres_f_turnado;?>"
								data-vinstdir="<?php echo $corres_instruccDir;?>"
								data-idirecciones="<?php echo($corres_idDireccion); ?>" 
								data-vfreceparea="<?php echo $corres_f_recepArea;?>"							
								data-vobs="<?php echo $corres_obs;?>" 
								data-vstatus="<?php echo $corres_status;?>" 
								data-vfcapt="<?php echo $corres_fechCap;?>"
								 
								data-vid="<?php echo $corres_id;?>" onclick="mostrararchivos1('<?php echo $corres_id;?>');"> <div class="statistic d-flex align-items-center "><div class="icon bg-yellow"><i class="icon-mail"></i></div></div></a>							
							</td>
						<?php
							}
							?>
							
						</tr>
						<?php }?>
                        <tr class="text-center">
							
							<th><label class="label-busqueda1">Folio</label></th>
							<th><label class="label-busqueda1"># Oficio / Fecha</label></th>
							<th><label class="label-busqueda1">Remitente / Dependencia</label></th>
							<th><label class="label-busqueda1">Destinatario</label></th>
							<th><label class="label-busqueda1">Asunto</label></th>
							<th><label class="label-busqueda1">Turnado a:</label></th>
							<th><label class="label-busqueda1">Tipo Corres</label></th>
							<th><label class="label-busqueda1">Resumen</label></th>
							
						</tr>
						<tr>
							<td colspan='12'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";										
								?>
							</td>
						</tr>
						<tr>
							<td colspan='12'> 
								<?php 										
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			     </table>
                      </div>
                    </div>
                  </div>	

	
	
	<?php	
	}	
}
}else{
	echo "No tienes acceso a esta area, sorry!!";
}

?> 
<script>
	function mostrararchivos(id) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/mostrar_documentos.php?id='+id,
					success: function( data ) {
						$('#resultados1').html(data);
						
					}
				}
			)
		
}
</script>
<script>
	function mostrararchivos1(id) {
	
		$.ajax(
				{
					url: '../../html/Direcciones/archivoEnviarDato.php?id='+id,
					success: function( data ) {
						$('#resultados1C').html(data);
						
					}
				}
			)
		
}
</script>
         
<!--<script>
function enviarid()
{
 
valor="<?php echo $corres_id;?>";
location.href='/html/modal_view_corresp.php?idcorres='+valor;
 
}
</script>-->
  
		  
  
		  
