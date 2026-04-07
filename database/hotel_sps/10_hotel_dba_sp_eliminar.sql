DELIMITER //

CREATE PROCEDURE 10_hotel_dba_sp_eliminar(
    IN  id_entrada INT,
    IN  operacion INT
)
BEGIN 

    IF operacion = 1 THEN
	    DELETE FROM RESERVA 
        WHERE re_id_Reserva = id_entrada;
     END IF ;

    IF operacion = 2 THEN
	    DELETE FROM TIPO_HABITACION 
        WHERE re_id_Reserva = id_entrada;
     END IF ;


    IF operacion = 3 THEN
		DELETE FROM USUARIO 
        WHERE us_id_Usuario = id_entrada;
     END IF ;

    IF operacion = 4 THEN
		DELETE FROM CONSULTA 
        WHERE us_id_Usuario = id_entrada;
     END IF ;

	IF operacion = 5 THEN
		DELETE FROM CONSULTA 
        WHERE cons_id = id_entrada;
    END IF ;

END //

DELIMITER ;
