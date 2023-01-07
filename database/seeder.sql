INSERT INTO `pengguna` (
    `username`,
    `password` 
) VALUES 
('admin', 'admin');

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
('Kristen'),
('Katolik'),
('Hindu'),
('Budha'),
('Konghucu');

INSERT INTO `periode_sensus` (
    `tahun`,
    `tanggal_mulai`,
    `tanggal_selesai`,
    `status` 
) VALUES 
('2020', '2020-01-01', '2022-01-01', 'Berjalan'),
('2030', '2030-01-01', '2032-01-01', 'Menunggu'),
('2040', '2040-01-01', '2042-01-01', 'Menunggu');

INSERT INTO `kecamatan` (
    `id`,
    `id_periode_sensus`,
    `nama`
) VALUES 
(1, 1, 'Amuntai Selatan'),
(2, 1, 'Amuntai Tengah'),
(3, 1, 'Amuntai Utara'),
(4, 1, 'Babirik'),
(5, 1, 'Banjang'),
(6, 1, 'Danau Panggang'),
(7, 1, 'Haur Gading'),
(8, 1, 'Paminggir'),
(9, 1, 'Sungai Pandan'),
(10, 1, 'Sungai Tabukan'),
(11, 2, 'Amuntai Selatan'),
(12, 2, 'Amuntai Tengah'),
(13, 2, 'Amuntai Utara'),
(14, 2, 'Babirik'),
(15, 2, 'Banjang'),
(16, 2, 'Danau Panggang'),
(17, 2, 'Haur Gading'),
(18, 2, 'Paminggir'),
(19, 2, 'Sungai Pandan'),
(20, 2, 'Sungai Tabukan'),
(21, 3, 'Amuntai Selatan'),
(22, 3, 'Amuntai Tengah'),
(23, 3, 'Amuntai Utara'),
(24, 3, 'Babirik'),
(25, 3, 'Banjang'),
(26, 3, 'Danau Panggang'),
(27, 3, 'Haur Gading'),
(28, 3, 'Paminggir'),
(29, 3, 'Sungai Pandan'),
(30, 3, 'Sungai Tabukan');

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
(2, 'Danau Ceramin', 'Desa'),
(2, 'Datu Kuning', 'Desa'),
(2, 'Harus', 'Desa'),
(2, 'Harusan', 'Desa'),
(2, 'Hulu Pasar', 'Desa'),
(2, 'Kandang Halang', 'Desa'),
(2, 'Kembang Kuning', 'Desa'),
(2, 'Kota Raden Hilir', 'Desa'),
(2, 'Kota Raden Hulu', 'Desa'),
(2, 'Mawar Sari', 'Desa'),
(2, 'Muara Tapus', 'Desa'),
(2, 'Palampitan Hilir', 'Desa'),
(2, 'Palampitan Hulu', 'Desa'),
(2, 'Pasar Senin', 'Desa'),
(2, 'Pinang Habang', 'Desa'),
(2, 'Pinang Kara', 'Desa'),
(2, 'Rantawan', 'Desa'),
(2, 'Sungai Baring', 'Desa'),
(2, 'Sungai Karias', 'Desa'),
(2, 'Tambalangan', 'Desa'),
(2, 'Tangga Ulin Hilir', 'Desa'),
(2, 'Tangga Ulin Hulu', 'Desa'),
(2, 'Tapus', 'Desa'),
(2, 'Tigarun', 'Desa'),
(2, 'Antasari', 'Kelurahan'),
(2, 'Kebun Sari', 'Kelurahan'),
(2, 'Murung Sari', 'Kelurahan'),
(2, 'Paliwara', 'Kelurahan'),
(2, 'Sungai Malang', 'Kelurahan'),
(3, 'Air Tawar', 'Desa'),
(3, 'Cakru', 'Desa'),
(3, 'Guntung', 'Desa'),
(3, 'Kamayahan', 'Desa'),
(3, 'Kuangan', 'Desa'),
(3, 'Muara Baruh', 'Desa'),
(3, 'Murung Karangan', 'Desa'),
(3, 'Padang Basar', 'Desa'),
(3, 'Padang Basar Hilir', 'Desa'),
(3, 'Padang Luar', 'Desa'),
(3, 'Pakacangan', 'Desa'),
(3, 'Pakapuran', 'Desa'),
(3, 'Pamintangan', 'Desa'),
(3, 'Panangian', 'Desa'),
(3, 'Panangkalaan', 'Desa'),
(3, 'Panangkalaan Hulu', 'Desa'),
(3, 'Pandawanan', 'Desa'),
(3, 'Panyaungan', 'Desa'),
(3, 'Pimping', 'Desa'),
(3, 'Sungai Turak', 'Desa'),
(3, 'Sungai Turak Dalam', 'Desa'),
(3, 'Tabalong Mati', 'Desa'),
(3, 'Tabing Liring', 'Desa'),
(3, 'Tayur', 'Desa'),
(3, 'Telaga Bamban', 'Desa'),
(3, 'Teluk Daun', 'Desa'),
(11, 'Ujung Murung', 'Desa'),
(11, 'Bajawit', 'Desa'),
(11, 'Banyu Hirang', 'Desa'),
(11, 'Cangkering', 'Desa'),
(11, 'Cempaka', 'Desa'),
(11, 'Harusan Telaga', 'Desa'),
(11, 'Ilir Mesjid', 'Desa'),
(11, 'Jarang Kuantan', 'Desa'),
(11, 'Jumba', 'Desa'),
(11, 'Kayakah', 'Desa'),
(11, 'Keramat', 'Desa'),
(11, 'Kota Raja', 'Desa'),
(11, 'Kutai Kecil', 'Desa'),
(11, 'Mamar', 'Desa'),
(11, 'Murung Panggang', 'Desa'),
(11, 'Murung Sari', 'Desa'),
(11, 'Padang Darat', 'Desa'),
(11, 'Padang Tanggul', 'Desa'),
(11, 'Penyiuran', 'Desa'),
(11, 'Pulau Tambak', 'Desa'),
(11, 'Rukam Hilir', 'Desa'),
(11, 'Rukam Hulu', 'Desa'),
(11, 'Simpang Empat', 'Desa'),
(11, 'Simpang Tiga', 'Desa'),
(11, 'Telaga Hanyar', 'Desa'),
(11, 'Telaga Sari', 'Desa'),
(11, 'Telaga Silaba', 'Desa'),
(11, 'Teluk Baru', 'Desa'),
(11, 'Teluk Paring', 'Desa'),
(11, 'Teluk Sari', 'Desa'),
(11, 'Ujung Murung', 'Desa'),
(21, 'Bajawit', 'Desa'),
(21, 'Banyu Hirang', 'Desa'),
(21, 'Cangkering', 'Desa'),
(21, 'Cempaka', 'Desa'),
(21, 'Harusan Telaga', 'Desa'),
(21, 'Ilir Mesjid', 'Desa'),
(21, 'Jarang Kuantan', 'Desa'),
(21, 'Jumba', 'Desa'),
(21, 'Kayakah', 'Desa'),
(21, 'Keramat', 'Desa'),
(21, 'Kota Raja', 'Desa'),
(21, 'Kutai Kecil', 'Desa'),
(21, 'Mamar', 'Desa'),
(21, 'Murung Panggang', 'Desa'),
(21, 'Murung Sari', 'Desa'),
(21, 'Padang Darat', 'Desa'),
(21, 'Padang Tanggul', 'Desa'),
(21, 'Penyiuran', 'Desa'),
(21, 'Pulau Tambak', 'Desa'),
(21, 'Rukam Hilir', 'Desa'),
(21, 'Rukam Hulu', 'Desa'),
(21, 'Simpang Empat', 'Desa'),
(21, 'Simpang Tiga', 'Desa'),
(21, 'Telaga Hanyar', 'Desa'),
(21, 'Telaga Sari', 'Desa'),
(21, 'Telaga Silaba', 'Desa'),
(21, 'Teluk Baru', 'Desa'),
(21, 'Teluk Paring', 'Desa'),
(21, 'Teluk Sari', 'Desa'),
(21, 'Ujung Murung', 'Desa');

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