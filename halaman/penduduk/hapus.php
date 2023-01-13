<?php
if ($koneksi->query("DELETE FROM `kelurahan/desa` WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=kelurahan&action=detail&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_periode_sensus=" . $_GET['id_periode_sensus'] . "';</script>";
else die($mysqli->error);
