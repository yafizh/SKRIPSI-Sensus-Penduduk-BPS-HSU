<?php 
$data = $koneksi->query("SELECT *, DATE(tanggal_waktu) tanggal, TIME(tanggal_waktu) waktu FROM kematian WHERE id=".$_GET['id'])->fetch_assoc();
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $nik = $koneksi->real_escape_string($_POST['nik']);
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin']);
    $id_agama = $koneksi->real_escape_string($_POST['id_agama']);
    $id_penyebab_kematian = $koneksi->real_escape_string($_POST['id_penyebab_kematian']);
    $tanggal = $koneksi->real_escape_string($_POST['tanggal']);
    $waktu = $koneksi->real_escape_string($_POST['waktu']);

    $q = "
        UPDATE kematian SET 
            `id_agama/kepercayaan`='$id_agama',
            `id_penyebab_kematian`='$id_penyebab_kematian',
            nik='$nik',
            nama='$nama',
            jenis_kelamin='$jenis_kelamin',
            tanggal_waktu='" . $tanggal . " " . $waktu . "' 
        WHERE 
            id=" . $_GET['id'] . "
    ";
    if ($koneksi->query($q))
        echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_kematian&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Ubah Kematian</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <form action="" method="POST">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Kecamatan</label>
                                        <input type="text" disabled value="<?= $kecamatan['nama']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama Kelurahan</label>
                                        <input type="text" disabled value="<?= $kelurahan['nama']; ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-style mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>NIK</label>
                                        <input type="text" required autocomplete="off" value="<?= $data['nik']; ?>" autofocus class="bg-transparent" name="nik" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Nama</label>
                                        <input type="text" required autocomplete="off" value="<?= $data['nama']; ?>" class="bg-transparent" name="nama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-dark mb-1">Jenis Kelamin</label>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Laki - Laki" <?= $data['jenis_kelamin'] == 'Laki - Laki' ? 'checked' : ''; ?> name="jenis_kelamin" id="male" />
                                        <label class="form-check-label" for="male">
                                            Laki - Laki</label>
                                    </div>
                                    <div class="form-check radio-style radio-primary mb-20">
                                        <input class="form-check-input" type="radio" value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : ''; ?> name="jenis_kelamin" id="female" />
                                        <label class="form-check-label" for="female">
                                            Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $penyebab_kematian = $koneksi->query("SELECT * FROM penyebab_kematian ORDER BY id"); ?>
                                    <div class="select-style-1">
                                        <label>Penyebab Kematian</label>
                                        <div class="select-position">
                                            <select name="id_penyebab_kematian">
                                                <option value="" selected disabled>Pilih Penyebab Kematian</option>
                                                <?php while ($row = $penyebab_kematian->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_penyebab_kematian'] ? 'selected' : ''; ?>  value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?php $agama = $koneksi->query("SELECT * FROM `agama/kepercayaan` ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Agama/Kepercayaan</label>
                                        <div class="select-position">
                                            <select name="id_agama">
                                                <option value="" selected disabled>Pilih Agama/Kepercayaan</option>
                                                <?php while ($row = $agama->fetch_assoc()) : ?>
                                                    <option <?= $row['id'] == $data['id_agama/kepercayaan'] ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="input-style-1">
                                        <label>Tanggal</label>
                                        <input type="date" required autocomplete="off" class="bg-transparent" name="tanggal" value="<?= $data['tanggal']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="input-style-1">
                                        <label>Tanggal</label>
                                        <input type="time" required autocomplete="off" class="bg-transparent" name="waktu" value="<?= $data['waktu']; ?>" />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kecamatan&sub_page=kelurahan&action=detail_kematian&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                    <button name="edit" class="main-btn btn-sm primary-btn btn-hover">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>