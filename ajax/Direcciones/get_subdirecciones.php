<?php
require_once("../conexion.php");
require_once __DIR__ . '/../../php/auth/verificar_auth.php';
verificar_permiso('usuarios.crear'); 
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "success" => false,
        "message" => "Método no permitido"
    ]);
    exit;
}

$id_direccion = isset($_GET['id_direccion']) ? (int) $_GET['id_direccion'] : 0;

if ($id_direccion <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "ID inválido"
    ]);
    exit;
}

$sql  = "SELECT id AS id_subdireccion, nombre AS nombre_subdireccion FROM subdirecciones_oic WHERE id_direccion1 = ? ORDER BY id ASC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_direccion);
$stmt->execute();
$resultado = $stmt->get_result();

$subdirecciones = [];
while ($fila = $resultado->fetch_assoc()) {
    $subdirecciones[] = [
        'id'     => $fila['id_subdireccion'],
        'nombre' => $fila['nombre_subdireccion']
    ];
}

$stmt->close();
$conexion->close();

echo json_encode([
    'success' => true,
    "data" => $subdirecciones
]);
