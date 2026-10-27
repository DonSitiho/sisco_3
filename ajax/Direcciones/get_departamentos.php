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

$id_subdireccion = isset($_GET['id_subdireccion']) ? (int) $_GET['id_subdireccion'] : 0;

if ($id_subdireccion <= 0) {
    echo json_encode([
        "success" => false,
        "message" => "ID inválido"
    ]);
    exit;
}

$sql = "SELECT id AS id_departamento, nombre_depto AS nombre_departamento FROM departamentos WHERE id_sub_oic = ? ORDER BY id ASC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_subdireccion);
$stmt->execute();
$resultado = $stmt->get_result();

$departamentos = [];
while ($fila = $resultado->fetch_assoc()) {
    $departamentos[] = [
        'id'     => $fila['id_departamento'],
        'nombre' => $fila['nombre_departamento']
    ];
}


$stmt->close();
$conexion->close();

echo json_encode(['success' => true, "data" => $departamentos]);
