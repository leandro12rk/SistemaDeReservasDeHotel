USE railway;

DELIMITER //

CREATE PROCEDURE 06_hotel_dba_sp_editar_habitacion (
    IN  id_habitacion  INT,
    IN  esc_habitacion VARCHAR(255),
    IN  precio         DECIMAL,
    IN  disponibles    INT,
    IN  camas          INT,
    IN  desc_camas     INT,
    IN  baños          INT,
    IN  link_imagen    VARCHAR(500)
)
BEGIN
    UPDATE TIPO_HABITACION
    SET 
        th_esc_habitacion = esc_habitacion,
        th_precio = precio,
        th_disponibles = disponibles,
        th_camas = camas,
        th_desc_camas = desc_camas,
        th_baños = baños,
        th_link_imagen = link_imagen
    WHERE id_habitacion = id_habitacion;
END //

DELIMITER ;
