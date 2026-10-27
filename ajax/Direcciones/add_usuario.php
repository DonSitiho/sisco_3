<?php
include_once('../../php/conexion.php');
require_once __DIR__ . '/../../php/auth/verificar_auth.php';
verificar_permiso('usuarios.crear');
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido"
    ]);
    exit;
}

function ids_direcciones(mysqli $conn): array
{
    $resultado = $conn->query("SELECT id_direccion FROM direcciones_secoem");
    $ids = [];
    while ($fila = $resultado->fetch_assoc()) {
        $ids[] = (int) $fila['id_direccion'];
    }
    return $ids;
}

function ids_subdirecciones(mysqli $conn, int $id_direccion): array
{
    $stmt = $conn->prepare("SELECT id FROM subdirecciones_oic WHERE id_direccion1 = ?");
    $stmt->bind_param("i", $id_direccion);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $ids = [];
    while ($fila = $resultado->fetch_assoc()) {
        $ids[] = (int) $fila['id'];
    }
    $stmt->close();
    return $ids;
}

function ids_departamentos(mysqli $conn, int $id_subdireccion): array
{
    $stmt = $conn->prepare("SELECT id FROM departamentos WHERE id_sub_oic = ?");
    $stmt->bind_param("i", $id_subdireccion);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $ids = [];
    while ($fila = $resultado->fetch_assoc()) {
        $ids[] = (int) $fila['id'];
    }
    $stmt->close();
    return $ids;
}

// ─── Detectar qué flujo se envió ─────────────────────────────────────────────
$tiene_direccion    = isset($_POST['direccion1']);
$tiene_subdireccion = isset($_POST['subdireccion']);
$tiene_departamento = isset($_POST['departamento']);


// ─── Campos generales obligatorios ───────────────────────────────────────────
$campos = [
    'nombres'   => ['label' => 'Nombre',            'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'app'       => ['label' => 'Apellido paterno',  'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'apm'       => ['label' => 'Apellido materno',  'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'nick_name' => ['label' => 'Nombre de usuario', 'min' => 5, 'max' => 30, 'tipo' => 'nick'],
    'password'  => ['label' => 'Contraseña',        'min' => 6, 'max' => 12, 'tipo' => 'password'],
];

// ─── Variables de inserción ───────────────────────────────────────────────────
$id_direccion = filter_var($_SESSION['id_direccion'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
$id_sub_oic   = 0;
$id_dep       = 0;
$rol          = 0;

// ─── Flujo Dirección ─────────────────────────────────────────────────────────
if ($tiene_direccion) {

    $direcciones_validos = ids_direcciones($conexion);

    if (empty($direcciones_validos)) {
        echo json_encode([
            "status"  => "error",
            "message" => "No hay Direcciones disponibles, no se puede guardar el registro"
        ]);
        exit;
    }

    if ($_POST['direccion1'] === '') {
        echo json_encode([
            "status"  => "error",
            "message" => "Debe seleccionar una Dirección"
        ]);
        exit;
    }

    if (!isset($_POST['roles']) || $_POST['roles'] === '') {
        echo json_encode([
            "status"  => "error",
            "message" => "Debe seleccionar un Rol"
        ]);
        exit;
    }

    // Cargar subdirecciones filtradas por la dirección seleccionada
    $id_dir_seleccionada   = (int) $_POST['direccion1'];
    $subdirecciones_validos = ids_subdirecciones($conexion, $id_dir_seleccionada);

    if (!isset($_POST['subdireccion1']) || $_POST['subdireccion1'] === '') {
        $_POST['subdireccion1'] = 0;
    }

    // Cargar departamentos filtrados por la subdirección seleccionada
    $id_sub_seleccionada  = (int) ($_POST['subdireccion1'] ?? 0);
    if ($id_sub_seleccionada > 0) {
        $departamentos_validos = ids_departamentos($conexion, $id_sub_seleccionada);
    } else {
        // Sin subdirección seleccionada, departamento no aplica
        $departamentos_validos  = [];
        $_POST['departamento1'] = 0;
    }

    if (!isset($_POST['departamento1']) || $_POST['departamento1'] === '') {
        $_POST['departamento1'] = 0;
    }

    // Campos para validación
    $campos['direccion1']    = ['label' => 'Dirección',    'tipo' => 'select_cero',     'opciones' => $direcciones_validos];
    $campos['subdireccion1'] = ['label' => 'Subdirección', 'tipo' => 'select_nullable', 'opciones' => $subdirecciones_validos];
    $campos['departamento1'] = ['label' => 'Departamento', 'tipo' => 'select_nullable', 'opciones' => $departamentos_validos];
    $campos['roles']         = ['label' => 'Rol',          'tipo' => 'radio',           'opciones' => [1, 2]];

    // Variables de inserción
    $id_direccion = filter_var($_POST['direccion1'],    FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
    $id_sub_oic   = filter_var($_POST['subdireccion1'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
    $id_dep       = filter_var($_POST['departamento1'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
    $rol          = filter_var($_POST['roles'],         FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;

    // ─── Flujo Subdirección ───────────────────────────────────────────────────────
} elseif ($tiene_subdireccion) {

    // Subdirecciones filtradas por la dirección del usuario logueado
    $subdirecciones_validos = ids_subdirecciones($conexion, (int)($_SESSION['id_direccion'] ?? 0));

    if (empty($subdirecciones_validos)) {
        echo json_encode([
            "status"  => "error",
            "message" => "No hay Subdirecciones disponibles, no se puede guardar el registro"
        ]);
        exit;
    }

    if ($_POST['subdireccion'] === '') {
        echo json_encode([
            "status"  => "error",
            "message" => "Debe seleccionar una Subdirección"
        ]);
        exit;
    }

    $_POST['roles'] = 1;

    // Campos para validación
    $campos['subdireccion'] = ['label' => 'Subdirección', 'tipo' => 'select', 'opciones' => $subdirecciones_validos];
    $campos['roles']        = ['label' => 'Rol',          'tipo' => 'radio',  'opciones' => [1]];

    // Variables de inserción
    $id_sub_oic = filter_var($_POST['subdireccion'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
    $rol        = 1;

    // ─── Flujo Departamento ───────────────────────────────────────────────────────
} elseif ($tiene_departamento) {

    // Departamentos filtrados por la subdirección del usuario logueado
    $departamentos_validos = ids_departamentos($conexion, (int)($_SESSION['depto'] ?? 0));

    if (empty($departamentos_validos)) {
        echo json_encode([
            "status"  => "error",
            "message" => "No hay Departamentos disponibles, no se puede guardar el registro"
        ]);
        exit;
    }

    if ($_POST['departamento'] === '') {
        echo json_encode([
            "status"  => "error",
            "message" => "Debe seleccionar un Departamento"
        ]);
        exit;
    }

    $_POST['roles'] = 1;

    // Campos para validación
    $campos['departamento'] = ['label' => 'Departamento', 'tipo' => 'select', 'opciones' => $departamentos_validos];
    $campos['roles']        = ['label' => 'Rol',          'tipo' => 'radio',  'opciones' => [1]];

    // Variables de inserción
    $id_sub_oic = filter_var($_SESSION['subdireccion'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
    $id_dep     = filter_var($_POST['departamento'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
    $rol        = 1;
}

// ─── Validar todos los campos ─────────────────────────────────────────────────
foreach ($campos as $campo => $reglas) {

    $valor = trim($_POST[$campo] ?? '');

    // SELECT NULLABLE: vacío = 0, válido sin error
    if ($reglas['tipo'] === 'select_nullable') {

        // Si viene vacío o 0 se acepta directamente
        if ($valor === '' || $valor === '0' || (int)$valor === 0) {
            continue;
        }

        if (!filter_var($valor, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': el valor enviado no es válido"
            ]);
            exit;
        }

        if (!in_array((int)$valor, $reglas['opciones'], true)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': la opción seleccionada no existe"
            ]);
            exit;
        }

        continue;
    }

    // SELECT CERO: puede valer 0 o un ID real
    if ($reglas['tipo'] === 'select_cero') {

        if ($valor === '') {
            echo json_encode([
                "status"  => "error",
                "message" => "El campo '{$reglas['label']}' es obligatorio"
            ]);
            exit;
        }

        if (!filter_var($valor, FILTER_VALIDATE_INT) && $valor !== '0') {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': el valor enviado no es válido"
            ]);
            exit;
        }

        if ((int)$valor === 0) {
            continue;
        }

        if (!in_array((int)$valor, $reglas['opciones'], true)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': la opción seleccionada no existe"
            ]);
            exit;
        }

        continue;
    }

    if ($valor === '') {
        echo json_encode([
            "status"  => "error",
            "message" => "El campo '{$reglas['label']}' es obligatorio"
        ]);
        exit;
    }

    // SELECT normal
    if ($reglas['tipo'] === 'select') {

        if (!filter_var($valor, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': el valor enviado no es válido"
            ]);
            exit;
        }

        if (!in_array((int)$valor, $reglas['opciones'], true)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': la opción seleccionada no existe"
            ]);
            exit;
        }

        continue;
    }

    // RADIO
    if ($reglas['tipo'] === 'radio') {

        if (!filter_var($valor, FILTER_VALIDATE_INT)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': el valor enviado no es válido"
            ]);
            exit;
        }

        if (!in_array((int)$valor, $reglas['opciones'], true)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}': la opción seleccionada no existe"
            ]);
            exit;
        }

        continue;
    }

    // Validar longitud
    if (mb_strlen($valor) < $reglas['min']) {
        echo json_encode([
            "status"  => "error",
            "message" => "'{$reglas['label']}' debe tener al menos {$reglas['min']} caracteres"
        ]);
        exit;
    }

    if (mb_strlen($valor) > $reglas['max']) {
        echo json_encode([
            "status"  => "error",
            "message" => "'{$reglas['label']}' no puede exceder {$reglas['max']} caracteres"
        ]);
        exit;
    }

    // Validar formato
    if ($reglas['tipo'] === 'nombre') {
        if (!preg_match('/^[\p{L}\s]+$/u', $valor)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}' solo puede contener letras y espacios"
            ]);
            exit;
        }
    }

    if ($reglas['tipo'] === 'nick') {
        if (!preg_match('/^[a-zA-Z0-9]{5,30}$/', $valor)) {
            echo json_encode([
                "status"  => "error",
                "message" => "'{$reglas['label']}' solo permite letras y números"
            ]);
            exit;
        }
    }
}

// ─── Validar complejidad de contraseña ───────────────────────────────────────
$pwd_raw = trim($_POST['password']);

if (!preg_match('/[A-Z]/', $pwd_raw) || !preg_match('/[a-z]/', $pwd_raw) || !preg_match('/[0-9]/', $pwd_raw)) {
    echo json_encode([
        "status"  => "error",
        "message" => "La contraseña debe contener al menos una mayúscula, una minúscula y un número"
    ]);
    exit;
}

// ─── Sanitizar datos ─────────────────────────────────────────────────────────
$nombre        = htmlspecialchars(strip_tags(trim($_POST['nombres'])),   ENT_QUOTES, 'UTF-8');
$app           = htmlspecialchars(strip_tags(trim($_POST['app'])),       ENT_QUOTES, 'UTF-8');
$apm           = htmlspecialchars(strip_tags(trim($_POST['apm'])),       ENT_QUOTES, 'UTF-8');
$nickname      = htmlspecialchars(strip_tags(trim($_POST['nick_name'])), ENT_QUOTES, 'UTF-8');
$hash_password = password_hash($pwd_raw, PASSWORD_DEFAULT);

// ─── Verificar usuario duplicado ─────────────────────────────────────────────
$sqlSelect = "SELECT id_usuario FROM usuarios WHERE nick_name = ? LIMIT 1";
$stmtSelect = $conexion->prepare($sqlSelect);
$stmtSelect->bind_param("s", $nickname);
$stmtSelect->execute();
$stmtSelect->store_result();
$usuarioDuplicado = $stmtSelect->num_rows > 0;
$stmtSelect->close();

if ($usuarioDuplicado) {
    echo json_encode([
        "status"  => "error",
        "message" => "El usuario ya está registrado. Intenta con otro."
    ]);
    exit;
}

// ─── Insertar nuevo usuario ───────────────────────────────────────────────────
$sqlInsert = "INSERT INTO usuarios 
    (nombre_usr, app, apm, nick_name, contrasena_usr, id_direccion1, nivel_acces, id_sub_oic, id_dep) 
    VALUES 
    (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sqlInsert);
$stmt->bind_param(
    "sssssiiii",
    $nombre,
    $app,
    $apm,
    $nickname,
    $hash_password,
    $id_direccion,
    $rol,
    $id_sub_oic,
    $id_dep
);

$resultado = $stmt->execute();
$stmt->close();

if ($resultado) {
    echo json_encode([
        "status"  => "success",
        "message" => "Usuario registrado correctamente"
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "No se pudo registrar el usuario"
    ]);
}
