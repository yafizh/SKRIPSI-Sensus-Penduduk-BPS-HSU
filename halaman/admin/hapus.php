<?php
if ($koneksi->query("DELETE FROM pengguna WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=admin&action=tampil';</script>";
else die($mysqli->error);
