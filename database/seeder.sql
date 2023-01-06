INSERT INTO `pendidikan` (
    `id`,
    `nama`
) VALUES 
(1, 'Tamat SD/Sederajat'),
(2, 'Tidak/Belum Sekolah'),
(3, 'SLTA/Sederajat'),
(4, 'SLTP/Sederajat'),
(5, 'Belum Tamat SD/Sederajat'),
(6, 'Diploma IV/Strata I'),
(7, 'Diploma I/II'),
(8, 'Akademi/Diploma III/S. Muda'),
(9, 'Strata II'),
(10, 'Strata III');

INSERT INTO `agama/kepercayaan` (
    `nama`
) VALUES 
('Islam'),
('Kristen');

INSERT INTO `periode_sensus` (
    `tahun`,
    `tanggal_mulai`,
    `tanggal_selesai`,
    `status` 
) VALUES 
('2023', '2023-01-01', '2024-01-01', 'Berjalan'),
('2025', '2025-01-01', '2026-01-01', 'Menunggu'),
('2027', '2027-01-01', '2028-01-01', 'Menunggu');

INSERT INTO `kecamatan` (
    `id_periode_sensus`,
    `nama`
) VALUES 
(1, 'Amuntai Selatan'),
(1, 'Amuntai Tengah'),
(1, 'Amuntai Utara'),
(1, 'Babirik'),
(1, 'Banjang'),
(1, 'Danau Panggang'),
(1, 'Haur Gading'),
(1, 'Paminggir'),
(1, 'Sungai Pandan'),
(1, 'Sungai Tabukan');

INSERT INTO `kelurahan/desa` (
    `id_kecamatan`,
    `nama`,
    `status`
) VALUES 
(1, 'Bajawit', 'Desa'),
(1, 'Banyu Hirang', 'Desa'),
(1, 'Cangkering', 'Desa'),
(1, 'Cempaka', 'Desa'),
(1, 'Harusan Telaga', 'Desa'),
(1, 'Ilir Mesjid', 'Desa'),
(1, 'Jarang Kuantan', 'Desa'),
(1, 'Jumba', 'Desa'),
(1, 'Kayakah', 'Desa'),
(1, 'Keramat', 'Desa'),
(1, 'Kota Raja', 'Desa'),
(1, 'Kutai Kecil', 'Desa'),
(1, 'Mamar', 'Desa'),
(1, 'Murung Panggang', 'Desa'),
(1, 'Murung Sari', 'Desa'),
(1, 'Padang Darat', 'Desa'),
(1, 'Padang Tanggul', 'Desa'),
(1, 'Penyiuran', 'Desa'),
(1, 'Pulau Tambak', 'Desa'),
(1, 'Rukam Hilir', 'Desa'),
(1, 'Rukam Hulu', 'Desa'),
(1, 'Simpang Empat', 'Desa'),
(1, 'Simpang Tiga', 'Desa'),
(1, 'Telaga Hanyar', 'Desa'),
(1, 'Telaga Sari', 'Desa'),
(1, 'Telaga Silaba', 'Desa'),
(1, 'Teluk Baru', 'Desa'),
(1, 'Teluk Paring', 'Desa'),
(1, 'Teluk Sari', 'Desa'),
(1, 'Ujung Murung', 'Desa');

INSERT INTO `pegawai` (
    `id_pendidikan`,
    `id_agama/kepercayaan`,
    `nip`,
    `nama`,
    `tempat_lahir`,
    `tanggal_lahir`,
    `foto` 
) VALUES 
(6, 2, '1111111111111111', 'Yoga', 'Binuang', '2000-01-01', ''),
(6, 2, '2222222222222222', 'Tidier', 'Binuang', '2000-01-01', ''),
(6, 2, '3333333333333333', 'Amat', 'Binuang', '2000-01-01', '');