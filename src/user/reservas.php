<?php
require_once dirname(__DIR__, 2) . '/app/controller/user_controller.php';
require_once 'correo.php';
require_once dirname(__DIR__, 2) . '/config.php';



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userController = new UserController();

$array_tipo_habitacion = $userController->obtenerTotales(null, 10);

// echo '<pre>';
// echo "<br> array Total <br>";
// print_r($array_tipo_habitacion);
// echo '/<pre>';

$arrayHabitacionPrecio = array();
foreach ($array_tipo_habitacion as $data) {
    $arrayHabitacionPrecio[] = [
        'idHabticaion' => $data['th_id_tipo'],
        'precio' => $data['th_precio'],
        'descHabtiacion' => $data['th_esc_habitacion']
    ];
}


if (!isset($_SESSION['resumenReserva'])) {
    $_SESSION['resumenReserva'] = array();
}
if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = 0;
}
if (!isset($_SESSION['subtotal'])) {
    $_SESSION['subtotal'] = 0;
}
if (!isset($_SESSION['impuesto'])) {
    $_SESSION['impuesto'] = 0;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] === 'agregarReservaHuesped') {
        $huespedes = $_POST['huespedes'];
        // Decodificar el JSON
        $data = json_decode($huespedes, true);

        // Obtener el ID de la habitación desde el JSON
        $habitacionId = $data['tipo_habitacion']; // Asumiendo que tipo_habitacion es el ID de la habitación

        // Inicializar el arreglo de huéspedes
        $huespedes = [];

        // Iterar sobre los huéspedes y reestructurar los datos
        foreach ($data['huespedes'] as $huesped) {
            // Crear un nuevo arreglo para cada huésped
            $nuevoHuesped = [
                'cedula' => isset($huesped['cedula']) ? $huesped['cedula'] : null, // Usar null si no hay cédula
                'nombre' => $huesped['nombre'],
                'apellido' => $huesped['apellido'],
                'edad' => $huesped['edad'],
                'habitacion' => $habitacionId // Asignar el ID de la habitación desde el JSON
            ];

            // Agregar el nuevo huésped al arreglo
            $huespedes[] = $nuevoHuesped;
        }
        $_SESSION['huespedes'] = $huespedes;

        // Recopilar las habitaciones ocupadas
        foreach ($huespedes as $huesped) {
            $_SESSION['resumenReserva'][] = [
                "cantidad_huéspedes" => count($huespedes), // Contar la cantidad de huéspedes
                "idHabticaion" =>  $huesped['habitacion'],
            ];
        }

        die();
    }
    if (isset($_POST['action']) && $_POST['action'] === 'realizarReserva') {
        if (isset($_POST['checkin']) && isset($_POST['checkout'])) {

            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
            $huespedes =   $_SESSION['huespedes'];
            // Crear objetos DateTime a partir de las fechas
            $fechaCheckin = new DateTime($checkin);
            $fechaCheckout = new DateTime($checkout);

            // Calcular la diferencia
            $diferencia = $fechaCheckin->diff($fechaCheckout);

            // Obtener el número de noches
            $num_noches = $diferencia->days; // La propiedad 'days' contiene el número total de días

            foreach ($_SESSION['resumenReserva'] as $key => $data) {
                $_SESSION['resumenReserva'][$key]['numNoches'] = $num_noches;
            };
            
            /*
            $data_usuario_reserva = $userController->obtenerTotales($_SESSION['idUsuario'], 6);
            $para = $data_usuario_reserva[0]['us_correo'];
            $nombre_usuario = $data_usuario_reserva[0]['us_nombre'] . ' ' . $data_usuario_reserva[0]['us_nombre'];
            $asunto = 'Confirmacion de Correo';

            $link_pagina = getenv('BASE_URL');
            $code_reserva="";
            $link_confirmar_reserva = $link_pagina . '/src/confirmar_reserva.php?code='.$code_reserva;

            $html = file_get_contents(dirname(__DIR__, 2) . '/components/plantillas_correos/confirmar_reserva.php'); // Carga la plantilla desde un archivo externo
            $html = str_replace('{{nombre_usuario}}', htmlspecialchars($nombre_usuario, ENT_QUOTES, 'UTF-8'), $html);
            $html = str_replace('{{nombre_empresa}}', htmlspecialchars('Sistemas de Reserva', ENT_QUOTES, 'UTF-8'), $html);
            $html = str_replace('{{sitio_web}}', htmlspecialchars($link_pagina, ENT_QUOTES, 'UTF-8'), $html);
            $html = str_replace('{{link_confirmar_reserva}}', htmlspecialchars($link_confirmar_reserva, ENT_QUOTES, 'UTF-8'), $html);


            EnviarCorreo($para, $asunto, $html);

            */
            $userController->registrarReserva($_SESSION['idUsuario'], $num_noches,  $checkout, $checkin, $huespedes);
        }
    }
    if (isset($_POST['action']) && $_POST['action'] === 'actualizarResumenReservas') {
        // Agregar el precio y la descripción a cada habitación en el resumen de reserva
        foreach ($_SESSION['resumenReserva'] as $key => $reserva) {
            foreach ($arrayHabitacionPrecio as $habitacion) {
                if ($reserva['idHabticaion'] == $habitacion['idHabticaion']) {
                    // Agregar el precio y la descripción de la habitación al resumen de reserva
                    $_SESSION['resumenReserva'][$key]['precio'] = $habitacion['precio'];
                    $_SESSION['subtotal'] += $habitacion['precio'];
                    $_SESSION['resumenReserva'][$key]['descHabtiacion'] = $habitacion['descHabtiacion'];
                    $_SESSION['resumenReserva'][$key]['costoPorNoche'] = $reserva['numNoches'] * $habitacion['precio'];
                }
            }
        }
        unset($reserva); // Romper la referencia con el último elemento
        //$_SESSION['subtotal'] =2;
        $_SESSION['impuesto']  = $_SESSION['subtotal']  * 0.07;
        $_SESSION['total'] = $_SESSION['subtotal']  + $_SESSION['impuesto'];
    }
}
