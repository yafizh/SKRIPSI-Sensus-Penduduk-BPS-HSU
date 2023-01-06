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
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $nip = $koneksi->real_escape_string($_POST['nip']);
    $id_pegawai = $koneksi->real_escape_string($_POST['id_pegawai']);

    try {
        $koneksi->begin_transaction();

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
        INSERT INTO petugas_kecamatan (
            id_petugas, 
            id_kecamatan 
        ) VALUES (
            " . $id_petugas . ",
            " . $kecamatan['id'] . " 
        )";
        $koneksi->query($q);

        $koneksi->commit();
        echo "<script>location.href = '?page=petugas&sub_page=petugas_kecamatan&action=detail&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_periode_sensus=" . $_GET['id_periode_sensus'] . "';</script>";
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
                        <h2>Edit Petugas Kecamatan</h2>
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
                                                    petugas_kecamatan pk  
                                                ON 
                                                    pk.id_petugas=p.id  
                                                WHERE 
                                                    pk.id_kecamatan=" . $kecamatan['id'] . " 
                                                    AND 
                                                    p.id_pegawai != " . $data['id_pegawai'] . "
                                                    AND 
                                                    p.id_periode_sensus=" . $periode_sensus['id'] . " 
                                            )";
                                    $pegawai = $koneksi->query($q);
                                    ?>
                                    <div class="select-style-1">
                                        <label>Petugas Kecamatan</label>
                                        <div class="select-position">
                                            <select required name="id_pegawai">
                                                <option value="" selected disabled>Pilih Pegawai</option>
                                                <?php while ($row = $pegawai->fetch_assoc()) : ?>
                                                    <?php if ($row['id'] == $data['id_pegawai']) : ?>
                                                        <option selected data-nip="<?= $row['nip']; ?>" value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php else : ?>
                                                        <option data-nip="<?= $row['nip']; ?>" value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                    <?php endif; ?>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIP</label>
                                        <input type="text" name="nip" readonly value="<?= $data['nip']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=petugas&sub_page=petugas_kecamatan&action=detail&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_periode_sensus=<?= $_GET['id_periode_sensus']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="edit" class="main-btn btn-sm primary-btn btn-hover">Simpan</button>
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