<?php
include  '../app/controller/user_controller.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// $resultado = iniciarSesion("jdoe", "password123");
// $resultado = iniciarSesion("asmith", "password456");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['userName']) && isset($_POST['password'])) {
        $user = new UserController();
        $resultado = $user->iniciarSesion($_POST['userName'], $_POST['password']);

        //var_dump($resultado);

        if ($resultado['validacion'] == 1) {
            if ($resultado['rol'] == 1) {

                $_SESSION['idUsuario'] = $resultado['idUsuario'];
                $_SESSION['isAdmin'] = true;
                $_SESSION['userRegistrado'] = false;
 
            } else if ($resultado['rol'] == 2) {

                $_SESSION['idUsuario'] = $resultado['idUsuario'];
                $_SESSION['userRegistrado'] = true;
     
            } 

        } else {
            echo 'validacion de usuario : ' . $resultado['validacion'];
        }
         //die();

        header("Location: ../index.php");
        exit();
    }
}
