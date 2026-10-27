<?php
require_once("../conexion.php");
require_once __DIR__ . '/../../php/auth/verificar_auth.php';
verificar_permiso('usuarios.obtener');
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido"
    ]);
    exit;
}

$id_usuario = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id_usuario <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "ID inválido"
    ]);
    exit;
}

$sql = "
    SELECT 
        id_usuario, 
        nombre_usr AS nombres,
        app AS apellido_paterno, 
        apm AS apellido_materno,
        nick_name AS nombre_usuario,
        nivel_acces AS rol,
        id_direccion1 AS id_direccion,
        id_sub_oic AS id_subdireccion, 
        id_dep
    FROM usuarios 
    WHERE id_usuario = ? LIMIT 1";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$usuario) {
    echo json_encode([
        "success" => false,
        "message" => "Usuario no encontrado"
    ]);
    exit;
}

echo json_encode([
    "success" => true,
    "data" => $usuario
]);
