USE hotel;

DELIMITER //

CREATE PROCEDURE hotel_dba_sp_registro (
    IN  us_id_Rol  INT,
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
    -- Verifica si el usuario ya existe
    IF NOT EXISTS (SELECT 1 FROM USUARIO WHERE us_usuario = usuario) THEN
        -- Inserta el usuario con la contraseña encriptada
        INSERT INTO USUARIO (
            us_id_rol, us_usuario, us_nombre,
            us_apellido, us_telefono,
            us_contrasena, us_correo, us_direccion
        )
        VALUES (
            us_id_Rol, usuario, nombre, apellido,
            telefono, SHA2(contrasena, 256), correo, direccion
        );

        SET sesion = 0000; -- Éxito
    ELSE
        SET sesion = 0102; -- Usuario ya existe
    END IF;
END //

DELIMITER ;
