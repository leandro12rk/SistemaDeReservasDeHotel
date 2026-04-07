<?php
function loadEnv($path) {
    if (!file_exists($path)) {
        echo "Error: El archivo .env no existe en la ruta: $path";
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}


// VARIABLES GLOBALES
define('SITE_NAME', getenv('WEB_NAME'));
//VARIABLES DEL CORREO
define('EMAIL_PASS', getenv('EMAIL_PASS'));
define('EMAIL_SENDER', getenv('EMAIL_SENDER'));
define('EMAIL_HOST', getenv('EMAIL_HOST'));
define('BASE_URL', getenv('BASE_URL'));
date_default_timezone_set('America/Panama'); // Configura la zona horaria para Panamá
?>