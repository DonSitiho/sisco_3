<?php
session_start();
require_once("../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: ../vistas/login.php');
	exit;
}

if (empty($_POST['UserC']) || empty($_POST['PassC'])) {
	header('Location: ../');
	exit;
}

// Sanitizar entradas 
$nombre_usuario = trim(htmlspecialchars($_POST['UserC'], ENT_QUOTES, 'UTF-8'));
$contrasena = trim($_POST['PassC']);

// Longitudes razonables para evitar ataques de payload largo NEW
if (strlen($nombre_usuario) > 64 || strlen($contrasena) > 128) {
	header('Location: ../');
	exit;
}

//require_once 'conexion.php';

$sqlNombre = "SELECT * FROM usuarios WHERE nick_name = ? AND is_active = 1 LIMIT 1";
$stmtNombre = $conexion->prepare($sqlNombre);
$stmtNombre->bind_param('s', $nombre_usuario);
$stmtNombre->execute();

$resultado = $stmtNombre->get_result();

if ($resultado->num_rows === 0) {
	echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location.href='../';
    </script>";
	exit;
}

$usuario = $resultado->fetch_assoc();

$esTextoPlano  = false;
$loginCorrecto = false;

// Verificar si la contraseña es hash bcrypt valido.
if (password_verify($contrasena, $usuario['contrasena_usr'])) {

	$loginCorrecto = true;

} elseif ($contrasena === $usuario['contrasena_usr']) {
	$loginCorrecto = true;
	$esTextoPlano = true;
}

if (!$loginCorrecto){
	echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location.href='../';
        </script>";
	exit;
}

$nombre_direccion = '';

if ($usuario['id_sub_oic'] != 0) {

	if ($usuario['id_oficina'] != 0) {
		// Nombre de Oficina.
		$sqlArea = "SELECT nombre FROM oficinas WHERE id = ?";
		$campo = 'nombre';
		$idArea = $usuario['id_oficina'];
	} elseif ($usuario['id_dep'] != 0) {
		// Nombre de Departamento.
		$sqlArea = "SELECT nombre_depto FROM departamentos WHERE id = ?";
		$campo = 'nombre_depto';
		$idArea = $usuario['id_dep'];
	} else {
		// Nombre de Subdireccion.
		$sqlArea = "SELECT nombre FROM subdirecciones_oic  WHERE id = ?";
		$campo = 'nombre';
		$idArea = $usuario['id_sub_oic'];
	}
} else {
	// Nombre de Direccion
	$sqlArea = "SELECT nombre_direccion FROM direcciones_secoem WHERE id_direccion = ?";
	$campo = 'nombre_direccion';
	$idArea = $usuario['id_direccion1'];
}

$stmtArea = $conexion->prepare($sqlArea);
$stmtArea->bind_param("i", $idArea);
$stmtArea->execute();

$resultadoArea = $stmtArea->get_result();
$area = $resultadoArea->fetch_assoc();

$nom_dir = $area[$campo] ?? '';

$rutaImagen = "../../images/usuarios/universal.png";

$sqlImagen = "SELECT ruta FROM imagenes_usuario WHERE id_usuario1 = ? LIMIT 1";
$stmtImagen = $conexion->prepare($sqlImagen);
$stmtImagen->bind_param("i", $usuario['id_usuario']);
$stmtImagen->execute();

$resultadoImagen = $stmtImagen->get_result();
if ($resultadoImagen->num_rows > 0) {

	$img = $resultadoImagen->fetch_assoc();
	$rutaImagen = $img['ruta'];
}

session_regenerate_id(true);

$_SESSION['nombre'] = $usuario['nombre_usr'] . ' ' . $usuario['app'];
$_SESSION['nombre_direccion'] = $nom_dir;
$_SESSION['id_direccion'] = $usuario['id_direccion1'];
$_SESSION['id_usuario'] = $usuario['id_usuario'];
$_SESSION['nivel_acceso'] = $usuario['nivel_acces'];
$_SESSION['subdireccion'] = $usuario['id_sub_oic'];
$_SESSION['depto'] = $usuario['id_dep'];
$_SESSION['oficina'] = $usuario['id_oficina'];
$_SESSION['activo'] = $usuario['is_active'];
$_SESSION['ruta'] = $rutaImagen;
$_SESSION['usuario'] = $usuario['nick_name'];

switch ($usuario['nivel_acces']) {

	case 1:
		$_SESSION['nombre_acceso'] = 'Capturista';
		break;

	case 2:
		$_SESSION['nombre_acceso'] = 'Administrador';
		break;
}


if ($esTextoPlano) {
	$_SESSION['forzar_cambio_password'] = true;
}

$direccion = (int) $usuario['id_direccion1'];
$rol = (int) $usuario['nivel_acces'];


if ($direccion == 0) {

	if ($rol == 1) {

		header('Location: ../correspondencia.php');
	} elseif ($rol == 3 || $rol == 4) {

		header('Location: ../ofnasrio/vistas/oficiosrio.php');
	} elseif ($rol == 2) {

		header('Location: ../vistas/Direcciones/dashboard.php?collapse=0&li=1');
	}
} elseif ($direccion == 2) {

	if ($rol == 2) {

		header('Location: ../vistas/Particular/index.php?collapse=1&li=1');
	} else {

		header('Location: ../vistas/Direcciones/index.php?collapse=1&li=1');
	}
} else {

	if ($rol == 2) {

		header('Location: ../vistas/Direcciones/index.php?collapse=1&li=1');
	} else {

		header('Location: ../vistas/Direcciones/index.php?collapse=1&li=1');
	}
}

exit;















/*
if (isset($_POST['PassC']) and isset($_POST['UserC'])) { //Comprobar si una variable está definida
	include('conexion.php');

	$nombreUsuario = mysqli_real_escape_string($conexion,  $_POST['UserC']); // elimiar caracteres para evitar inyecciones sql
	$contrasenaUsuario = mysqli_real_escape_string($conexion, $_POST['PassC']);

	$ComprobacionNombre = $conexion->query("SELECT * FROM usuarios WHERE nick_name ='$nombreUsuario' "); // consulta base de datos

	$NumeroRegistros = mysqli_fetch_assoc($ComprobacionNombre);

	if ($NumeroRegistros > 0) {

		$consulta_contrasena = mysqli_query($conexion, "SELECT contrasena_usr FROM usuarios WHERE contrasena_usr= '$contrasenaUsuario'"); // otra forma		
		$obtener_datos = mysqli_fetch_assoc($consulta_contrasena); // obtenemos los datos en un index

		if ($obtener_datos > 0) {

			//vamos a sacar el nombre de la direccion
			$id_direccion = $NumeroRegistros['id_direccion1'];
			$consulta_direccion = mysqli_query($conexion, "SELECT nombre_direccion  FROM direcciones_secoem WHERE id_direccion='$id_direccion'");
			$row_direccion = mysqli_fetch_assoc($consulta_direccion);
			if ($NumeroRegistros['id_sub_oic'] != 0) {

				if ($NumeroRegistros['id_oficina'] != 0) { //es Oficina

					$oficina = $NumeroRegistros['id_oficina'];
					$consulta_depto = mysqli_query($conexion, "SELECT nombre  FROM oficinas WHERE id='$oficina'");
					$row_depto = mysqli_fetch_assoc($consulta_depto);
					$nom_dir = $row_depto['nombre'];
					var_dump($nom_dir);
				} elseif ($NumeroRegistros['id_dep'] != 0) { //es departamento

					$depto = $NumeroRegistros['id_dep'];
					$consulta_depto = mysqli_query($conexion, "SELECT nombre_depto  FROM departamentos WHERE id='$depto'");
					$row_depto = mysqli_fetch_assoc($consulta_depto);
					$nom_dir = $row_depto['nombre_depto'];
				} else { //es subdireccion
					$subdireccion = $NumeroRegistros['id_sub_oic'];
					$consulta_subdireccion = mysqli_query($conexion, "SELECT nombre  FROM subdirecciones_oic WHERE id='$subdireccion'");
					$row_subdireccion = mysqli_fetch_assoc($consulta_subdireccion);
					$nom_dir = $row_subdireccion['nombre'];
				}
			} else { // es direccion
				$nom_dir = $row_direccion['nombre_direccion'];
			}

			// variables de sesion 
			$_SESSION['nombre'] = $NumeroRegistros['nombre_usr'] . ' ' . $NumeroRegistros['app'];
			$_SESSION['nombre_direccion'] = $nom_dir;
			$_SESSION['id_direccion'] = $NumeroRegistros['id_direccion1'];
			$_SESSION['id_usuario'] = $NumeroRegistros['id_usuario'];
			$_SESSION['nivel_acceso'] = $NumeroRegistros['nivel_acces'];
			$_SESSION['subdireccion'] = $NumeroRegistros['id_sub_oic'];
			$_SESSION['depto'] = $NumeroRegistros['id_dep'];
			$_SESSION['oficina'] = $NumeroRegistros['id_oficina'];
			$id_usuario = $NumeroRegistros['id_usuario'];

			switch ($_SESSION['nivel_acceso']) {
				case 1:
					$_SESSION['nombre_acceso'] = "Capturista";
					break;

				case 2:
					$_SESSION['nombre_acceso'] = "Administrador";
					break;
			}
			//imagen usuario *************
			$consulta_imagen = mysqli_query($conexion, "SELECT * FROM imagenes_usuario WHERE id_usuario1='$id_usuario'");
			//imagen usuario ***********
			if (mysqli_num_rows($consulta_imagen) > 0) {

				$consulta_img = mysqli_query($conexion, "SELECT * FROM imagenes_usuario WHERE id_usuario1 = '$id_usuario';");
				$row_imagen = mysqli_fetch_assoc($consulta_img);
				$ruta = $row_imagen['ruta'];
				$_SESSION['ruta'] = $ruta;
			} else {

				$_SESSION['ruta'] = '../../images/usuarios/universal.png';
			}

			if ($NumeroRegistros['id_direccion1'] == 0) {     //OFICIALIA

				if ($NumeroRegistros['nivel_acces'] == 1) {
					header('Location:../correspondencia.php');
				} elseif ($NumeroRegistros['nivel_acces'] == 3 or $NumeroRegistros['nivel_acces'] == 4) {
					header('Location:../ofnasrio/vistas/oficiosrio.php');
				}
			} elseif ($NumeroRegistros['id_direccion1'] == 2) {  //PARTICULAR

				if ($NumeroRegistros['nivel_acces'] == 2) {
					header('Location:../vistas/Particular/index.php?collapse=1&li=1');
				} else {
					header('Location:../vistas/Direcciones/index.php?collapse=1&li=1');
				}
			} else {                                            //DIRECCIONES

				if ($NumeroRegistros['nivel_acces'] == 2) {

					if ($NumeroRegistros['id_direccion1'] == 0) {
						header('Location:../vistas/Direcciones/dashboard.php?collapse=0&li=1');
					} else {
						header('Location:../vistas/Direcciones/index.php?collapse=1&li=1');
					}
				} else {
					header('Location:../vistas/Direcciones/index.php?collapse=1&li=1');
				}
			}



			//	print("bienvenido validar");
		} else {

			echo "<script type='text/javascript'>alert('Los datos son incorrectos ');</script>";
			echo "<script type='text/javascript'>window.location.href='../';</script>";
			// print('Los datos son incorrectos <br>
			//	<a href="../index.php">volver </a>');
		}
	} else {
		echo "<script type='text/javascript'>alert('Los datos son incorrectos ');</script>";
		echo "<script type='text/javascript'>window.location.href='../';</script>";
	}
} else {
	header('../vistas/login.php');
}

*/