<?php
if ($koneksi->query("DELETE FROM status_keluarga WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=status_keluarga&action=tampil';</script>";
else die($mysqli->error);
