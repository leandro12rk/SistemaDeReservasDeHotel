<?php
require_once dirname(__DIR__, 2) . '/app/controller/admin_controller.php';
include_once dirname(__DIR__, 2) . '/src/function.php';

$adminController = new  AdminController();
$array_info_user_admin = $adminController->obtenerTotales(null, 3);
//print_r($array_info_user_admin);

//configuraciones de la paginacion
$arrayConf = configurationPaginationTable($array_info_user_admin, 'admin=usuarios');
$paginaActual = $arrayConf['paginaActual'];
$arrayDatosPorPagina = $arrayConf['array'];
$paginaUrlVar = $arrayConf['pageVar'];
$totalPaginas = $arrayConf['totalPaginas'];

$array_rol = $adminController->obtenerTotales(null, 4);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] === 'addUser') {
        $adminController->agregarUsuario($userId, $usuario, $rol, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
    }
    if (isset($_POST['action']) && $_POST['action'] === 'getDataUser' && isset($_POST['userId'])) {

        $userId = $_POST['userId']; // Asegúrate de obtener el ID de usuario
        $array_user = $adminController->obtenerTotales($userId, 6);

        foreach ($array_user as $array) {

            if ($array['us_id_Rol'] == 1) {
                $array_user[0]['rol'] = 'admin';
            } else {
                $array_user[0]['rol'] = 'user';
            }
        }
        $array = $array_user[0];
        echo json_encode($array);
    }

    if (isset($_POST['action']) && $_POST['action'] === 'updateUser' && isset($_POST['userId'])) {

        $userId = $_POST['userId'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['email'];
        $direccion = $_POST['direccion'];
        $contrasena = '';
        $adminController->actualizarUsuario($userId, $usuario, $rol, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
    }
    if (isset($_POST['action']) && $_POST['action'] === 'deleteUser' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];
        $adminController->eliminarUsuario($userId);
    }
    if (isset($_POST['action']) && $_POST['action'] === 'deleteAllUser') {
        // $adminController->eliminarUsuario($userId);/// eliminar ezta opcion eso nova 
    }
}
