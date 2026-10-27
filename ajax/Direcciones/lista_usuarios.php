<?php
require_once("../conexion.php");
require_once __DIR__ . '/../../php/auth/verificar_auth.php';

verificar_permiso('usuarios.ver');
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido"
    ]);
    exit;
}

$id_direccion = (int) ($_SESSION['id_direccion'] ?? 0);
$id_subdireccion = (int) ($_SESSION['subdireccion'] ?? 0);
$rol = (int) ($_SESSION['nivel_acceso'] ?? 0);
$activo = (int) ($_SESSION['activo'] ?? 0);


$sql = "
    SELECT 
        usuarios.id_usuario, usuarios.nombre_usr AS nombre, usuarios.app AS apellido_paterno, usuarios.apm AS apellido_materno, usuarios.nick_name AS usuario, usuarios.is_active AS activo, direcciones_secoem.nombre_direccion, subdirecciones_oic.nombre AS nombre_subdireccion, departamentos.nombre_depto 
    FROM usuarios
    LEFT JOIN direcciones_secoem 
        ON usuarios.id_direccion1 = direcciones_secoem.id_direccion
    LEFT JOIN subdirecciones_oic 
        ON usuarios.id_sub_oic = subdirecciones_oic.id
    LEFT JOIN departamentos 
        ON usuarios.id_dep = departamentos.id
";

// CONDICIÓN SEGÚN NIVEL
$where = [];
$params = [];
$types = "";

if ($id_direccion == 8888 && $rol == 2 && $id_subdireccion == 0 && $activo == 1) {
} elseif ($id_direccion != 8888 && $rol == 2 && $id_subdireccion > 0) {

    $where[] = "usuarios.id_direccion1 = ?";
    $where[] = "usuarios.id_sub_oic = ?";

    $params[] = $id_direccion;
    $params[] = $id_subdireccion;
    $types .= "ii";
} elseif ($id_direccion !== 8888 && $rol === 2 && $id_subdireccion === 0) {
    $where[] = "usuarios.id_direccion1 = ?";

    $params[] = $id_direccion;

    $types .= "i";
}

if (!empty($where)) {

    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY usuarios.id_usuario";

$stmt = $conexion->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$resultado = $stmt->get_result();

$datos = [];

while ($fila = $resultado->fetch_assoc()) {

    // Crear botones dependiendo del rol
    $botones = '';

    if ($id_direccion == 8888 && $rol == 2 && $id_subdireccion == 0) {

        if ($fila['activo'] == 1) {
            $botones .= '
            <button class="btn btn-warning btn-sm rounded-circle btn-editar" data-id="' . $fila['id_usuario'] . '">
                <i class="fa-regular fa-pen-to-square"></i>
            </button>

            <button class="btn btn-danger btn-sm rounded-circle btn-borrar" data-id="' . $fila['id_usuario'] . '">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        ';
        } else {
            $botones .= '
            <button class="btn btn-success btn-sm rounded-circle btn-activar" data-id="' . $fila['id_usuario'] . '">
                <i class="fa-solid fa-check"></i>
            </button>
        ';
        }
    } elseif ($id_direccion !== 8888 && $rol === 2 && $id_subdireccion === 0) {

        if ($fila['activo'] == 1) {
            $botones .= '
            <button class="btn btn-danger btn-sm rounded-circle btn-borrar" data-id="' . $fila['id_usuario'] . '">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        ';
        }
    }

    // Agregar columna acciones
    $fila['acciones'] = $botones;

    $datos[] = $fila;
}

echo json_encode([
    "success" => true,
    "data" => $datos
]);