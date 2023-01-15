<?php
if ($koneksi->query("DELETE FROM anggota_keluarga WHERE id_penduduk=" . $_GET['id_penduduk']))
    echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_per_anggota_keluarga&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "&id_kartu_keluarga=" . $_GET['id_kartu_keluarga'] . "';</script>";
else die($mysqli->error);
