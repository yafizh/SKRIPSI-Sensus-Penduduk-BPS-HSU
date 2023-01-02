<?php
if ($koneksi->query("DELETE FROM penyebab_kematian WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=penyebab_kematian&action=tampil';</script>";
else die($mysqli->error);
