USE railway;

DELIMITER //

CREATE PROCEDURE 01_hotel_dba_sp_login (
    IN  usuario    VARCHAR(255),
    IN  contrasena VARCHAR(255),
    OUT sesion     INT,
    OUT loginsis   BOOLEAN,
    OUT id         INT
)
BEGIN 
    DECLARE rol INT;

    -- Etiqueta para manejar el flujo
    sp_start: BEGIN

        -- Manejar valores nulos o vacíos
        SET usuario = IFNULL(usuario, ''), contrasena = IFNULL(contrasena, '');

        -- Validar si los campos son vacíos
        IF usuario = '' OR contrasena = '' THEN
            SET loginsis = FALSE;
            SET sesion = NULL;  -- O un valor de error apropiado
            LEAVE sp_start; -- Salir del bloque etiquetado
        END IF;

        -- Validar usuario y contraseña usando hash
        IF EXISTS (
            SELECT 1 
            FROM USUARIO
            WHERE us_usuario = usuario 
              AND us_contrasena = SHA2(contrasena, 256) -- Comparar usando SHA2
        ) THEN
            -- Obtener el rol
            SELECT us_id_rol INTO rol 
            FROM USUARIO
            WHERE us_usuario = usuario;

            -- Obtener el ID del usuario
            SELECT us_id_usuario INTO id 
            FROM USUARIO
            WHERE us_usuario = usuario;

            -- Indicar éxito
            SET loginsis = TRUE;
            SET sesion = rol;  -- Usar el rol como sesión
        ELSE
            -- Indicar fallo
            SET loginsis = FALSE;
            SET sesion = NULL; 
        END IF;

    END sp_start; -- Fin del bloque etiquetado

END //

DELIMITER ;
