<?php
if ($koneksi->query("DELETE FROM periode_sensus WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=periode_sensus&action=tampil';</script>";
else die($mysqli->error);
