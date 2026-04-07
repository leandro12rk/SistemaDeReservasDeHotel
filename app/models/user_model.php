<?php

class UserModel
{
    private $db;

    // Constructor: inicializa la conexión a la base de datos
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Iniciar sesión
    function iniciarSesion($usuario, $contrasena)
    {
        // Definir cada variable de usuario en una línea separada
        $this->db->query("SET @sesion = '';");
        $this->db->query("SET @loginsis = '';");
        $this->db->query("SET @id = '';");
        // Preparar y ejecutar el procedimiento almacenado con variables de usuario
        $stmt = $this->db->prepare("CALL 01_hotel_dba_sp_login(?, ?, @sesion, @loginsis,@id)");
        if ($stmt) {
            // Enlazar los parámetros de entrada
            $stmt->bind_param("ss", $usuario, $contrasena);
            $stmt->execute();
            $stmt->close();

            // Obtener los valores de las variables de salida
            $result = $this->db->query("SELECT @sesion AS rol, @loginsis AS validacion, @id AS idUsuario");
            if ($result) {
                $salidas = $result->fetch_assoc();
                return $salidas; // Retornar los valores de salida
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
        $stmt->close();

        return null;
    }

    // Registrar un nuevo usuario

    public function registroUsuario($us_id_Rol, $usuario,$nombreUsuario,$apellido,$telefono, $contrasena,$correo,$direcion)
    {
        $this->db->query("SET @sesion = 0;"); // Definir la variable de salida

        $stmt = $this->db->prepare("CALL 02_hotel_dba_sp_registro(?,?,?,?,?,?,?,?, @sesion)");
        if ($stmt) {
            // Enlazar parámetros
            $stmt->bind_param("isssssss", $us_id_Rol, $usuario,$nombreUsuario,$apellido,$telefono, $contrasena,$correo,$direcion);
            $stmt->execute();
            $stmt->close();

            // Obtener el valor de la variable de salida
            $result = $this->db->query("SELECT @sesion AS sesion");
            if ($result) {
                return $result->fetch_assoc(); // Retornar los valores de salida
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }
        return null;
    }

    public function registrarReserva($id_usuario, $num_noches, $checkout, $checkin, $huespedes)
    {
        $this->db->query("SET @id_reserva = 0;"); // Definir la variable de salida

        // Preparar la consulta para ejecutar el procedimiento almacenado
        $stmt = $this->db->prepare("CALL 07_hotel_dba_sp_reservar( ?, ?, ?, ?, ?)");
        if ($stmt) {
            // Convertir el array de huéspedes a formato JSON
            $huespedes_json = json_encode($huespedes);

            // Enlazar los parámetros
            $stmt->bind_param("iisss", $id_usuario, $num_noches,  $checkout, $checkin, $huespedes_json);

            // Ejecutar la consulta
            $stmt->execute();
            $stmt->close();

            // Obtener el valor de la variable de salida (por ejemplo, el ID de la reserva)
            $result = $this->db->query("SELECT @id_reserva AS id_reserva");
            if ($result) {
                return $result->fetch_assoc(); // Retornar los valores de salida (ID de la reserva)
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }

        return null;
    }

    public function RegistrarConsulta($nombre, $apellido, $telefono, $correo, $asunto,  $mensaje)
    {

        $stmt = $this->db->prepare("CALL 09_hotel_dba_sp_registrar_consulta(?,?,?,?,?,?)");
        if ($stmt) {
            // Enlazar parámetros
            $stmt->bind_param("ssssss", $nombre, $apellido, $telefono, $correo, $asunto,  $mensaje);
            $stmt->execute();
            $stmt->close();
            return true; // Retorna true si todo fue exitoso
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
            return false;
        }
    }

    public function obtenerTotales($id, $operacion)
    {
        // llamada del procedimiento
        $stmt = $this->db->prepare("CALL 08_hotel_dba_sp_totales(? , ? )");

        if ($stmt) {
            $stmt->bind_param("ii", $operacion,$id);
            $stmt->execute();

            // Usamos fetch_assoc para obtener el resultado
            $result = $stmt->get_result(); // De ser posible
            if ($result) {
                $resultArray = [];
                while ($row = $result->fetch_assoc()) {
                    $resultArray[] = $row; // Se guardan los resultados 
                }
                $stmt->close();
                return $resultArray;
            } else {
                echo "No se obtuvieron resultados.<br>";
            }
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
        }

        return null;
    }

    public function actualizarPass($id, $newPass)
    {

        $stmt = $this->db->prepare("CALL 12_hotel_dba_sp_actualizar_contra(?,?)");
        if ($stmt) {
            // Enlazar parámetros
            $stmt->bind_param("is", $id, $newPass);
            $stmt->execute();
            $stmt->close();
            return true; // Retorna true si todo fue exitoso
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
            return false;
        }
    }
    public function confirmarReserva($id_reserva)
    {

        $stmt = $this->db->prepare("CALL 13_hotel_dba_sp_conf_reserva(?)");
        if ($stmt) {
            // Enlazar parámetros
            $stmt->bind_param("i", $id_reserva);
            $stmt->execute();
            $stmt->close();
            return true; // Retorna true si todo fue exitoso
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
            return false;
        }
    }
    public function cancelarReserva($id_reserva)
    {

        $stmt = $this->db->prepare("CALL 14_hotel_dba_sp_canc_reserva(?)");
        if ($stmt) {
            // Enlazar parámetros
            $stmt->bind_param("i", $id_reserva);
            $stmt->execute();
            $stmt->close();
            return true; // Retorna true si todo fue exitoso
        } else {
            echo "Error al preparar la consulta: " . $this->db->error;
            return false;
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

    public function editarUsuario($id,$usuario,$nombre,$apellido,$telefono,$contasena,$correo,$direccion)
    {
        $this->db->query("SET @sesion = 0;");

        $stmt = $this->db->prepare("CALL 04_hotel_dba_sp_editar_usuario(?, ?,?, ?,?, ?,?, ?)");
        if ($stmt) {
            $stmt->bind_param("isssssss", $id,$usuario,$nombre,$apellido,$telefono,$contasena,$correo,$direccion);
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
    //Registrar correo enviados a la base de datos 


    /*CREATE PROCEDURE 07_hotel_dba_sp_reservar (
    IN id_usuario    INT,
    IN num_noches    INT,
    IN checkout      DATE,
    IN checkin       DATE,
    IN fecha_reserva DATE,
    IN huespedes     JSON
) */
}
/*
// Ejemplo de uso
$userModel = new UserModel($conn);

// Iniciar sesión
$resultado = $userModel->iniciarSesion("jdoe", "password13");
print_r($resultado);

// Registrar usuario
$resultado = $userModel->registroUsuario(11, 'jfray', 'jorshua', 'naelfray@gmail.com');
print_r($resultado);

// Cerrar conexión
$conn->close();
*/
