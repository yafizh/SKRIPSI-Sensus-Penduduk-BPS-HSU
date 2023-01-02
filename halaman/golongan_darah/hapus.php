<?php
if ($koneksi->query("DELETE FROM golongan_darah WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=golongan_darah&action=tampil';</script>";
else die($mysqli->error);
