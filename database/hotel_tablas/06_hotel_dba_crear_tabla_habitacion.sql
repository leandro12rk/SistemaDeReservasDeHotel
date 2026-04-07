use  hotel;
-------------------------------------------
-- CREADO POR : JORSHUA FRAY             --
-------------------------------------------
-- TABLA PARA ALOJAR HABITACIONES        --
------------------------------------------- 

CREATE TABLE HABITACION (
ha_id_habitacion    int auto_increment primary key,
ha_id_reserva       int,
ha_tipo             int,
ha_estado           varchar(5),
FOREIGN KEY (ha_tipo ) REFERENCES TIPO_HABITACION(th_id_tipo)
);




