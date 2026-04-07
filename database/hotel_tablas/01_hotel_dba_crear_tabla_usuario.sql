use  hotel;
-------------------------------------------
-- CREADO POR : JORSHUA FRAY             --
-------------------------------------------
--TABLA PARA ALOJAR USUARIOS DEL SISTEMA --
-------------------------------------------
CREATE TABLE USUARIO (

us_id_Usuario int auto_increment primary key,
us_id_Rol     int          not null,
us_usuario    varchar(30)  not null,
us_nombre     varchar(30)  not null,
us_apellido   varchar(30)  not null,
us_telefono   varchar(30)  not null,
us_contrasena varchar(255) not null,
us_correo     varchar(100) not null,
us_direccion  varchar(255),
Unique (us_correo)

);