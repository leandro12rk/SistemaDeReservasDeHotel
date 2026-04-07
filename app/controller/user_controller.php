<?php
$routeAboslute = dirname(__DIR__, 2);
require_once $routeAboslute . '/database/conection/Database.php';
require_once  $routeAboslute . '/app/models/user_model.php';

class UserController
{

    private $userModel;
    private $db;

    // Constructor: inicializa el modelo de usuario con la conexión a la base de datos
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new UserModel($this->db);
    }

    // Función para iniciar sesión
    public function iniciarSesion($usuario, $contrasena)
    {
        $resultado = $this->userModel->iniciarSesion($usuario, $contrasena);
        if ($resultado) {
            return $resultado;
        } else {
            return "Error al iniciar sesión.";
        }
    }

    // Función para registrar un nuevo usuario
    public function registrarUsuario($us_id_Rol, $usuario, $nombreUsuario, $apellido, $telefono, $contrasena, $correo, $direcion)
    {
        $resultado = $this->userModel->registroUsuario($us_id_Rol, $usuario, $nombreUsuario, $apellido, $telefono, $contrasena, $correo, $direcion);
        if ($resultado) {
            return $resultado;
        } else {
            return "Error al registrar el usuario.";
        }
    }


    public function registrarReserva($id_usuario, $num_noches,  $checkout, $checkin, $huespedes)
    {

        $resultado = $this->userModel->registrarReserva($id_usuario, $num_noches,  $checkout, $checkin, $huespedes);
        if ($resultado) {
            return $resultado;
        } else {
            return "Error al registrar el usuario.";
        }
    }

    public function registrarConsulta($nombre, $apellido, $telefono, $correo, $asunto, $mensaje)
    {
        $resultado = $this->userModel->registrarConsulta($nombre, $apellido, $telefono, $correo, $asunto, $mensaje);
        if ($resultado) {
            return $resultado;
        } else {
            return "Error al registrar el usuario.";
        }
    }

    public function obtenerTotales($id, $operacion)
    {
        $resultado = $this->userModel->obtenerTotales($id, $operacion);
        return $resultado;
    }

    public function actualizarPass($id, $newPass)
    {
        $resultado = $this->userModel->actualizarPass($id, $newPass);
        return $resultado;
    }

    public function confirmarReserva($id_reserva)
    {
        $resultado = $this->userModel->confirmarReserva($id_reserva);
        return $resultado;
    }
    public function cancelarReserva($id_reserva)
    {
        $resultado = $this->userModel->cancelarReserva($id_reserva);
        return $resultado;
    }

    public function eliminar($id, $operacion)
    {
        $resultado = $this->userModel->eliminar($id, $operacion);
        return $resultado;
    }
    public function editarUsuario($id, $usuario, $nombre, $apellido, $telefono, $contasena, $correo, $direccion)
    {
        $resultado = $this->userModel->editarUsuario($id, $usuario, $nombre, $apellido, $telefono, $contasena, $correo, $direccion);
        return $resultado;
    }
}
/*
// Crear instancia del controlador
$userController = new UserController();

// Definir los parámetros para la reserva
$id_usuario = 41; // ID del usuario (por ejemplo, usuario con ID 1)
$num_noches = 3; // Número de noches
$id_habitacion = 101; // ID de la habitación (por ejemplo, habitación 101)
$checkout = '2024-11-25'; // Fecha de salida
$checkin = '2024-11-29'; // Fecha de entrada
$fecha_reserva = '2026-11-10'; // Fecha de reserva
$huespedes = [
    ['cedula' => '77777', 'nombre' => 'Juan', 'apellido' => 'Perez', 'edad'  => 23, 'habitacion'  => 267],
    ['cedula' => '00045', 'nombre' => 'Ana', 'apellido' => 'Gomez', 'edad'  =>  45, 'habitacion'  => 267]
   
];

//yo [{"cedula":"123456789","nombre":"Juan","apellido":"Perez","edad":23},{"cedula":"987654321","nombre":"Ana","apellido":"Gomez","edad":45}]
//'[{"cedula": "123456789", "nombre": "Juan", "apellido": "Pérez", "edad": 30}, 
//{"cedula": "987654321", "nombre": "Ana", "apellido": "Gómez", "edad": 25}]'

$huespedes_json = json_encode($huespedes);
echo $huespedes_json; // Imprime el JSON para ver su formato


// Llamar al método registrarReserva del controlador
$resultado = $userController->registrarReserva($id_usuario, $num_noches, $checkout, $checkin, $fecha_reserva, $huespedes);

// Mostrar el resultado de la ejecución
if ($resultado) {
    echo "Reserva registrada con éxito. ID de reserva: " . $resultado['id_reserva'];
} else {
    echo "Error al registrar la reserva.";
}
*/
