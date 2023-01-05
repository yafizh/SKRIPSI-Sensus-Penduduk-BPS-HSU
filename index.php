<?php
require_once('database/koneksi.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/logo/bps.png" type="image/x-icon" />
    <link rel="preload" as="image" href="assets/images/logo/bps.png">
    <title>Aplikasi Sensus Penduduk</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/datatable.css" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <style>
        .fit {
            width: 1%;
            white-space: nowrap;
        }

        .breadcrumb-item {
            color: #5D657B;
        }

        .breadcrumb-item:hover {
            color: #4A6CF7;
        }
    </style>
</head>

<body>
    <?php include_once('layout/sidebar.php'); ?>
    <div class="overlay"></div>

    <main class="main-wrapper">
        <?php include_once('layout/navbar.php'); ?>
        <?php
        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'master_data') {
                if (($_GET['sub_page'] ?? '') == 'golongan_darah') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/golongan_darah/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/golongan_darah/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/golongan_darah/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/golongan_darah/hapus.php');
                } elseif (($_GET['sub_page'] ?? '') == 'status_keluarga') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/status_keluarga/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/status_keluarga/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/status_keluarga/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/status_keluarga/hapus.php');
                } elseif (($_GET['sub_page'] ?? '') == 'pendidikan') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/pendidikan/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/pendidikan/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/pendidikan/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/pendidikan/hapus.php');
                } elseif (($_GET['sub_page'] ?? '') == 'agama') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/agama/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/agama/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/agama/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/agama/hapus.php');
                } elseif (($_GET['sub_page'] ?? '') == 'penyebab_kematian') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/penyebab_kematian/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/penyebab_kematian/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/penyebab_kematian/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/penyebab_kematian/hapus.php');
                } elseif (($_GET['sub_page'] ?? '') == 'jenis_pekerjaan') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/jenis_pekerjaan/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/jenis_pekerjaan/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/jenis_pekerjaan/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/jenis_pekerjaan/hapus.php');
                } elseif (($_GET['sub_page'] ?? '') == 'status_perkawinan') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/status_perkawinan/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/status_perkawinan/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/status_perkawinan/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/status_perkawinan/hapus.php');
                }
            } elseif ($_GET['page'] == 'pegawai') {
                if ($_GET['action'] == 'tampil')
                    include_once('halaman/pegawai/tampil.php');
                elseif ($_GET['action'] == 'tambah')
                    include_once('halaman/pegawai/tambah.php');
                elseif ($_GET['action'] == 'ubah')
                    include_once('halaman/pegawai/ubah.php');
                elseif ($_GET['action'] == 'hapus')
                    include_once('halaman/pegawai/hapus.php');
            } elseif ($_GET['page'] == 'periode_sensus') {
                if ($_GET['action'] == 'tampil')
                    include_once('halaman/periode_sensus/tampil.php');
                elseif ($_GET['action'] == 'tambah')
                    include_once('halaman/periode_sensus/tambah.php');
                elseif ($_GET['action'] == 'ubah')
                    include_once('halaman/periode_sensus/ubah.php');
                elseif ($_GET['action'] == 'hapus')
                    include_once('halaman/periode_sensus/hapus.php');
            } elseif ($_GET['page'] == 'kecamatan') {
                if ($_GET['action'] == 'tampil')
                    include_once('halaman/kecamatan/tampil.php');
                elseif ($_GET['action'] == 'tambah')
                    include_once('halaman/kecamatan/tambah.php');
                elseif ($_GET['action'] == 'ubah')
                    include_once('halaman/kecamatan/ubah.php');
                elseif ($_GET['action'] == 'hapus')
                    include_once('halaman/kecamatan/hapus.php');
            } elseif ($_GET['page'] == 'kelurahan') {
                if ($_GET['action'] == 'tampil')
                    include_once('halaman/kelurahan/tampil.php');
                elseif ($_GET['action'] == 'detail')
                    include_once('halaman/kelurahan/tampil_per_kecamatan.php');
                elseif ($_GET['action'] == 'tambah')
                    include_once('halaman/kelurahan/tambah.php');
                elseif ($_GET['action'] == 'ubah')
                    include_once('halaman/kelurahan/ubah.php');
                elseif ($_GET['action'] == 'hapus')
                    include_once('halaman/kelurahan/hapus.php');
            }
        } else include_once('halaman/dashboard/dashboard.php');
        ?>
    </main>
</body>

</html>