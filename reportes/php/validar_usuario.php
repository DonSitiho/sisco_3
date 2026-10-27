<?php
session_start();

if(isset($_POST['usuario']) and isset($_POST['pasword'])){ //Comprobar si una variable está definida
	include('conexion.php');
	
	$nombreUsuario=mysqli_real_escape_string($conexion,  $_POST['usuario']); // elimiar caracteres para evitar inyecciones sql
	$contrasenaUsuario=mysqli_real_escape_string($conexion, $_POST['pasword']);
	

	
	$ComprobacionNombre=$conexion->query("SELECT * FROM usr_report WHERE nom_usr ='$nombreUsuario' "); // consulta base de datos
	
	$NumeroRegistros=mysqli_fetch_assoc($ComprobacionNombre);
	
	if($NumeroRegistros>0){
		$consulta_contrasena=mysqli_query($conexion, "SELECT pwd_usr FROM usr_report WHERE pwd_usr= '$contrasenaUsuario'");// otra forma
		
		$obtener_datos=mysqli_fetch_assoc($consulta_contrasena);// obtenemos los datos en un index
		
	
		if($obtener_datos>0){
			$_SESSION['nombre']=$nombreUsuario;
			header('Location:../vistas/PaginaInicio.php');
			print("bienvenido validar");
		}else{
			echo "<script type='text/javascript'>alert('Los datos son incorrectos ');</script>";
        echo "<script type='text/javascript'>window.location.href='../';</script>";
			/*print('Los datos son incorrectos <br>
			<a href="../index.php">volver </a>');*/
		}
	}else{
		echo "<script type='text/javascript'>alert('Los datos son incorrectos ');</script>";
        echo "<script type='text/javascript'>window.location.href='../';</script>";
	}
	
	
	
	
	
}else{
	header('../vistas/login.php');
}
?>