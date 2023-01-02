DROP DATABASE IF EXISTS `db_sensus_penduduk`;
CREATE DATABASE `db_sensus_penduduk`;
USE `db_sensus_penduduk`;

CREATE TABLE `db_sensus_penduduk`.`golongan_darah`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`status_keluarga`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`pendidikan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`agama/kepercayaan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`penyebab_kematian`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`jenis_pekerjaan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`status_perkawinan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

-- 
CREATE TABLE `db_sensus_penduduk`.`kecamatan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `nama` VARCHAR(255) UNIQUE,
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`kelurahan/desa`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kecamatan` BIGINT UNSIGNED,
    `nama` VARCHAR(255) UNIQUE,
    `status` VARCHAR(255),
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kecamatan`) REFERENCES kecamatan (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`periode_sensus`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `tanggal_mulai` DATE,
    `tanggal_selesai` DATE,
    `tahun` INT UNSIGNED,
    status VARCHAR(255),
    PRIMARY KEY(`id`)
);

-- 
CREATE TABLE `db_sensus_penduduk`.`pengguna`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    PRIMARY KEY(`id`)
);

CREATE TABLE `db_sensus_penduduk`.`pegawai`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_pendidikan` BIGINT UNSIGNED,
    `id_agama/kepercayaan` BIGINT UNSIGNED,
    `nip` VARCHAR(255) UNIQUE,
    `nama` VARCHAR(255),
    `tempat_lahir` VARCHAR(255),
    `tanggal_lahir` DATE,
    `jenis_kelamin` VARCHAR(255),
    `foto` VARCHAR(255),
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_agama/kepercayaan`) REFERENCES `agama/kepercayaan` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`petugas`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_pengguna` BIGINT UNSIGNED,
    `id_pegawai` BIGINT UNSIGNED,
    `id_periode_sensus` BIGINT UNSIGNED,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_periode_sensus`) REFERENCES `periode_sensus` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`petugas_kecamatan`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_petugas` BIGINT UNSIGNED,
    `id_kecamatan` BIGINT UNSIGNED,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`petugas_kelurahan/desa`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_petugas` BIGINT UNSIGNED,
    `id_kelurahan/desa` BIGINT UNSIGNED,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_kelurahan/desa`) REFERENCES `kelurahan/desa` (`id`) ON DELETE CASCADE
);

-- 
CREATE TABLE `db_sensus_penduduk`.`camat`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kecamatan` BIGINT UNSIGNED,
    `nik` VARCHAR(255) UNIQUE,
    `nama` VARCHAR(255),
    `tanggal_lahir` DATE,
    `tempat_lahir` VARCHAR(255),
    `jenis_kelamin` VARCHAR(255),
    `foto` VARCHAR(255),
    `tahun_mulai` INT UNSIGNED,
    `tahun_selesai` INT UNSIGNED,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`lurah/kepala_desa`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kelurahan/desa` BIGINT UNSIGNED,
    `nik` VARCHAR(255) UNIQUE,
    `nama` VARCHAR(255),
    `tanggal_lahir` DATE,
    `tempat_lahir` VARCHAR(255),
    `jenis_kelamin` VARCHAR(255),
    `foto` VARCHAR(255),
    `tahun_mulai` INT UNSIGNED,
    `tahun_selesai` INT UNSIGNED,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kelurahan/desa`) REFERENCES `kelurahan/desa` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`penduduk`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kelurahan/desa` BIGINT UNSIGNED,
    `id_golongan_darah` BIGINT UNSIGNED,
    `id_pendidikan` BIGINT UNSIGNED,
    `id_jenis_pekerjaan` BIGINT UNSIGNED,
    `id_status_perkawinan` BIGINT UNSIGNED,
    `id_agama/kepercayaan` BIGINT UNSIGNED,
    `id_periode_sensus` BIGINT UNSIGNED,
    `nik` VARCHAR(255),
    `nama` VARCHAR(255),
    `tempat_lahir` VARCHAR(255),
    `tanggal_lahir` DATE,
    `jenis_kelamin` VARCHAR(255),
    `nik_ibu_kandung` VARCHAR(255),
    `nama_ibu_kandung` VARCHAR(255),
    `nik_ayah_kandung` VARCHAR(255),
    `nama_ayah_kandung` VARCHAR(255),
    `alamat_sebelumnya` VARCHAR(255),
    `alamat_sekarang` VARCHAR(255),
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kelurahan/desa`) REFERENCES `kelurahan/desa` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_golongan_darah`) REFERENCES `golongan_darah` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_pendidikan`) REFERENCES `pendidikan` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_jenis_pekerjaan`) REFERENCES `jenis_pekerjaan` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_status_perkawinan`) REFERENCES `status_perkawinan` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_agama/kepercayaan`) REFERENCES `agama/kepercayaan` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_periode_sensus`) REFERENCES `periode_sensus` (`id`) ON DELETE CASCADE 
);

CREATE TABLE `db_sensus_penduduk`.`kelahiran`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_penduduk` BIGINT UNSIGNED,
    `id_ayah_kandung` BIGINT UNSIGNED,
    `id_ibu_kandung` BIGINT UNSIGNED,
    `waktu_lahir` TIME,
    `status` VARCHAR(255),
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_ayah_kandung`) REFERENCES `penduduk` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_ibu_kandung`) REFERENCES `penduduk` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`kematian`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kelurahan/desa` BIGINT UNSIGNED,
    `id_penyebab_kematian` BIGINT UNSIGNED,
    `id_agama/kepercayaan` BIGINT UNSIGNED,
    `id_periode_sensus` BIGINT UNSIGNED,
    `nik` VARCHAR(255),
    `nama` VARCHAR(255),
    `jenis_kelamin` VARCHAR(255),
    `tanggal_waktu` DATETIME,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kelurahan/desa`) REFERENCES `kelurahan/desa` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_penyebab_kematian`) REFERENCES `penyebab_kematian` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_agama/kepercayaan`) REFERENCES `agama/kepercayaan` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_periode_sensus`) REFERENCES `periode_sensus` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`kartu_keluarga`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kelurahan/desa` BIGINT UNSIGNED,
    `id_periode_sensus` BIGINT UNSIGNED,
    `nomor_kartu_keluarga` VARCHAR(255),
    `alamat` TEXT,
    `rt` VARCHAR(255),
    `rw` VARCHAR(255),
    `kode_post` VARCHAR(255),
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kelurahan/desa`) REFERENCES `kelurahan/desa` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_periode_sensus`) REFERENCES `periode_sensus` (`id`) ON DELETE CASCADE
);

CREATE TABLE `db_sensus_penduduk`.`anggota_keluarga`(
    `id` BIGINT UNSIGNED AUTO_INCREMENT,
    `id_kartu_keluarga` BIGINT UNSIGNED,
    `id_penduduk` BIGINT UNSIGNED,
    `id_status_keluarga` BIGINT UNSIGNED,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`id_kartu_keluarga`) REFERENCES `kartu_keluarga` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_status_keluarga`) REFERENCES `status_keluarga` (`id`) ON DELETE CASCADE
);
