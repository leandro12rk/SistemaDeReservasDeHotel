use  hotel;
-------------------------------------------
-- CREADO POR : JORSHUA FRAY             --
-------------------------------------------
--TABLA PARA ALOJAR TIPOS DE HABITACIONES--
------------------------------------------- 

CREATE TABLE TIPO_HABITACION (
th_id_tipo         int auto_increment primary key,
th_esc_habitacion  varchar(255),
th_precio          decimal,
th_disponibles     int,
th_camas           int,
th_desc_camas      int,
th_baños           int,
th_link_imagen     varchar(500),
th_total           int

);