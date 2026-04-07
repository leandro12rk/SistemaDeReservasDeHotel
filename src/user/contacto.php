<?php

require_once 'correo.php';
require_once dirname(__DIR__, 2) . '/app/controller/user_controller.php';
include '../function.php';
include_once '../validaciones.php';
require_once dirname(__DIR__, 2) . '/config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$userController = new  UserController();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos = array();

    // Procesar y validar cada campo
    $campos = ['firstName', 'lastName', 'email', 'mensaje'];
    if (!getUserSesion()) {
      
        foreach ($campos as $campo) {
            if (isset($_POST[$campo])) {
                $datos[$campo] = $_POST[$campo];
            }
        }
    } else {
    
        $datos_user = $userController->obtenerTotales($_SESSION['idUsuario'], 6);
        if (isset($_POST['mensaje'])) {
            $datos['mensaje'] = $_POST['mensaje'];
        }
       
        $datos['firstName'] = $datos_user[0]['us_usuario'];
        $datos['lastName'] = $datos_user[0]['us_apellido'];
        $datos['email'] = $datos_user[0]['us_correo'];
       
    }

    $para = $datos['email'];
    $asunto = 'Solicitud de Contacto';
    //$nombre, $apellido, $telefono, $correo, $asunto, $mensaje
    $userController->registrarConsulta(
        $datos['firstName'],
        $datos['lastName'],
        '',
        $datos['email'],
        $asunto,
        $datos['mensaje']
    );

    $link_pagina = getenv('BASE_URL');

    $html = file_get_contents(dirname(__DIR__, 2) . '/components/plantillas_correos/consultas.php'); // Carga la plantilla desde un archivo externo
    $html = str_replace('{{nombre_usuario}}', htmlspecialchars($datos['firstName'], ENT_QUOTES, 'UTF-8'), $html);
    $html = str_replace('{{nombre_empresa}}', htmlspecialchars('Sistemas de Reserva', ENT_QUOTES, 'UTF-8'), $html);
    $html = str_replace('{{sitio_web}}', htmlspecialchars($link_pagina, ENT_QUOTES, 'UTF-8'), $html);

    EnviarCorreo($para, $asunto, $html);
}
