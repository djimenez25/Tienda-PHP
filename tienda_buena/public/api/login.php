<?php
require_once('../../modelos/BaseDatos.php');
header('Content-Type: application/json');
// Conexión a la base de datos

// Lee el JSON de la solicitud
$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['email']) && isset($data['password'])) {
    $email = $data['email'];
    $password = hash("sha256", $data['password']);
} else {
    http_response_code(400);
    echo json_encode(['user' => null, 'token' => '', 'error' => 'Petición incorrecta']);
    //BaseDatos::closeConection();
    exit();
}
/*$email = $data['email'];
$password = hash("sha256", $data['password']);*/

// Busca el usuario en la base de datos
$stmt = BaseDatos::getConection()->prepare("SELECT id, nombre, email, rol_id FROM usuarios WHERE email = ?  and password = ?");
$stmt->execute([$email, $password]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($user) {
    // Eliminar todos los tokens previos de este usuario
    $deleteStmt = BaseDatos::getConection()->prepare("DELETE FROM auth_tokens WHERE user_id = ?");
    $deleteStmt->execute([$user['id']]);

    // Genera un token aleatorio y una fecha de expiración
    $token = bin2hex(random_bytes(32));
    $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Guarda el token en la base de datos
    $stmt = BaseDatos::getConection()->prepare("INSERT INTO auth_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$user['id'], $token, $expires_at]);
    echo json_encode(['user' => $user, 'token' => $token, 'error' => '']);
} else {
    http_response_code(401);
    echo json_encode([
        'user' => null,
        'token' => '',
        'error' => 'Credenciales incorrectas'
    ]);
}

// Cierra la conexión
BaseDatos::closeConection();
