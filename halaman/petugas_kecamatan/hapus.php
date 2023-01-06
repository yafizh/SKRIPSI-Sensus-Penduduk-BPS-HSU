<?php 
$q = "
SELECT 
    pk.*,
    pegawai.id id_pegawai,
    pegawai.nip,
    pegawai.nama
FROM 
    petugas_kecamatan pk 
INNER JOIN 
    petugas 
ON 
    petugas.id=pk.id_petugas 
INNER JOIN 
    pegawai 
ON 
    pegawai.id=petugas.id_pegawai 
WHERE 
    pk.id=" . $_GET['id'] . "
";
$data = $koneksi->query($q)->fetch_assoc();
$q = "
    SELECT 
        * 
    FROM 
        petugas p
    INNER JOIN 
        petugas_kecamatan pk 
    ON 
        pk.id_petugas=p.id 
    INNER JOIN 
        `petugas_kelurahan/desa` pkd 
    ON 
        pkd.id_petugas=p.id 
    WHERE 
        p.id=" . $data['id_petugas'] . "
";
$check = $koneksi->query($q);
if ($check->num_rows < 2)
    $koneksi->query("DELETE FROM pengguna WHERE username='" . $data['nip'] . "'");
else
    $koneksi->query("DELETE FROM petugas_kecamatan WHERE id_petugas=" . $data['id_petugas'] . " AND id_kecamatan=" . $data['id_kecamatan']);

echo "<script>location.href = '?page=petugas&sub_page=petugas_kecamatan&action=detail&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_periode_sensus=" . $_GET['id_periode_sensus'] . "';</script>";
