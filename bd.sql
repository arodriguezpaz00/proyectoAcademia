create database academia;

use academia;

create table notas(
    nombre VARCHAR(250),
    identificacion INT(20),
    calificacion VARCHAR(15)
)

CREATE TABLE profesores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dni VARCHAR(20) NOT NULL UNIQUE,
    asignatura VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL
);


CREATE TABLE asignaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    horas INT NOT NULL
);

INSERT INTO asignaturas (nombre, horas) VALUES
('MF0950_1 : Desarrollo en Servidor', 60),
('MF0950_2 : Desarrollo en Frontend', 60),
('MF0950_3 : Frameworks de JavaScript', 45),
('MF0950_4 : Bases de Datos Relacionales', 60),
('MF0950_5 : API Restful', 30),
('MF0950_6 : Despliegue de Aplicaciones', 30),
('MF0950_7 : Gestión de Proyectos de Software', 40),
('MF0950_8 : Seguridad en Aplicaciones Web', 30);

SELECT *  from asignaturas;

CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL, 
    promedio VARCHAR(15) DEFAULT '0'
);

CREATE TABLE estudiante_asignatura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT NOT NULL,
    asignatura_id INT NOT NULL,
    fecha_asociacion DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(id),
    FOREIGN KEY (asignatura_id) REFERENCES asignaturas(id)
);
DROP TABLE estudiantes;

DROP TABLE estudiante_asignatura;
SELECT * from estudiantes;

ALTER TABLE estudiante_asignatura ADD COLUMN nota DECIMAL(5, 2); -- Puedes ajustar el tipo de datos según tus necesidades


SELECT * from asignaturas;

INSERT INTO estudiantes (nombre, dni, email, telefono) VALUES 
    ('Juan Pérez', '12345678A', 'juan.perez@example.com', '987654321'),
    ('María Gómez', '23456789B', 'maria.gomez@example.com', '987654322'),
    ('Carlos López', '34567890C', 'carlos.lopez@example.com', '987654323'),
    ('Ana Martínez', '45678901D', 'ana.martinez@example.com', '987654324'),
    ('Luis Fernández', '56789012E', 'luis.fernandez@example.com', '987654325'),
    ('Laura Rodríguez', '67890123F', 'laura.rodriguez@example.com', '987654326'),
    ('José Sánchez', '78901234G', 'jose.sanchez@example.com', '987654327'),
    ('Claudia Torres', '89012345H', 'claudia.torres@example.com', '987654328'),
    ('David Jiménez', '90123456I', 'david.jimenez@example.com', '987654329'),
    ('Isabel Morales', '01234567J', 'isabel.morales@example.com', '987654330'),
    ('Santiago Ruiz', '12345678K', 'santiago.ruiz@example.com', '987654331'),
    ('Patricia Díaz', '23456789L', 'patricia.diaz@example.com', '987654332'),
    ('Fernando Herrera', '34567890M', 'fernando.herrera@example.com', '987654333'),
    ('Gabriela Romero', '45678901N', 'gabriela.romero@example.com', '987654334'),
    ('Ricardo Castro', '56789012O', 'ricardo.castro@example.com', '987654335');


SELECT * FROM estudiante_asignatura;

CREATE TABLE IF NOT EXISTS mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE mensajes
ADD COLUMN asunto VARCHAR(255) AFTER nombre;

SELECT * FROM mensajes;

CREATE Table libro_diario(
    date1 date, cuenta1 VARCHAR(50), debe1 FLOAT(30) haber1 FLOAT(30), total_debe1 FLOAT(30), total_haber1 FLOAT(30),

    date2 date, cuenta2 VARCHAR(50), debe2 FLOAT(30) haber2 FLOAT(30), total_debe2 FLOAT(30), total_haber2 FLOAT(30),

    date3 date, cuenta3 VARCHAR(50), debe3 FLOAT(30) haber3 FLOAT(30), total_debe3 FLOAT(30), total_haber3 FLOAT(30),

    date4 date, cuenta4 VARCHAR(50), debe4 FLOAT(30) haber4 FLOAT(30), total_debe4 FLOAT(30), total_haber4 FLOAT(30),

    date5 date, cuenta5 VARCHAR(50), debe5 FLOAT(30) haber5 FLOAT(30), total_debe5 FLOAT(30), total_haber5 FLOAT(30),
);