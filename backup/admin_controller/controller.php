<?php
require_once 'C:\laragon\www\PROYECTO\DESARROLLO_VII_PROYECTO_HOTELWEBV2\database\conection\ConexionDba.php';

function editarUsuario($us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion){
    global $conn;

    // Inicializar la variable de salida
    $sesion = 0;

    // Preparar y ejecutar el procedimiento almacenado
    if ($stmt = $conn->prepare("CALL 04_hotel_dba_sp_editar_usuario(?,?, ?, ?, ?, ?, ?, ?, @sesion)")) {
        // Vincular los parámetros (correspondencia entre tipos y cantidad)
        $stmt->bind_param("isssssss", $us_id, $usuario, $nombre, $apellido, $telefono, $contrasena, $correo, $direccion);

        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            $stmt->close();

            // Obtener el valor de la variable de salida
            $result = $conn->query("SELECT @sesion AS sesion");
            if ($result) {
                $salidas = $result->fetch_assoc();
                return $salidas; // Retornar los valores de salida
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al ejecutar el procedimiento: " . $stmt->error;
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
    return null;
}

function eliminarUsuario($id){
    global $conn;

    // Inicializar la variable de salida
    $sesion = 0;

    // Preparar y ejecutar el procedimiento almacenado
    if ($stmt = $conn->prepare("CALL 03_hotel_dba_sp_eliminar_usuario(?,@sesion)")) {
        // Vincular los parámetros (correspondencia entre tipos y cantidad)
        $stmt->bind_param("i", $id);

        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            $stmt->close();

            // Obtener el valor de la variable de salida
            $result = $conn->query("SELECT @sesion AS sesion");
            if ($result) {
                $salidas = $result->fetch_assoc();
                return $salidas; // Retornar los valores de salida
            } else {
                echo "Error al obtener los resultados de salida.<br>";
            }
        } else {
            echo "Error al ejecutar el procedimiento: " . $stmt->error;
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
    return null;
}



function gestionHabitacion(){

    //crera habitacion 
    //eliminar habitacion 
    //editar habitacion

}


function eliminarHabitacion($ha_id) {
    global $conn;

    // Preparar la consulta
    $stmt = $conn->prepare("DELETE FROM TIPO_HABITACION WHERE ha_id = ?");
    $stmt->bind_param("i", $ha_id); // "i" indica que el parámetro es un entero

    // Ejecutar y verificar si se eliminó el registro
    if ($stmt->execute()) {
        echo "eliminado correctamente.";
    } else {
        echo "Error al eliminar  " . $stmt->error;
    }
}

function agregarHabitacion($esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen) {
    global $conn;

    // Preparar y ejecutar el procedimiento almacenado
    if ($stmt = $conn->prepare("CALL 06_hotel_dba_sp_editar_habitacion (?, ?, ?, ?, ?, ?, ?)")) {
        // Vincular los parámetros con el tipo de dato correspondiente
        $stmt->bind_param("issssss", $esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);

        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            echo "Habitación agregada correctamente.";
        } else {
            echo "Error al ejecutar el procedimiento: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}


function editarHabitacion($id_habitacion,$esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen) {
    global $conn;

    // Preparar y ejecutar el procedimiento almacenado
    if ($stmt = $conn->prepare("CALL 05_hotel_dba_sp_agregar_habitacion(?,,? ?, ?, ?, ?, ?, ?)")) {
        // Vincular los parámetros con el tipo de dato correspondiente
        $stmt->bind_param("issssss", $id_habitacion,$esc_habitacion, $precio, $disponibles, $camas, $desc_camas, $baños, $link_imagen);

        // Ejecutar el procedimiento
        if ($stmt->execute()) {
            echo "Habitación agregada correctamente.";
        } else {
            echo "Error al ejecutar el procedimiento: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
}
$conn->close();

?>