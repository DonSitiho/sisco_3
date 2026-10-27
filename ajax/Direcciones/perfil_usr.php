
<?php
require_once('../../conexion/conexion.php');

// Validar id del usuario.
$id_usuario = filter_var($_POST['id_user'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;

if ($id_usuario === 0) {
	header("Location: ../../vistas/Direcciones/perfil_usuario.php");
	exit;
}

$errores = [];
$datos = [];
$exito  = '';

$campos = [
    'nombre_usr'   => ['label' => 'Nombre',            'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'app_usr'       => ['label' => 'Apellido paterno',  'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'apm_usr'       => ['label' => 'Apellido materno',  'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
];

// Contraseña opcional al editar
$cambiar_password = isset($_POST['contraseña_usr']) && trim($_POST['contraseña_usr']) !== '';

if ($cambiar_password) {
    $campos['contraseña_usr'] = ['label' => 'Contraseña', 'min' => 6, 'max' => 12, 'tipo' => 'password'];
}

//Validar todos los campos
foreach ($campos as $campo => $reglas) {

	$valor = trim($_POST[$campo] ?? '');
	$datos[$campo] = $valor;


	if ($valor === '') {
		$errores[$campo] = "El campo '{$reglas['label']}' es obligatorio";
        continue;
    }

	if (mb_strlen($valor) < $reglas['min']) {
		$errores[$campo] = "'{$reglas['label']}' debe tener al menos {$reglas['min']} caracteres";
		continue;
	}

	if (mb_strlen($valor) > $reglas['max']) {
		$errores[$campo] = "'{$reglas['label']}' no puede exceder {$reglas['max']} caracteres";
		continue;
	}

	if ($reglas['tipo'] === 'nombre' && !preg_match('/^[\p{L}\s]+$/u', $valor)) {
		$errores[$campo] = "'{$reglas['label']}' solo puede contener letras y espacios";
		continue;
	}
}

// Validar complejidad de contraseña si se envió.
if ($cambiar_password) {
	$pwd_raw = trim($_POST['contraseña_usr']);

	if (!preg_match('/[A-Z]/', $pwd_raw) || !preg_match('/[a-z]/', $pwd_raw) || !preg_match('/[0-9]/', $pwd_raw)) {
		$errores['contraseña_usr'] = "La contraseña debe contener al menos una mayúscula, una minúscula y un número";	
	}
}

if (!empty($errores)) {
    // Regresar errores y datos a la vista mediante SESSION
    $_SESSION['errores'] = $errores;
    $_SESSION['datos']   = $datos;
    header("Location: ../../vistas/Direcciones/perfil_usuario.php");
    exit;
}

// Sanitizar datos del formulario.
$nombre   = htmlspecialchars(strip_tags(trim($_POST['nombre_usr'])),   ENT_QUOTES, 'UTF-8');
$app      = htmlspecialchars(strip_tags(trim($_POST['app_usr'])),       ENT_QUOTES, 'UTF-8');
$apm      = htmlspecialchars(strip_tags(trim($_POST['apm_usr'])),       ENT_QUOTES, 'UTF-8');

// Verificar que el usuario exista en el sistemna.
$sqlCheck = "SELECT id_usuario, nick_name FROM usuarios WHERE id_usuario = ? LIMIT 1";
$stmtCheck = $conexion->prepare($sqlCheck);
$stmtCheck->bind_param("i", $id_usuario);
$stmtCheck->execute();
$usuarioActual = $stmtCheck->get_result()->fetch_assoc();
$stmtCheck->close();

if (!$usuarioActual){
	die("Usuario no encontrado.");
}

// Actualizar datos del usuario
if ($cambiar_password) {
	$hash_password = password_hash(trim($_POST['contraseña_usr']), PASSWORD_BCRYPT);

	$sqlUpdate = "UPDATE usuarios SET nombre_usr = ?, app = ?, apm = ?, contrasena_usr = ? WHERE id_usuario = ?";

	$stmUpdate = $conexion->prepare($sqlUpdate);
	$stmUpdate->bind_param(
		"ssssi",
		$nombre,
		$app,
		$apm,
		$hash_password,
		$id_usuario
	);	
} else {

	$sqlUpdate = "UPDATE usuarios SET nombre_usr = ?, app = ?, apm = ? WHERE id_usuario = ?";
	$stmUpdate = $conexion->prepare($sqlUpdate);
	$stmUpdate->bind_param(
		"sssi",
		$nombre,
		$app,
		$apm,
		$id_usuario
	);
}

$resultado = $stmUpdate->execute();

if ($resultado) {
	$_SESSION['exito'] = 'Datos actualizados correctamente.';
	
} else {
	$_SESSION['errores']['general'] = 'Error al actualizar los datos.';
	
}

$stmUpdate->close();
header("Location: ../../vistas/Direcciones/perfil_usuario.php");
exit;


/*
if(isset($_POST['id_user']) && isset($_POST['nombre_usr'])){
	require_once('../conexion.php');
    $id=$_POST['id_user'];
    $nombre=$_POST['nombre_usr'];
	$app=$_POST['app_usr'];
	$apm=$_POST['apm_usr'];
	$usuario=$_POST['usuario'];
	$contrasena=$_POST['contraseña_usr'];
 
	$cambiar_datos=mysqli_query($conexion,"UPDATE usuarios SET
	nombre_usr='$nombre',
	app='$app',
	apm='$apm',
	nick_name='$usuario',
	contrasena_usr='$contrasena'
	WHERE id_usuario='$id'");
	
	if(mysqli_affected_rows($conexion)==1){//saber si un campo se modifico o no!
		    
			header("Location: ../../vistas/Direcciones/perfil_usuario.php");
	
	}else{
		header("Location: ../../vistas/Direcciones/perfil_usuario.php");
	}
	
}else{
	header("Location: ../../index.php");
}
*/
?>
