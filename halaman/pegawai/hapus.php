<?php
if ($koneksi->query("DELETE FROM pegawai WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=pegawai&action=tampil';</script>";
else die($mysqli->error);
