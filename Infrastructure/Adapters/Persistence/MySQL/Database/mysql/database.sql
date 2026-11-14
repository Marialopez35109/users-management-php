CREATE DATABASE IF NOT EXISTS crud_usuarios
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE crud_usuarios;

CREATE TABLE IF NOT EXISTS users (
  id VARCHAR(50) NOT NULL PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'MEMBER',
  status VARCHAR(20) NOT NULL DEFAULT 'PENDING',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS municipios (
  id VARCHAR(50) NOT NULL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  departamento VARCHAR(100) NOT NULL,
  pais VARCHAR(100) NOT NULL,
  alcalde VARCHAR(100) NOT NULL DEFAULT '',
  gobernador VARCHAR(100) NOT NULL DEFAULT '',
  patrono_religioso VARCHAR(100) NOT NULL DEFAULT '',
  num_habitantes INT UNSIGNED NOT NULL DEFAULT 0,
  num_casas INT UNSIGNED NOT NULL DEFAULT 0,
  num_parques INT UNSIGNED NOT NULL DEFAULT 0,
  num_colegios INT UNSIGNED NOT NULL DEFAULT 0,
  descripcion TEXT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT IGNORE INTO municipios
  (id, nombre, departamento, pais, alcalde, gobernador, patrono_religioso,
   num_habitantes, num_casas, num_parques, num_colegios, descripcion)
VALUES
  ('mun-001', 'Cartagena de Indias', 'Bolívar', 'Colombia', 'Dumek Turbay', 'Yamil Arana', 'Virgen de la Candelaria', 1000000, 250000, 120, 400, 'Ciudad histórica y puerto del Caribe colombiano.'),
  ('mun-002', 'Turbaco', 'Bolívar', 'Colombia', 'Alcalde de ejemplo', 'Yamil Arana', 'San Jose', 75000, 19000, 15, 30, 'Municipio vecino de Cartagena.'),
  ('mun-003', 'Medellín', 'Antioquia', 'Colombia', 'Federico Gutiérrez', 'Andrés Julián Rendón', 'Nuestra Señora de la Candelaria', 2600000, 700000, 200, 700, 'Capital de Antioquia.');