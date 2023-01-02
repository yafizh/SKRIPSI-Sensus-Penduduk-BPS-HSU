<?php
if ($koneksi->query("DELETE FROM status_perkawinan WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=status_perkawinan&action=tampil';</script>";
else die($mysqli->error);
