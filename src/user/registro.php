<?php
require_once dirname(__DIR__, 2) . '/database/conection/Database.php';
require_once dirname(__DIR__, 2) . '/app/controller/user_controller.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['userName']) && isset($_POST['password'])  && isset($_POST['user']) && isset($_POST['email'])) {


        $user_controller = new UserController();
        $usuario=$_POST['user'];
        $nombreUsuario=$_POST['userName'];
        $apellido=$_POST['apellido'];
        $telefono=$_POST['telefono'];
        $contrasena=$_POST['password'];
        $correo=$_POST['email'];
        $direcion=$_POST['direccion'];

        $resultado = $user_controller->registrarUsuario(2, $usuario, $nombreUsuario, $apellido, $telefono, $contrasena, $correo, $direcion);
        
        if ($resultado['sesion'] == 102) {
            echo 'Usuario Repetido';
        }
        header("Location: ../../index.php");
        exit();
    }
}
