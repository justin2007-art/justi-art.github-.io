CREATE DATABASE notas;
USE notas;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'docente', 'estudiante', 'padre') NOT NULL
);

CREATE TABLE calificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estudiante_id INT NOT NULL,
    materia VARCHAR(100) NOT NULL,
    nota DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (estudiante_id) REFERENCES usuarios(id)
);
