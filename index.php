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
                if ($_GET['sub_page'] == 'golongan_darah') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/golongan_darah/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/golongan_darah/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/golongan_darah/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/golongan_darah/hapus.php');
                } elseif ($_GET['sub_page'] == 'status_keluarga') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/status_keluarga/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/status_keluarga/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/status_keluarga/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/status_keluarga/hapus.php');
                } elseif ($_GET['sub_page'] == 'pendidikan') {
                    if ($_GET['action'] == 'tampil')
                        include_once('halaman/pendidikan/tampil.php');
                    elseif ($_GET['action'] == 'tambah')
                        include_once('halaman/pendidikan/tambah.php');
                    elseif ($_GET['action'] == 'ubah')
                        include_once('halaman/pendidikan/ubah.php');
                    elseif ($_GET['action'] == 'hapus')
                        include_once('halaman/pendidikan/hapus.php');
                }
            }
        } else include_once('halaman/dashboard/dashboard.php');
        ?>
    </main>
</body>

</html>