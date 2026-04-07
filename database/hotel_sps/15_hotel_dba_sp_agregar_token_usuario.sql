DELIMITER //

CREATE PROCEDURE 04_hotel_dba_sp_agregar_token_usuario (
    IN  id         INT,
    IN  token    VARCHAR(30),
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
        SET us_token = token
        WHERE us_id_Usuario = id;

        SET sesion = 1;  -- Código de éxito
    ELSE
        SET sesion = 0102;  -- Código de error: usuario no existe
    END IF;
END //

DELIMITER ;


