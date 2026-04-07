USE railway;

DELIMITER //

CREATE PROCEDURE 12_hotel_dba_sp_actualizar_contra(
    IN us_id INT,
    IN contrasena VARCHAR(255)
)
BEGIN
    UPDATE USUARIO
    SET us_contrasena = SHA2(contrasena, 256)
    WHERE us_id_Usuario = us_id;
END //

DELIMITER ;
