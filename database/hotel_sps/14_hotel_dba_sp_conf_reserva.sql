
DELIMITER //
CREATE PROCEDURE 14_hotel_dba_sp_conf_reserva (
    IN id_reserva    INT
)
BEGIN

   UPDATE RESERVA
   SET re_stado = 'CONF'
   WHERE re_id_Reserva = id_reserva;
   
   UPDATE HABITACION
   SET ha_estado = 'CONF'
   WHERE re_id_Reserva = id_reserva;

END //
DELIMITER ;