USE railway;

DELIMITER //

CREATE PROCEDURE 09_hotel_dba_sp_registrar_consulta(

    IN  nombre     VARCHAR(30),
    IN  apellido   VARCHAR(30),
    IN  telefono   VARCHAR(30),
    IN  correo     VARCHAR(100),
    IN  asunto     VARCHAR(50),
    IN  mensaje    varchar(500)
)
BEGIN
    INSERT INTO CONSULTA(cons_nombre  , cons_apellido,
                         cons_telefono, cons_correo  ,
                         cons_asunto  ,cons_direccion, cons_mensaje)
    VALUES (nombre    ,apellido  ,
            telefono  ,correo    , 
            asunto    ,
            mensaje );
END //

DELIMITER ;