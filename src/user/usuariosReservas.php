<?php
require_once dirname(__DIR__, 2) . '/app/controller/user_controller.php';
require_once dirname(__DIR__, 2) . '/src/function.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$user_controller = new UserController();
$data_reservas_user = $user_controller->obtenerTotales($_SESSION['idUsuario'], 8);

// echo '<pre>';
// echo 'ID de Usuario ' . $_SESSION['idUsuario'] . '<br>';
// print_r($data_reservas_user);
// echo '</pre>';

$array_reservas_user = array();
foreach ($data_reservas_user as $reserva) {
    if ($reserva['re_stado'] === 'NCONF') {
        $estado = "No Confirmado";
    } else if ($reserva['re_stado'] === 'PEND') {
        $estado = "Pendiente";
    } else if ($reserva['re_stado'] === 'CONF') {
        $estado = "Confirmado";
    }
    else if ($reserva['re_stado'] === 'CANC') {
        $estado = "Cancelado";
    }
    $array_reservas_user[] = [
        'Id Reservas' => $reserva['re_id_Reserva'],
        'Huesped' => $reserva['hu_nombre'] . '  ' . $reserva['hu_apellido'],
        'Id Usuarios' => $reserva['re_id_Usuario'],
        'Check In' => $reserva['re_fecha_checkin'],
        'Check Out' => $reserva['re_fecha_checkout'],
        'Numero de Noches' => $reserva['re_num_noches'],
        'Tipo de Habitación' => $reserva['th_esc_habitacion'],
        'Correo' => $reserva['us_correo'],
        'Estado' => $estado,
    ];
}

//configuraciones de la paginacion
$arrayConf = configurationPaginationTable($array_reservas_user, 'page=usuariosReservas', 4);
$paginaActual = $arrayConf['paginaActual'];
$arrayDatosPorPagina = $arrayConf['array'];
$paginaUrlVar = $arrayConf['pageVar'];
$totalPaginas = $arrayConf['totalPaginas'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] === 'deleteReservaUsuario' && isset($_POST['reserva_user_id'])) {
        $user_controller->eliminar($_POST['reserva_user_id'], 1);
        exit;
    }
    if (isset($_POST['action']) && $_POST['action'] === 'cancelarReservaUsuario' && isset($_POST['reserva_user_id'])) {

        echo "cancelar Reserva";
        $user_controller->cancelarReserva($_POST['reserva_user_id']);
        exit;
    }
    if (isset($_POST['action']) && $_POST['action'] === 'confirmarReservaUsuario' && isset($_POST['reserva_user_id'])) {
        echo "confirmar  Reserva";
        $user_controller->confirmarReserva($_POST['reserva_user_id']);
        exit;
    }
}
