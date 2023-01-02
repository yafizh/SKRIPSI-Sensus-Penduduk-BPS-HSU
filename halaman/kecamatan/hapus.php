<?php
if ($koneksi->query("DELETE FROM kecamatan WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=kecamatan&action=tampil';</script>";
else die($mysqli->error);
