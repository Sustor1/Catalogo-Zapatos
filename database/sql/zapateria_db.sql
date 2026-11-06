-- =====================================================================
-- Zapatería | Administración
-- Script para crear la base de datos, la tabla `zapatos` y registros de ejemplo.
--
-- Es una alternativa a las migraciones y seeders de Laravel:
--   php artisan migrate --seed
--
-- Uso (XAMPP):
--   C:\xampp\mysql\bin\mysql.exe -u root < database\sql\zapateria_db.sql
-- O desde phpMyAdmin: pestaña "Importar" y seleccionar este archivo.
-- =====================================================================

-- Fuerza UTF-8 para que los acentos (Café, Clásico, Mocasín) se guarden correctamente
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS zapateria_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE zapateria_db;

DROP TABLE IF EXISTS zapatos;

CREATE TABLE zapatos (
    id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,   -- Llave primaria autoincremental
    marca       VARCHAR(50)     NOT NULL,                  -- Máximo 50 caracteres
    modelo      VARCHAR(80)     NOT NULL,                  -- Máximo 80 caracteres
    categoria   VARCHAR(20)     NOT NULL,                  -- Deportivo, Casual, Formal o Botas
    talla       DECIMAL(3,1)    NOT NULL,                  -- 22.0 a 31.0 en pasos de 0.5
    color       VARCHAR(50)     NOT NULL,
    precio      DECIMAL(10,2)   NOT NULL,                  -- Mayor a 0
    existencias INT             NOT NULL,                  -- 0 o mayor
    descripcion TEXT            NULL,                      -- Opcional
    created_at  TIMESTAMP       NULL DEFAULT NULL,         -- Fecha y hora de registro
    updated_at  TIMESTAMP       NULL DEFAULT NULL,         -- Fecha y hora de última edición
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Registros de ejemplo (los mismos que database/seeders/ZapatoSeeder.php)
INSERT INTO zapatos (marca, modelo, categoria, talla, color, precio, existencias, descripcion, created_at, updated_at) VALUES
('Nike',        'Air Max 90',            'Deportivo', 26.5, 'Blanco',       2899.00, 12, 'Tenis clásico con cámara de aire visible y suela de goma.', NOW(), NOW()),
('Adidas',      'Ultraboost 22',         'Deportivo', 27.0, 'Negro',        3499.00,  4, 'Calzado para correr con amortiguación Boost.',               NOW(), NOW()),
('Converse',    'Chuck Taylor All Star', 'Casual',    25.0, 'Rojo',         1299.00, 20, 'Tenis de lona de bota baja, estilo clásico.',                NOW(), NOW()),
('Vans',        'Old Skool',             'Casual',    24.5, 'Negro/Blanco', 1499.00,  0, 'Tenis de skate con franja lateral característica.',          NOW(), NOW()),
('Flexi',       'Oxford 402',            'Formal',    27.5, 'Café',         1899.00,  8, 'Zapato de piel tipo Oxford con suela flexible.',             NOW(), NOW()),
('Andrea',      'Stiletto Clásico',      'Formal',    23.5, 'Nude',          999.00,  3, 'Zapatilla de tacón alto para ocasiones especiales.',         NOW(), NOW()),
('Timberland',  '6-Inch Premium',        'Botas',     28.0, 'Trigo',        4299.00,  6, 'Bota impermeable de piel nobuk.',                            NOW(), NOW()),
('Dr. Martens', '1460',                  'Botas',     26.0, 'Negro',        3899.00,  0, 'Bota de 8 ojillos con suela AirWair.',                       NOW(), NOW()),
('Puma',        'Suede Classic',         'Casual',    29.5, 'Azul marino',  1699.00, 15, NULL,                                                         NOW(), NOW()),
('Brantano',    'Mocasín Ejecutivo',     'Formal',    30.5, 'Negro',        1599.00,  5, 'Mocasín de piel para uso diario en oficina.',                NOW(), NOW());
