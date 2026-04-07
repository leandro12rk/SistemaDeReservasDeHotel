
DELIMITER //
CREATE PROCEDURE 07_hotel_dba_sp_reservar (
    IN id_usuario    INT,
    IN num_noches    INT,
    IN checkout      DATE,
    IN checkin       DATE,
    IN huespedes     JSON
)
BEGIN
    DECLARE i INT DEFAULT 0;
    DECLARE total_huespedes INT;
    DECLARE w_id_reserva INT;
    DECLARE tipo_ha      INT;
    DECLARE max_id       INT;
    DECLARE fecha_reserva datetime;
    
    SET max_id =0;


    -- Insertar la reserva
    INSERT INTO RESERVA (re_id_Usuario, re_fecha_checkin, re_fecha_checkout, re_num_noches, re_stado)
    VALUES (id_usuario, checkin, checkout, num_noches,  'PEND');


    -- Obtener el ID de la reserva recién insertada
    SELECT MAX(re_id_Reserva) INTO w_id_reserva 
    FROM RESERVA
    WHERE re_id_Usuario = id_usuario
      LIMIT 1;

    -- Calcular el número total de huéspedes en el JSON
    SET total_huespedes = JSON_LENGTH(huespedes);

    -- Insertar cada huésped en la tabla HUESPEDES
    WHILE i < total_huespedes DO
        INSERT INTO HUESPED (hu_id_Reserva, hu_cedula, hu_nombre, hu_apellido, hu_edad,hu_id_habitacion)
        VALUES (
            w_id_reserva,
            JSON_UNQUOTE(JSON_EXTRACT(huespedes, CONCAT('$[', i, '].cedula'))),
            JSON_UNQUOTE(JSON_EXTRACT(huespedes, CONCAT('$[', i, '].nombre'))),
            JSON_UNQUOTE(JSON_EXTRACT(huespedes, CONCAT('$[', i, '].apellido'))),
            JSON_UNQUOTE(JSON_EXTRACT(huespedes, CONCAT('$[', i, '].edad'))),
            JSON_UNQUOTE(JSON_EXTRACT(huespedes, CONCAT('$[', i, '].habitacion')))
        );
        SET i = i + 1;
    END WHILE;
    -- buscar el tipo de habitacion
    
    -- se esta obteniendo el tipo de habbitacion
    SELECT hu_id_habitacion INTO tipo_ha 
    FROM HUESPED
    WHERE hu_id_Reserva = w_id_reserva 
    LIMIT 1;
    
    -- seleccciona el maximo numero de habitacion del tipo de habitacion 
    -- SELECT MAX(ha_id_habitacion) INTO max_id
    -- FROM HABITACION
    -- WHERE ha_tipo = tipo_ha ;
    INSERT INTO HABITACION (ha_id_reserva,ha_tipo,ha_estado)
    VALUES(w_id_reserva ,tipo_ha,'OCUPA');


END //
DELIMITER ;
