INSERT INTO `pendidikan` (
    `nama`
) VALUES 
('Tamat SD/Sederajat'),
('Tidak/Belum Sekolah'),
('SLTA/Sederajat'),
('SLTP/Sederajat'),
('Belum Tamat SD/Sederajat'),
('Diploma IV/Strata I'),
('Diploma I/II'),
('Akademi/Diploma III/S. Muda'),
('Strata II'),
('Strata III');

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
