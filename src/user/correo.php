<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
require_once dirname(__DIR__, 2) . '/config.php';


function EnviarCorreo($para, $asunto, $html, $test = false)
{

    $mail = new PHPMailer(true);
    if ($test) {
        $mail->SMTPDebug = 2; // O 3 para más detalles
        $mail->Debugoutput = 'html'; // O 'error_log' para enviar la salida a un log
    }
    try {
        $mail->isSMTP();
        $mail->Host = getenv('EMAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_SENDER');
        $mail->Password = getenv('EMAIL_PASS'); // Usa una contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Puerto TCP para SSL

        $mail->setFrom(getenv('EMAIL_SENDER'), 'Sistema de Reservas  no-replay');
        $mail->addAddress($para);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; // Establece el charset a UTF-8
        $mail->Subject = $asunto;
        $mail->Body = $html;

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo} <br>";
        echo "Error al enviar el mensaje: $e <br>";
        die();
    }
    header("Location: ../../index.php");
    exit();
}
