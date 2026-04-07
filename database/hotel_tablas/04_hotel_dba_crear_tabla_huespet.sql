use  hotel;
-------------------------------------------
-- CREADO POR : JORSHUA FRAY             --
-------------------------------------------
-- TABLA PARA ALOJAR HUESPEDES DE UNA    --
-- RESERVA                               --
------------------------------------------- 
CREATE TABLE HUESPED(
hu_id_huesped  int auto_increment primary key,
hu_cedula      varchar(20),
hu_nombre      varchar(50),
hu_apellido    varchar(50),
hu_edad        int,
hu_id_Reserva  int,
FOREIGN KEY (hu_id_Reserva) REFERENCES RESERVA(re_id_Reserva) ON DELETE CASCADE
);