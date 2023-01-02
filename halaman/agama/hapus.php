<?php
if ($koneksi->query("DELETE FROM `agama/kepercayaan` WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=agama&action=tampil';</script>";
else die($mysqli->error);
