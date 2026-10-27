<?php

require_once("conexion.php");
session_start();
$id_usuario=$_SESSION['id_usuario'];
$nombre = $_FILES['imagen']['name'];
$nombrer = strtolower($nombre);

$ruta = "../images/usuarios/".$id_usuario.$nombre;
$destino = $nombre;
$resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
$ruta='../'.$ruta;

//sacar modulo usuario
$consuta_direccion=mysqli_query($conexion,"SELECT id_direccion1 FROM usuarios WHERE id_usuario='$id_usuario'");
$row_direccion=mysqli_fetch_assoc($consuta_direccion);
$id_direccion=$row_direccion['id_direccion1'];
if($id_direccion==0){
	$modulo='Oficialia';
}elseif($id_direccion==2){
	$modulo='Particular';
}else{
	$modulo='Direcciones';
}
if (!empty($resultado)){
	
	            $consulta_registros=mysqli_query($conexion, "SELECT * FROM imagenes_usuario WHERE id_usuario1='$id_usuario'");
	            $row_reguistro=mysqli_fetch_assoc($consulta_registros);
	            $nombre_imagen=$row_reguistro['nombre_img'];
	            if (mysqli_num_rows($consulta_registros)>0){
				
				
					
					mysqli_query($conexion,"UPDATE imagenes_usuario SET ruta = '$ruta', nombre_img='$nombre' WHERE id_usuario1 = '$id_usuario';");
					$borrar_imagen='../images/usuarios/'.$id_usuario.$nombre_imagen;
					unlink($borrar_imagen);
					
				}else{
					
				   mysqli_query($conexion,"INSERT INTO imagenes_usuario VALUES (NULL,'$ruta','$nombre', '$id_usuario')"); 
				}
                
                

                }else{

                    echo "Error al subir el archivo";

                    }
$_SESSION['ruta']=$ruta;
header('Location:../vistas/'.$modulo.'/perfil_usuario.php');
?>