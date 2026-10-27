<?php
include_once('../../php/conexion.php');
require_once __DIR__ . '/../../php/auth/verificar_auth.php';
verificar_permiso('usuarios.editar');

header('Content-Type: application/json');


// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido"
    ]);
    exit;
}

// Validar id del usuario.
$id_usuario = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;

if ($id_usuario <= 0) {
    echo json_encode([
        "status"  => "error",
        "message" => "ID de usuario inválido"
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

// ─── Detectar flujo ───────────────────────────────────────────────────────────
$tiene_direccion = isset($_POST['direccion1_edit']);

if (!$tiene_direccion) {
    echo json_encode([
        "status"  => "error",
        "message" => "Debe seleccionar una Dirección"
    ]);
    exit;
}

// ─── Variables de actualización ──────────────────────────────────────────────
$id_direccion = 0;
$id_sub_oic   = 0;
$id_dep       = 0;
$rol          = 0;

// ─── Campos generales obligatorios ───────────────────────────────────────────
$campos = [
    'nombres_edit'   => ['label' => 'Nombre',            'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'app_edit'       => ['label' => 'Apellido paterno',  'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'apm_edit'       => ['label' => 'Apellido materno',  'min' => 4, 'max' => 60, 'tipo' => 'nombre'],
    'nick_name_edit' => ['label' => 'Nombre de usuario', 'min' => 5, 'max' => 30, 'tipo' => 'nick'],
];

// Contraseña opcional al editar
$cambiar_password = isset($_POST['password_edit']) && trim($_POST['password_edit']) !== '';

if ($cambiar_password) {
    $campos['password_edit'] = ['label' => 'Contraseña', 'min' => 6, 'max' => 12, 'tipo' => 'password'];
}

$direcciones_validos = ids_direcciones($conexion);

if (empty($direcciones_validos)) {
    echo json_encode([
        "status"  => "error",
        "message" => "No hay Direcciones disponibles, no se puede guardar el registro"
    ]);
    exit;
}

if ($_POST['direccion1_edit'] === '') {
    echo json_encode([
        "status"  => "error",
        "message" => "Debe seleccionar una Dirección"
    ]);
    exit;
}

if (!isset($_POST['roles_edit']) || $_POST['roles_edit'] === '') {
    echo json_encode([
        "status"  => "error",
        "message" => "Debe seleccionar un Rol"
    ]);
    exit;
}

// Cargar subdirecciones filtradas por la dirección seleccionada
$id_dir_seleccionada    = (int) $_POST['direccion1_edit'];
$subdirecciones_validos = ids_subdirecciones($conexion, $id_dir_seleccionada);

// Normalizar subdireccion1_edit ANTES de calcular departamentos
if (!isset($_POST['subdireccion1_edit']) || $_POST['subdireccion1_edit'] === '') {
    $_POST['subdireccion1_edit'] = 0;
}

// Cargar departamentos filtrados por la subdirección seleccionada
$id_sub_seleccionada = (int) $_POST['subdireccion1_edit'];

if ($id_sub_seleccionada > 0) {
    $departamentos_validos = ids_departamentos($conexion, $id_sub_seleccionada);
} else {
    $departamentos_validos       = [];
    $_POST['departamento1_edit'] = 0;
}

// Normalizar departamento1_edit si viene vacío
if (!isset($_POST['departamento1_edit']) || $_POST['departamento1_edit'] === '') {
    $_POST['departamento1_edit'] = 0;
}

// Campos para validación
$campos['direccion1_edit']    = ['label' => 'Dirección',    'tipo' => 'select_cero',     'opciones' => $direcciones_validos];
$campos['subdireccion1_edit'] = ['label' => 'Subdirección', 'tipo' => 'select_nullable', 'opciones' => $subdirecciones_validos];
$campos['departamento1_edit'] = ['label' => 'Departamento', 'tipo' => 'select_nullable', 'opciones' => $departamentos_validos];
$campos['roles_edit']         = ['label' => 'Rol',          'tipo' => 'radio',           'opciones' => [1, 2]];

// Variables de actualización
$id_direccion = filter_var($_POST['direccion1_edit'],    FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) ?: 0;
$id_sub_oic   = filter_var($_POST['subdireccion1_edit'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
$id_dep       = filter_var($_POST['departamento1_edit'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;
$rol          = filter_var($_POST['roles_edit'],         FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: 0;

// ─── Validar todos los campos ─────────────────────────────────────────────────
foreach ($campos as $campo => $reglas) {

    $valor = trim($_POST[$campo] ?? '');

    // SELECT NULLABLE: vacío o 0 se acepta directamente
    if ($reglas['tipo'] === 'select_nullable') {

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

// ─── Validar complejidad de contraseña si se envió ───────────────────────────
if ($cambiar_password) {
    $pwd_raw = trim($_POST['password_edit']);

    if (!preg_match('/[A-Z]/', $pwd_raw) || !preg_match('/[a-z]/', $pwd_raw) || !preg_match('/[0-9]/', $pwd_raw)) {
        echo json_encode([
            "status"  => "error",
            "message" => "La contraseña debe contener al menos una mayúscula, una minúscula y un número"
        ]);
        exit;
    }
}

// ─── Sanitizar datos ─────────────────────────────────────────────────────────
$nombre   = htmlspecialchars(strip_tags(trim($_POST['nombres_edit'])),   ENT_QUOTES, 'UTF-8');
$app      = htmlspecialchars(strip_tags(trim($_POST['app_edit'])),       ENT_QUOTES, 'UTF-8');
$apm      = htmlspecialchars(strip_tags(trim($_POST['apm_edit'])),       ENT_QUOTES, 'UTF-8');
$nickname = htmlspecialchars(strip_tags(trim($_POST['nick_name_edit'])), ENT_QUOTES, 'UTF-8');

// ─── Verificar que el usuario existe ─────────────────────────────────────────
$sqlCheck = "SELECT id_usuario, nick_name FROM usuarios WHERE id_usuario = ? LIMIT 1";
$stmtCheck = $conexion->prepare($sqlCheck);
$stmtCheck->bind_param("i", $id_usuario);
$stmtCheck->execute();
$usuarioActual = $stmtCheck->get_result()->fetch_assoc();
$stmtCheck->close();

if (!$usuarioActual) {
    echo json_encode([
        "status"  => "error",
        "message" => "Usuario no encontrado"
    ]);
    exit;
}

// ─── Verificar duplicado de nick_name excluyendo al usuario actual ────────────
if ($nickname !== $usuarioActual['nick_name']) {

    $sqlCheckNick = "SELECT id_usuario FROM usuarios WHERE nick_name = ? AND id_usuario != ? LIMIT 1";
    $stmtCheckNick = $conexion->prepare($sqlCheckNick);
    $stmtCheckNick->bind_param("si", $nickname, $id_usuario);
    $stmtCheckNick->execute();
    $stmtCheckNick->store_result();
    $usuarioDuplicado = $stmtCheckNick->num_rows > 0;
    $stmtCheckNick->close();

    if ($usuarioDuplicado) {
        echo json_encode([
            "status"  => "error",
            "message" => "El nombre de usuario ya está en uso. Intenta con otro."
        ]);
        exit;
    }
}

// ─── Actualizar usuario ───────────────────────────────────────────────────────
if ($cambiar_password) {

    $hash_password = password_hash(trim($_POST['password_edit']), PASSWORD_BCRYPT);

    $sql = "UPDATE usuarios SET
                nombre_usr     = ?,
                app            = ?,
                apm            = ?,
                nick_name      = ?,
                contrasena_usr = ?,
                id_direccion1  = ?,
                nivel_acces    = ?,
                id_sub_oic     = ?,
                id_dep         = ?
            WHERE id_usuario = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "sssssiiiii",
        $nombre,
        $app,
        $apm,
        $nickname,
        $hash_password,
        $id_direccion,
        $rol,
        $id_sub_oic,
        $id_dep,
        $id_usuario
    );
} else {

    $sql = "UPDATE usuarios SET
                nombre_usr    = ?,
                app           = ?,
                apm           = ?,
                nick_name     = ?,
                id_direccion1 = ?,
                nivel_acces   = ?,
                id_sub_oic    = ?,
                id_dep        = ?
            WHERE id_usuario = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param(
        "ssssiiiii",
        $nombre,
        $app,
        $apm,
        $nickname,
        $id_direccion,
        $rol,
        $id_sub_oic,
        $id_dep,
        $id_usuario
    );
}

$resultado = $stmt->execute();
$stmt->close();

if ($resultado) {
    echo json_encode([
        "status"  => "success",
        "message" => "Usuario actualizado correctamente"
    ]);
} else {
    echo json_encode([
        "status"  => "error",
        "message" => "No se pudo actualizar el usuario"
    ]);
}
