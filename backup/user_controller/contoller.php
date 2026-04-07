<?php
require_once 'C:\laragon\www\PROYECTO\DESARROLLO_VII_PROYECTO_HOTELWEBV2\database\conection\ConexionDba.php';

function iniciarSesion($usuario, $contrasena) {
    global $conn;

    // Definir cada variable de usuario en una línea separada
    $conn->query("SET @salida1 = '';");
    $conn->query("SET @salida2 = '';");

    // Preparar y ejecutar el procedimiento almacenado con variables de usuario
    $stmt = $conn->prepare("CALL 01_hotel_dba_sp_login(?, ?, @salida1, @salida2)");
    if ($stmt) {
        // Enlazar los parámetros de entrada
        $stmt->bind_param("ss", $usuario, $contrasena);
        $stmt->execute();
        $stmt->close();

        // Obtener los valores de las variables de salida
        $result = $conn->query("SELECT @salida1 AS salida1, @salida2 AS salida2");
        if ($result) {
            $salidas = $result->fetch_assoc();
            return $salidas; // Retornar los valores de salida
        } else {
            echo "Error al obtener los resultados de salida.<br>";
        }
    } else {
        echo "Error al preparar la consulta: " . $conn->error;
    }
    return null;
}

function registroUsuario($us_id_Rol, $usuario,$contrasena, $correo) {
    global $conn;

    // Inicializar la variable de salida
    $sesion = 0;

    // Preparar y ejecutar el procedimiento almacenado
    if ($stmt = $conn->prepare("CALL 02_hotel_dba_sp_registro(?, ?, ?, @sesion)")) {
        // Vincular los parámetros (correspondencia entre tipos y cantidad)
        $stmt->bind_param("isssssss", $us_id_Rol, $usuario,$contrasena, $correo);

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



//$resultado = registroUsuario(11,'jfray','jorshua', 'FRAY',  '9876543210','contrasena','naelfray@gmail.com','456 Calle Secundaria');
/*Llamada a la función y prueba
$resultado = iniciarSesion("jdoe", "password13");
print_r($resultado);

print_r($resultado); // Imprimir el resultado de la variable de salida
*/



// Cerrar conexión
$conn->close();
?>
