use  hotel;
-------------------------------------------
-- CREADO POR : LEANDRO RODRÍGUEZ             --
-------------------------------------------
-- TABLA PARA ALOJAR LOS CORREOS ENVIADOS        --
------------------------------------------- 

CREATE TABLE CONSULTAS (
  cons_id       int auto_increment primary key,
  cons_nombre   varchar(50) DEFAULT NULL,
  cons_apellido varchar(50) DEFAULT NULL,
  cons_telefono varchar(9)  DEFAULT NULL,
  cons_correo   varchar(50) DEFAULT NULL,
  cons_asunto   varchar(100) DEFAULT NULL,
  cons_mensaje  varchar(255) DEFAULT NULL
);


