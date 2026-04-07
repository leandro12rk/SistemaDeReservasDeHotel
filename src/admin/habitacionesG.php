<?php
require_once dirname(__DIR__, 2) . '/app/controller/admin_controller.php';
include_once dirname(__DIR__, 2) . '/src/function.php';

$adminController = new AdminController();
$array = $adminController->obtenerTotales(null,10);

// echo '<pre>';
// print_r($array);
// echo '</pre>';
// die();

$infoHabitacion = array();
foreach ($array as $info) {
    $infoHabitacion[] = [
        'id' => $info['th_id_tipo'],
        'tipo' => $info['th_esc_habitacion'],
        'disponibles' => $info['th_disponibles'],
        'camas' => $info['th_camas'],
        'banos' => $info['th_baños'],
        'total' => $info['th_total'],
        'imgLink' => $info['th_link_imagen'],
        'precio'=>$info['th_precio'],
        'caracteristicas'=>json_decode($info['th_caracteristicas'] , true),
        'description'=>$info['th_columen'],
    ];
}

$arrayConf = configurationPaginationTable($infoHabitacion, 'admin=habitacionesG');
$paginaActual = $arrayConf['paginaActual'];
$arrayDatosPorPagina = $arrayConf['array'];
$paginaUrlVar = $arrayConf['pageVar'];
$totalPaginas = $arrayConf['totalPaginas'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['action']) && $_POST['action'] === 'addUser') {
        $adminController->agregarHabitacion($esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);
    
    }
    
    if (isset($_POST['action']) && $_POST['action'] === 'getDataUser' && isset($_POST['tipoIdHabitacion'])) {

        $id = $_POST['tipoIdHabitacion']; // Asegúrate de obtener el ID de usuario
        $array_user = $adminController->obtenerTotales($id, 6);

        $array = $array_user[0];
        echo json_encode($array);
    
    }

    if (isset($_POST['action']) && $_POST['action'] === 'updateUser' && isset($_POST['tipoIdHabitacion'])) {

    }

    if (isset($_POST['action']) && $_POST['action'] === 'deleteUser' && isset($_POST['tipoIdHabitacion'])) {
        $id = $_POST['tipoIdHabitacion'];
        $adminController->eliminar($id,2);
    }

}


