<?php
session_start();
require_once('../conexion/conexion.php');

// Validar id del usuario.
$id_usuario = filter_var($_SESSION['id_usuario'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;

// Verificar que hay sesión activa
if ($id_usuario === 0) {
    header('Location: ../');
    exit;
}


// Verificar que realmente se requiere el cambio
if (empty($_SESSION['forzar_cambio_password'])) {
    header('Location: ../');
    exit;
}



$nueva     = isset($_POST['nueva']) ? trim($_POST['nueva']) : '';
$confirmar = isset($_POST['confirmar']) ? trim($_POST['confirmar']) : '';

if ($nueva === '') {
    $_SESSION['error_pasword'] = 'El campo nueva contraseña es obligatorio.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (mb_strlen($nueva) < 6 || mb_strlen($nueva) > 12) {
    $_SESSION['error_pasword'] = 'La nueva contraseña debe tener entre 6 y 12 caracteres.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if (!preg_match('/[A-Z]/', $nueva) || !preg_match('/[a-z]/', $nueva) || !preg_match('/[0-9]/', $nueva)) {
    $_SESSION['error_pasword'] = 'La nueva contraseña debe contener al menos una mayúscula, una minúscula y un número.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($nueva != $confirmar) {
    $_SESSION['error_pasword'] = 'Las contraseñas no coinciden.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}


$hash_passoword = password_hash($nueva, PASSWORD_BCRYPT);

$sqlUpdate = "UPDATE usuarios SET contrasena_usr = ?  WHERE id_usuario = ?";
$stmtUpdate = $conexion->prepare($sqlUpdate);
$stmtUpdate->bind_param(
    "si",
    $hash_passoword,
    $id_usuario
);

$resultado = $stmtUpdate->execute();
$stmtUpdate->close();

if ($resultado) {

    unset($_SESSION['forzar_cambio_password']);
    $_SESSION['password_actualizado'] = true;
    $_SESSION['exito'] = 'La nueva contraseña se actualizo correctamente.';

    $direccion = (int) $_SESSION['id_direccion'];
    $rol       = (int) $_SESSION['nivel_acceso'];

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

} else {
    $_SESSION['errores']['general'] = 'Error al actualizar la neuva contraseña.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
