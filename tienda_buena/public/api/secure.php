<?php
header('Content-Type: application/json');

//Obtiene el encabezado Authorization
$headers = apache_request_headers();
if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(
        [
            'data'  => null,
            'error' => 'Falta el Token de autenticación'
        ]
    );
    exit;
}
// Extrae el token del encabezado
$token = $headers['Authorization'];

// Verifica el token en la base de datos
$stmt = BaseDatos::getConection()->prepare("SELECT user_id FROM auth_tokens WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token]);
$auth = $stmt->fetch();

if (!$auth) {
    //usuario no autorizado
    http_response_code(403);
    echo json_encode([
        'data'  => null,
        'error' => 'Token inválido o expirado'
    ]);
    exit;
}
