<?php
$repoPath = '/var/www/Entregas_IT/public'; // Ruta de tu repositorio local

$secret = 'ELmaster120815'; // Secreto compartido con GitHub para verificar las solicitudes

$signature = $_SERVER['HTTP_X_HUB_SIGNATURE'] ?? '';
$body = file_get_contents('php://input');

$expectedSignature = 'sha1=' . hash_hmac('sha1', $body, $secret);

if (hash_equals($signature, $expectedSignature)) {
    // Validación exitosa, se recibió una solicitud válida desde GitHub

    // Ejecutar el comando git pull
    $output = shell_exec("cd $repoPath && git pull origin main 2>&1");

    // Registrar el resultado
    file_put_contents('webhook_log.txt', $output, FILE_APPEND);

    http_response_code(200);
    echo "Actualización exitosa.";
} else {
    http_response_code(403);
    echo "Firma inválida.";
}
?>
