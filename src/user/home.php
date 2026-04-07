<?php
require_once dirname(__DIR__, 2) . '/app/controller/admin_controller.php';
$adminController = new  AdminController();
$caracteristicas_hoteles = $adminController->obtenerCaracteristicas();

// var_dump($caracteristicas_hoteles);
// die();