-- ============================================
-- Database Setup untuk Genegraft Labs
-- ============================================
-- Jalankan script ini di phpMyAdmin untuk membuat database dan tabel

-- Buat Database
CREATE DATABASE IF NOT EXISTS `proyek_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyek_db`;

-- -----------------------------------------------------
-- Table: admin
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_admin` VARCHAR(100) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table: produk
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_produk` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT NULL,
  `gambar` VARCHAR(255) NULL,
  `id_admin` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `fk_produk_admin` (`id_admin`),
  CONSTRAINT `fk_produk_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table: dokumen
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dokumen` (
  `id_dokumen` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_dokumen` VARCHAR(100) NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `id_produk` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_dokumen`),
  KEY `fk_dokumen_produk` (`id_produk`),
  CONSTRAINT `fk_dokumen_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table: lokasi
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id_lokasi` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_lokasi` VARCHAR(100) NOT NULL,
  `deskripsi` TEXT NULL,
  `id_admin` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_lokasi`),
  KEY `fk_lokasi_admin` (`id_admin`),
  CONSTRAINT `fk_lokasi_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Table: sertifikat
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sertifikat` (
  `id_sertifikat` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_sertifikat` VARCHAR(100) NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `tanggal_diterbitkan` DATE NULL,
  `id_admin` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_sertifikat`),
  KEY `fk_sertifikat_admin` (`id_admin`),
  CONSTRAINT `fk_sertifikat_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Insert Data Awal: Admin
-- -----------------------------------------------------
-- Password: admin123 (hash dibuat dengan PASSWORD_DEFAULT)
INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Admin User', 'admin', '$2y$10$IJ2fv44ndPta.LCaBjN0xezS8n/4cpRxAvFeAaqZf2ULonAORZtxG');

-- ============================================
-- Selesai
-- ============================================
-- Database sudah siap digunakan
-- Login dengan:
-- Username: admin
-- Password: admin123


