<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const PERMISOS = [
    'admin'        => ['usuarios.ver', 'usuarios.crear', 'usuarios.obtener', 'usuarios.editar', 'usuarios.eliminar'],
    'direccion'    => ['usuarios.ver', 'usuarios.crear', 'usuarios.eliminar'],
    'subdireccion' => ['usuarios.ver', 'usuarios.crear'],
];

function verificar_sesion(): void
{
    if (empty($_SESSION['id_usuario'])) {
        responder_no_autorizado(es_peticion_ajax(), 401, 'Sesión expirada', '/login.php');
    }
}

function verificar_permiso(string $operacion): void
{
    verificar_sesion();

    $rol     = obtener_rol_sesion();
    $es_ajax = es_peticion_ajax();

    if ($rol === null) {
        responder_no_autorizado($es_ajax, 403, 'Rol no reconocido');
    }

    if (!in_array($operacion, PERMISOS[$rol], true)) {
        responder_no_autorizado($es_ajax, 403, "Sin permiso para: {$operacion}");
    }
}

function obtener_rol_sesion(): ?string
{
    $id_direccion = (int) ($_SESSION['id_direccion'] ?? 0);
    $rol = (int) ($_SESSION['nivel_acceso'] ?? 0);
    $activo = (int) ($_SESSION['activo'] ?? 0);
    $id_subdireccion = (int) ($_SESSION['subdireccion'] ?? 0);

    if ($id_direccion === 8888 && $rol === 2 && $id_subdireccion === 0 && $activo === 1) {
        return 'admin';
    }
    if ($id_direccion !== 8888 && $rol === 2 && $id_subdireccion === 0 && $activo === 1) {
        return 'direccion';
    }
    if ($id_direccion !== 8888 && $rol === 2 && $id_subdireccion > 0 && $activo === 1) {
        return 'subdireccion';
    }

    return null;
}

function es_peticion_ajax(): bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function responder_no_autorizado(
    bool   $es_ajax,
    int    $codigo,
    string $mensaje,
    string $redirect = ''
): void {
    http_response_code($codigo);

    if ($es_ajax) {
        header('Content-Type: application/json');
        $payload = ['error' => $mensaje];
        if ($redirect) $payload['redirect'] = $redirect;
        echo json_encode($payload);
        exit;
    }

    header('Location: ' . ($redirect ?: '/login.php'));
    exit;
}
