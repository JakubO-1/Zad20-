CREATE DATABASE IF NOT EXISTS `rezerwacje` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `rezerwacje`;

DROP TABLE IF EXISTS `wizyty`;
CREATE TABLE IF NOT EXISTS `wizyty` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `imie_nazwisko` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `data_wizyty` DATE NOT NULL,
    `godzina_wizyty` TIME NOT NULL,
    `usluga` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
