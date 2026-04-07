<?php

require_once dirname(__DIR__, 2) .'/app/controller/admin_controller.php';


$adminController = new  AdminController();
// $array = $adminController->obtenerReservas();
// print_r($array);

$array_reservas = array();
$resultado = $adminController->obtenerTotales(null,13);
// echo'<pre>';
// print_r($resultado);
// echo'</pre>';
// die();
foreach ($resultado as $reservas) {
    $array_reservas[] = [
        'IdReservas' => $reservas['re_id_Reserva'],
        'Huesped' => $reservas['hu_nombre'] .' '.$reservas['hu_apellido'],
        'IdUsuarios' => $reservas['re_id_Usuario'],
        'CheckIn' => $reservas['re_fecha_checkin'],
        'CheckOut' => $reservas['re_fecha_checkout'],
        'NumerodeNoches' => $reservas['re_num_noches'],
        'CantidaddeHabitaciones' => '',
        'TipodeHabitación' => $reservas['th_esc_habitacion'],
        'Correo' =>  $reservas['us_correo'],
        'Estado' => $reservas['re_stado'],
    ];
}

//configuraciones de la paginacion
$arrayConf = configurationPaginationTable($array_reservas, 'admin=reservas');
$paginaActual = $arrayConf['paginaActual'];
$arrayDatosPorPaginaReservas = $arrayConf['array'];
$paginaUrlVar = $arrayConf['pageVar'];
$totalPaginas = $arrayConf['totalPaginas'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] === 'addUser') {

        echo "Usuario añadido correctamente";
    }
    if (isset($_POST['action']) && $_POST['action'] === 'getDataUser' && isset($_POST['userId'])) {

        $userId = $_POST['userId']; // Asegúrate de obtener el ID de usuario
        $array_user = $adminController->obtenerTotales($userId,8);
        echo json_encode($array_user);

    }
    if (isset($_POST['action']) && $_POST['action'] === 'updateUser' && isset($_POST['userId'])) {

        $userId = $_POST['userId'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['email'];
        $direccion = $_POST['direccion'];
        $contrasena = '';
        $adminController->actualizarUsuario($userId, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
    
    }
    if (isset($_POST['action']) && $_POST['action'] === 'deleteUser' && isset($_POST['userId'])) {

       
        

        $userId = $_POST['userId'];
        $adminController->eliminarUsuario($userId);

    }
}