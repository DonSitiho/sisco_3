<?php
require_once("../conexion.php");
require_once __DIR__ . '/../../php/auth/verificar_auth.php';
verificar_permiso('usuarios.eliminar');
header('Content-Type: application/json');

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
    exit;
}

$id_usuario = isset($_POST['id_usuario']) ? (int) $_POST['id_usuario'] : 0;

if ($id_usuario <= 0) {
    echo json_encode(["success" => false, "message" => "ID inválido"]);
    exit;
}


$sql = "SELECT is_active FROM usuarios WHERE id_usuario = ? LIMIT 1";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();

$usuario = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$usuario){
    echo json_encode([
        "success" => false,
        "message" => "Usuario no encontrado"
    ]);

    exit;
}

$estadoActual = (int) $usuario['is_active'];
$nuevoEstado = ($estadoActual === 1) ? 0 : 1;

$slqUpdate = "UPDATE usuarios SET is_active = ? WHERE id_usuario = ?";
$stmtUpdate = $conexion->prepare($slqUpdate);
$stmtUpdate->bind_param("ii", $nuevoEstado, $id_usuario);
$resultado = $stmtUpdate->execute();
$stmtUpdate->close();

if ($resultado) {
    echo json_encode([
        "success" => true,
        "message" => $nuevoEstado === 1 ? "Usuario activado correctamente" : "Usuario desactivado correctamente",
        "estado"  => $nuevoEstado
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Error al actualizar usuario"
    ]);
}

?>