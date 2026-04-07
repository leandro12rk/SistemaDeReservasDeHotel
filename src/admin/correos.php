<?php
require_once dirname(__DIR__, 2) .'/app/controller/admin_controller.php';
include_once dirname(__DIR__, 2).'/src/function.php';

$adminController = new  AdminController();
$array_c = $adminController->obtenerTotales(null, 12);
// eliminarAllConsulta();
// eliminarConsulta($correo_id);

/*
cons_id int AI PK 
cons_nombre varchar(50) 
cons_apellido varchar(50) 
cons_telefono varchar(9) 
cons_correo varchar(50) 
cons_asunto varchar(100) 
cons_mensaje varchar(255) */
$array_correos = array();
foreach ($array_c as $correo) {
    $array_correos[] = array(
        'id' => $correo['cons_id'],
        'nombre' => $correo['cons_nombre'],
        'apellido' => $correo['cons_apellido'],
        'asunto' => $correo['cons_asunto'],
        'correo' => $correo['cons_correo'],
        'mensaje' => $correo['cons_mensaje'],
        'date' => ''
    );
}


//configuraciones de la paginacion
$arrayConf = configurationPaginationTable($array_correos, 'admin=correos');
$paginaActual = $arrayConf['paginaActual'];
$arrayDatosPorPagina = $arrayConf['array'];
$paginaUrlVar = $arrayConf['pageVar'];
$totalPaginas = $arrayConf['totalPaginas'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'deleteCorreo' && isset($_POST['correoId'])) {
        $correo_id= (int) $_POST['correoId'];
        $adminController->eliminar($correo_id,5);
    }
}