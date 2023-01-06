<?php
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();
if (isset($_POST['tambah'])) {
    $nip = $koneksi->real_escape_string($_POST['nip']);
    $id_pegawai = $koneksi->real_escape_string($_POST['id_pegawai']);

    try {
        $koneksi->begin_transaction();

        $check = $koneksi->query("SELECT * FROM pengguna WHERE username='$nip'");
        if ($check->num_rows) {
            $koneksi->query("UPDATE pengguna SET password='$nip' WHERE username='$nip'");
            $id_pengguna = $check->fetch_assoc()['id'];
        } else {
            $koneksi->query("INSERT INTO pengguna (username, password) VALUES ('$nip', '$nip')");
            $id_pengguna = $koneksi->insert_id;
        }

        $check = $koneksi->query("SELECT * FROM petugas WHERE id_pegawai='$id_pegawai' AND id_periode_sensus=" . $periode_sensus['id']);
        if ($check->num_rows) {
            $id_petugas = $check->fetch_assoc()['id'];
        } else {
            $q = "
            INSERT INTO petugas (
                id_pengguna, 
                id_pegawai,
                id_periode_sensus 
            ) VALUES (
                $id_pengguna,
                $id_pegawai,
                " . $periode_sensus['id'] . "
            )";
            $koneksi->query($q);
            $id_petugas = $koneksi->insert_id;
        }

        $q = "
        INSERT INTO `petugas_kelurahan/desa` (
            id_petugas, 
            `id_kelurahan/desa` 
        ) VALUES (
            " . $id_petugas . ",
            " . $kelurahan['id'] . " 
        )";
        $koneksi->query($q);

        $koneksi->commit();
        echo "<script>location.href = '?page=petugas&sub_page=petugas_kelurahan&action=detail_petugas&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "&id_periode_sensus=" . $_GET['id_periode_sensus'] . "';</script>";
    } catch (\Throwable $e) {
        $koneksi->rollback();
        throw $e;
    };
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Tambah Petugas Kelurahan/Desa (Periode Sensus <?= $periode_sensus['tahun']; ?>)</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Kecamatan</label>
                                        <input type="text" disabled value="<?= $kecamatan['nama']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Kelurahan/Desa</label>
                                        <input type="text" disabled value="<?= $kelurahan['status']; ?> <?= $kelurahan['nama']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $q = "
                                        SELECT 
                                            * 
                                        FROM 
                                            pegawai 
                                        WHERE 
                                            id NOT IN (
                                                SELECT 
                                                    id_pegawai 
                                                FROM 
                                                    petugas p
                                                INNER JOIN 
                                                    `petugas_kelurahan/desa` pkd  
                                                ON 
                                                    pkd.id_petugas=p.id  
                                                WHERE 
                                                    p.id_periode_sensus=" . $periode_sensus['id'] . " 
                                                    AND 
                                                    pkd.`id_kelurahan/desa`=" . $kelurahan['id'] . "
                                            )";
                                    $pegawai = $koneksi->query($q);
                                    ?>
                                    <div class="select-style-1">
                                        <label>Petugas Kecamatan</label>
                                        <div class="select-position">
                                            <select required name="id_pegawai">
                                                <option value="" selected disabled>Pilih Pegawai</option>
                                                <?php while ($row = $pegawai->fetch_assoc()) : ?>
                                                    <option data-nip="<?= $row['nip']; ?>" value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIP</label>
                                        <input type="text" name="nip" readonly />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=petugas&sub_page=petugas_kelurahan&action=detail_petugas&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>&id_periode_sensus=<?= $_GET['id_periode_sensus']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="tambah" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>
<script>
    document.querySelector('select[name=id_pegawai]').addEventListener('change', function() {
        document.querySelector('input[name=nip]').value = this.options[this.selectedIndex].getAttribute('data-nip');
    });
</script>