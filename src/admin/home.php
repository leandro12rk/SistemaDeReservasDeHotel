<?php
require_once dirname(__DIR__, 2) . '/app/controller/admin_controller.php';
$adminController = new  AdminController();



$arrayInfoReservas = $adminController->obtenerTotales($id = null, 1);

// echo'<pre>';
// print_r($arrayInfoReservas);
// echo'/<pre>';
// die();


$info_habitaciones_disponibles = $arrayInfoReservas[0]['HABITACIONES_DISPONIBLES'];
$info_habitaciones_reservados = $arrayInfoReservas[0]['HABITACIONES_RESERVADAS'];
$info_habitaciones_totales = $arrayInfoReservas[0]['TOTAL_HABITACIONES'];
$info_habitaciones_usuarios = $arrayInfoReservas[0]['TOTAL_USUARIOS'];
$info_habitaciones_huespedes = $arrayInfoReservas[0]['TOTAL_HUESPEDES'];


$array_info_admin = [
    [
        'titulo' => 'Total de Habitaciones',
        'info' => $info_habitaciones_totales,
        'icono' => "<span class='material-symbols-outlined'>weekend</span>",
        'template' => 'Last 24 Hours',
    ],
    [
        'titulo' => 'Habitaciones Reservados',
        'info' => $info_habitaciones_reservados,
        'icono' => "<span class='material-symbols-outlined'>weekend</span>",
        'template' => 'Last 24 Hours',
    ],
    [
        'titulo' => 'Habitaciones Disponibles',
        'info' => $info_habitaciones_disponibles,
        'icono' => "<span class='material-symbols-outlined'>weekend</span>",
        'template' => 'Last 24 Hours',
    ],
    [
        'titulo' => 'Usuarios',
        'info' => $info_habitaciones_usuarios,
        'icono' => "<span class='material-symbols-outlined'>group</span>",
        'template' => 'Last 24 Hours',
    ],
    [
        'titulo' => 'Huespedes',
        'info' => $info_habitaciones_huespedes,
        'icono' => "<span class='material-symbols-outlined'>group</span>",
        'template' => 'Last 24 Hours',
    ],
];

// echo'<pre>';
// print_r($array_info_admin);
// echo'/<pre>';
// die();


$proxima_reservas = $adminController->obtenerTotales(null, 9);
// echo'<pre>';
// print_r($proxima_reservas);
// echo'/<pre>';
// die();