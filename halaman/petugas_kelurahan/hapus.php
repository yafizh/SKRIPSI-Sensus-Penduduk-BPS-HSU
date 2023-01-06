<?php 
$q = "
SELECT 
    pkd.*,
    pegawai.id id_pegawai,
    pegawai.nip,
    pegawai.nama
FROM 
    `petugas_kelurahan/desa` pkd 
INNER JOIN 
    petugas 
ON 
    petugas.id=pkd.id_petugas 
INNER JOIN 
    pegawai 
ON 
    pegawai.id=petugas.id_pegawai 
WHERE 
    pkd.id=" . $_GET['id'] . "
";
$data = $koneksi->query($q)->fetch_assoc();
$q = "
    SELECT 
        * 
    FROM 
        petugas p
    INNER JOIN 
        `petugas_kelurahan/desa` pkd 
    ON 
        pkd.id_petugas=p.id 
    INNER JOIN 
        petugas_kecamatan pk 
    ON 
        pk.id_petugas=p.id 
    WHERE 
        p.id=" . $data['id_petugas'] . "
";
$check = $koneksi->query($q);
if ($check->num_rows < 2)
    $koneksi->query("DELETE FROM pengguna WHERE username='" . $data['nip'] . "'");
else
    $koneksi->query("DELETE FROM `petugas_kelurahan/desa` WHERE id_petugas=" . $data['id_petugas'] . " AND `id_kelurahan/desa`=" . $data['id_kelurahan/desa']);

echo "<script>location.href = '?page=petugas&sub_page=petugas_kelurahan&action=detail_petugas&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "&id_periode_sensus=" . $_GET['id_periode_sensus'] . "';</script>";
