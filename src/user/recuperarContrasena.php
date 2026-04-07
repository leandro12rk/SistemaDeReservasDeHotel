<?php

require_once 'correo.php';
require_once dirname(__DIR__, 2) . '/app/controller/user_controller.php';
include '../function.php';
require_once dirname(__DIR__, 2) . '/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userController = new  UserController();

// aqui debe ir la validacion de  recuperar contraseña
if (isset($_GET['token'])) {
    $toke = $_GET['token'];
    header("Location: " . getenv('BASE_URL'));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Procesar y validar cada campo
    if (isset($_POST['correo_recuperar'])) {

        $correo_recuperar =  $_POST['correo_recuperar'];
        $datosUser = $userController->obtenerTotales($correo_recuperar, 6);

        $token = generarTokenAleatorio();
        $asunto = 'Solicitud de Cambio de Contraseña ';
        $nombre_usuario = "Juan Pérez";

        $link_recuperacion = getenv('BASE_URL') . "/src/user/recuperarContrasena.php?token=" . $token;
        $nombre_empresa = "Sistema Hotel Reservas";
        $link_sitio_web = getenv('BASE_URL');

        $html = file_get_contents(dirname(__DIR__, 2) . '/components/plantillas_correos/recuperar_contrasena.php'); // Carga la plantilla desde un archivo externo
        $html = str_replace('{{nombre_usuario}}', htmlspecialchars($nombre_usuario, ENT_QUOTES, 'UTF-8'), $html);
        $html = str_replace('{{nombre_empresa}}', htmlspecialchars('Sistemas de Reserva', ENT_QUOTES, 'UTF-8'), $html);
        $html = str_replace('{{link_recuperacion}}', htmlspecialchars($link_recuperacion, ENT_QUOTES, 'UTF-8'), $html);
        $html = str_replace('{{sitio_web}}', htmlspecialchars($link_sitio_web, ENT_QUOTES, 'UTF-8'), $html);

        EnviarCorreo($correo_recuperar, $asunto, $html);
    } else {
        echo "no funciona";
    }
}
