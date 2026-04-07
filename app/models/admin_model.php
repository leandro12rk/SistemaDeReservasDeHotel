<?php

class AdminModel
{
    private $db;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Editar usuario
    public function editarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion)
    {
        $this->db->query("SET @sesion = 0;");

        $stmt = $this->db->prepare("CALL 04_hotel_dba_sp_editar_usuario(?, ?, ?, ?, ?, ?, ?, ?, @sesion)");
        if ($stmt) {
            $stmt->bind_param("isssssss", $us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
            $stmt->execute();
            $stmt->close();

            $result = $this->db->query("SELECT @sesion AS sesion");
            if ($result) {
                return $result->fetch_assoc();
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
        return null;
    }
    public function agregarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion)
    {
        $this->db->query("SET @sesion = 0;");

        $stmt = $this->db->prepare("CALL 04_hotel_dba_sp_editar_usuario(?, ?, ?, ?, ?, ?, ?, ?, @sesion)");
        if ($stmt) {
            $stmt->bind_param("isssssss", $us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);
            $stmt->execute();
            $stmt->close();

            $result = $this->db->query("SELECT @sesion AS sesion");
            if ($result) {
                return $result->fetch_assoc();
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
        return null;
    }
    // Eliminar usuario
    public function eliminarUsuario($id)
    {
        $this->db->query("SET @sesion = 0;");

        $stmt = $this->db->prepare("CALL 03_hotel_dba_sp_eliminar_usuario(?)");
        if ($stmt) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();

            $result = $this->db->query("SELECT @sesion AS sesion");
            if ($result) {
                return $result->fetch_assoc();
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
        return null;
    }
    // Agregar habitación
    public function agregarHabitacion($esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen)
    {
        $stmt = $this->db->prepare("CALL 06_hotel_dba_sp_editar_habitacion(?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("issssss", $esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);
            $stmt->execute();
            echo "Habitación agregada correctamente.";
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
    }

    public function eliminar($id, $operacion)
    {
        $this->db->query("SET @sesion = 0;");

        $stmt = $this->db->prepare("CALL 10_hotel_dba_sp_eliminar(?, ?)");
        if ($stmt) {
            $stmt->bind_param("ii", $id, $operacion);
            $stmt->execute();
            $stmt->close();

            $result = $this->db->query("SELECT @sesion AS sesion");
            if ($result) {
                return $result->fetch_assoc();
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
        return null;
    }


    // Editar habitación
    public function editarHabitacion($id_habitacion, $esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen)
    {
        $stmt = $this->db->prepare("CALL 05_hotel_dba_sp_agregar_habitacion(?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("issssss", $id_habitacion, $esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);
            $stmt->execute();
            echo "Habitación editada correctamente.";
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
    }
    //Devuelve la tabla de tipo de habitaciones 


    public function obtenerTotales($id, $operacion)
    {
        // llamada del procedimiento
        $stmt = $this->db->prepare("CALL 08_hotel_dba_sp_totales(? , ? )");

        if ($stmt) {
            $stmt->bind_param("ii", $operacion, $id);
            $stmt->execute();

            // Usamos fetch_assoc para obtener el resultado
            $result = $stmt->get_result(); // De ser posible
          

            if ($result) {
                $resultArray = [];
                while ($row = $result->fetch_assoc()) {
                    $resultArray[]= $row; // Se guardan los resultados 
                }
                $stmt->close();
                return $resultArray;
            } else {
                print_r($result);
                echo "No se obtuvieron resultados.<br> ";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }

        return null;
    }
    public function obtenerCaracteristicas()
    {
        // llamada del procedimiento
        $stmt = $this->db->prepare("CALL 11_hotel_dba_sp_caracteristica()");

        if ($stmt) {
            $stmt->execute();
            // Usamos fetch_assoc para obtener el resultado
            $result = $stmt->get_result(); // De ser posible
            if ($result) {
                $resultArray = [];
                while ($row = $result->fetch_assoc()) {
                    $resultArray[] = $row; // Agregamos cada fila al array
                }
                $stmt->close();
                return $resultArray; // Retornamos el array completo
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }

        return null;
    }
}
/*
// Ejemplo de uso
$adminModel = new AdminModel($conn);

// Editar un usuario
$resultado = $adminModel->editarUsuario(1, "jdoe", "John", "Doe", "555-1234", "password123", "jdoe@example.com", "123 Main St");
print_r($resultado);

// Eliminar un usuario
$resultado = $adminModel->eliminarUsuario(1);
print_r($resultado);

// Agregar habitación
$adminModel->agregarHabitacion("Suite", "150", "10", "2", "King size", "2", "link_imagen");

// Eliminar habitación
$adminModel->eliminarHabitacion(2);

// Editar habitación
$adminModel->editarHabitacion(1, "Standard", "120", "5", "1", "Queen size", "1", "link_imagen");

$conn->close();
*/
