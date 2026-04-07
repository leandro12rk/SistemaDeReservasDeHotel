

use railway;



DELIMITER //

CREATE PROCEDURE 05_hotel_dba_sp_agregar_habitacion (
    IN  esc_habitacion varchar(255),
    IN  precio         decimal,
    IN  disponibles    int,
    IN  camas          int,
    IN  desc_camas     int,
    IN  baños          int,
    IN  link_imagen    varchar(500)
    
)
BEGIN 
        INSERT INTO TIPO_HABITACION(th_esc_habitacion
                            ,th_precio ,th_disponibles ,
		                    us_apellido  ,us_telefono,
							th_camas ,th_desc_camas  ,
						    th_baños ,th_link_imagen  )
			VALUES(esc_habitacion, precio  ,disponibles  , camas ,
			      desc_camas, baños  , link_imagen  );
END //

DELIMITER ;