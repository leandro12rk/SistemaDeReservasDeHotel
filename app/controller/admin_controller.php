<?php
$routeAboslute = dirname(__DIR__, 2);
require_once $routeAboslute . '/database/conection/Database.php';
require_once  $routeAboslute . '/app/models/admin_model.php';

class AdminController
{

    private $adminModel;
    private $db;

    // Constructor: inicializa el modelo de administración con la conexión a la base de datos
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->adminModel = new AdminModel($this->db);
    }

    // Función para editar usuario
    public function actualizarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion)
    {
        $resultado = $this->adminModel->editarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
        if ($resultado) {
            return "Usuario actualizado correctamente.";
        } else {
            return "Error al actualizar el usuario.";
        }
    }

    // Función para eliminar usuario
    public function eliminarUsuario($id)
    {
        $resultado = $this->adminModel->eliminarUsuario($id);
        if ($resultado) {
            return "Usuario eliminado correctamente.";
        } else {
            return "Error al eliminar el usuario.";
        }
    }


    // Función para eliminar usuario
    public function agregarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion)
    {
        $resultado = $this->adminModel->agregarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
        if ($resultado) {
            return "Usuario eliminado correctamente.";
        } else {
            return "Error al eliminar el usuario.";
        }
    }
    // Función para agregar habitación
    public function agregarHabitacion($esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen)
    {
        $this->adminModel->agregarHabitacion($esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);
        return "Habitación agregada correctamente.";
    }

    // Función para eliminar habitación
    public function eliminar($id, $operacion)
    {
        $this->adminModel->eliminar($id, $operacion);
        return "Habitación eliminada correctamente.";
    }

    // Función para editar habitación
    public function editarHabitacion($id_habitacion, $esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen)
    {
        $this->adminModel->editarHabitacion($id_habitacion, $esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);
        return "Habitación editada correctamente.";
    }

    public function obtenerTotales($id, $operacion)
    {
        $resultado = $this->adminModel->obtenerTotales($id, $operacion);
        
            return $resultado;

    }

    public function obtenerCaracteristicas()
    {
        $resultado = $this->adminModel->obtenerCaracteristicas();
        if ($resultado) {
            return  $resultado;
        } else {
            return "consulta denegada.";
        }
    }
}

/* ejemploo de uso 

// Suponiendo que has instanciado el controlador AdminController
$adminController = new AdminController();

// Llamamos al método para obtener los totales
$adminController->obtenerTotales();

if ($resultado) {
            // Verificamos si la consulta devolvió algún resultado
            foreach ($resultado as $registro) {
                echo "Total de Habitaciones: " . $registro['TOTAL_HABITACIONES'] . "<br>";
                echo "Habitaciones Reservadas: " . $registro['HABITACIONES_RESERVADAS'] . "<br>";
                echo "Habitaciones Disponibles: " . $registro['HABITACIONES_DISPONIBLES'] . "<br>";
                echo "Total de Usuarios: " . $registro['USUARIOS'] . "<br>";
                echo "Total de Huespedes: " . $registro['HUESPEDES'] . "<br>";
            }
*/
