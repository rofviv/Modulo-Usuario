CREATE DATABASE IF NOT EXISTS usuario;

USE usuario;

DROP TABLE IF EXISTS menu_usuario;
DROP TABLE IF EXISTS bitacora;
DROP TABLE IF EXISTS usuario;
DROP TABLE IF EXISTS menu;
DROP TABLE IF EXISTS grupo_usuario;

CREATE TABLE usuario
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(30) NOT NULL,
	usuario VARCHAR(15) NOT NULL UNIQUE,
	clave VARCHAR(30) NOT NULL,
	activo INT DEFAULT 1
);

CREATE TABLE bitacora
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  suceso VARCHAR(100) NOT NULL,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  id_usuario INT NOT NULL,
	FOREIGN KEY(id_usuario) REFERENCES usuario(id)
);

CREATE TABLE grupo_usuario
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  grupo VARCHAR(20) NOT NULL
);

CREATE TABLE menu
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  opcion VARCHAR(30) NOT NULL,
  enlace VARCHAR(20) NOT NULL,
  icon VARCHAR(25) DEFAULT 'fa fa-circle-o',
  id_grupo INT NOT NULL,
  FOREIGN KEY(id_grupo) REFERENCES grupo_usuario(id)
);

CREATE TABLE menu_usuario
(
  id_usuario INT NOT NULL,
  id_menu INT NOT NULL,
  FOREIGN KEY(id_usuario) REFERENCES usuario(id),
  FOREIGN KEY(id_menu) REFERENCES menu(id)
);

INSERT INTO usuario (nombre, usuario, clave) VALUES
('Administrador', 'admin', '123456'),
('Admin 2', 'user2', '123456'),
('Admin 3', 'user3', '123456');

INSERT INTO grupo_usuario (grupo) VALUES
('Usuario Alto'),
('Usuario Medio'),
('Usuario Bajo');

INSERT INTO menu (opcion, enlace, id_grupo) VALUES
('Nuevo Usuario', 'registrar', 1),
('Modificar Usuario', 'modificar', 1),
('Nuevo Modulo', 'modulo', 1),
('Bitacora', 'bitacora', 1),
('Asignar Privilegios', 'privilegios', 1),
('Opcion 1', '#', 2),
('Opcion 2', '#', 2),
('Opcion 3', '#', 2),
('Opcion 4', '#', 2),
('Opcion 5', '#', 2),
('Opcion 6', '#', 3),
('Opcion 7', '#', 3),
('Opcion 8', '#', 3);

INSERT INTO menu_usuario (id_usuario, id_menu) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 11),
(3, 12),
(3, 13);
