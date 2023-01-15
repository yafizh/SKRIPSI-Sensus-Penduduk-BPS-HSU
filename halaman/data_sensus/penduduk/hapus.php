<?php
if ($koneksi->query("DELETE FROM kartu_keluarga WHERE id=" . $_GET['id_kartu_keluarga']))
    echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=tampil&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
else die($mysqli->error);
