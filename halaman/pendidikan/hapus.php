<?php
if ($koneksi->query("DELETE FROM pendidikan WHERE id=" . $_GET['id']))
    echo "<script>location.href = '?page=master_data&sub_page=pendidikan&action=tampil';</script>";
else die($mysqli->error);
