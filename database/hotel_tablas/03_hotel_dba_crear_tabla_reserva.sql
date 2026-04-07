use  hotel;
-------------------------------------------
-- CREADO POR : JORSHUA FRAY             --
-------------------------------------------
-- TABLA PARA ALOJAR RESERVAS CREADAS    --
------------------------------------------- 

CREATE TABLE RESERVA (
re_id_Reserva         int auto_increment primary key ,
re_id_Usuario         int,
re_fecha_checkin      date,
re_fecha_checkout     date,
re_num_noches         int,
re_fecha_reserva      date,
re_cant_habitacion    int,
re_stado              varchar(5),
FOREIGN KEY (re_id_Usuario) REFERENCES USUARIO(us_id_Usuario) ON DELETE CASCADE
);