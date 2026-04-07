DELIMITER //

CREATE PROCEDURE 04_hotel_dba_sp_editar_usuario (
    IN  id         INT,
    IN  usuario    VARCHAR(30),
    IN  nombre     VARCHAR(30),
    IN  apellido   VARCHAR(30),
    IN  telefono   VARCHAR(30),
    IN  contrasena VARCHAR(255),
    IN  correo     VARCHAR(100),
    IN  direccion  VARCHAR(255),
    OUT sesion     INT
)
BEGIN 
    DECLARE usuario_existe INT;

    -- Verificar si el usuario existe
    SELECT COUNT(*) INTO usuario_existe 
    FROM USUARIO 
    WHERE us_id_Usuario = id;

    IF usuario_existe > 0 THEN
        -- Si el usuario existe, actualizar sus datos
        UPDATE USUARIO 
        SET us_nombre = nombre,
            us_apellido = apellido,
            us_telefono = telefono,
            us_contrasena = contrasena,
            us_correo = correo,
            us_direccion = direccion
        WHERE us_id_Usuario = id;

        SET sesion = 1;  -- Código de éxito
    ELSE
        SET sesion = 0102;  -- Código de error: usuario no existe
    END IF;
END //

DELIMITER ;


