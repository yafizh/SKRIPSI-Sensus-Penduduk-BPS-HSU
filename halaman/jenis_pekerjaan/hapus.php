<?php
if ($koneksi->query("DELETE FROM jenis_pekerjaan WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=jenis_pekerjaan&action=tampil';</script>";
else die($mysqli->error);
