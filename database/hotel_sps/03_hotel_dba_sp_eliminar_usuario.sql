DELIMITER //

CREATE PROCEDURE 03_hotel_dba_sp_eliminar_usuario(
    IN  id_usurio INT
)
BEGIN 
	 DELETE FROM USUARIO 
     WHERE us_id_Usuario = id_usurio;
END //

DELIMITER ;
