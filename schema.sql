CREATE DATABASE IF NOT EXISTS sitios_favoritos
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE sitios_favoritos;

CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE sites (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    category_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_sites_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT INTO categories (name, created_at, updated_at) VALUES
    ('Ropa', NOW(), NOW()),
    ('Electrónicos', NOW(), NOW()),
    ('Música', NOW(), NOW()),
    ('Comida', NOW(), NOW()),
    ('Libros', NOW(), NOW());
