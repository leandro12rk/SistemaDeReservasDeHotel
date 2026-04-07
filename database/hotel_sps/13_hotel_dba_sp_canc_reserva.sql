
DELIMITER //
CREATE PROCEDURE 14_hotel_dba_sp_canc_reserva (
    IN id_reserva    INT
)
BEGIN

   UPDATE RESERVA
   SET re_stado = 'CANC'
   WHERE re_id_Reserva = id_reserva;
   
   UPDATE HABITACION
   SET ha_estado = 'CANC'
   WHERE re_id_Reserva = id_reserva;

END //
DELIMITER ;