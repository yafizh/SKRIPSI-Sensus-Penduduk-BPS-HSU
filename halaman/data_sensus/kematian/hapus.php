<?php
if ($koneksi->query("DELETE FROM kematian WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_kematian&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
else die($mysqli->error);
