<?php
$data = $koneksi->query("SELECT * FROM kelahiran WHERE id=" . $_GET['id'])->fetch_assoc();
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` WHERE id=" . $_GET['id_kelurahan'])->fetch_assoc();
if (isset($_POST['edit'])) {
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin']);
    $tempat_lahir = $koneksi->real_escape_string($_POST['tempat_lahir']);
    $tanggal_lahir = $koneksi->real_escape_string($_POST['tanggal_lahir']);
    $status_kelahiran = $koneksi->real_escape_string($_POST['status_kelahiran']);

    $q = "
        UPDATE kelahiran SET 
            nama='$nama',
            jenis_kelamin='$jenis_kelamin',
            tempat_lahir='$tempat_lahir',
            tanggal_lahir='$tanggal_lahir',
            status='$status_kelahiran' 
        WHERE 
            id=" . $_GET['id'] . "
    ";
    if ($koneksi->query($q))
        echo "<script>location.href = '?page=kecamatan&sub_page=kelurahan&action=detail_kelahiran&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_kelurahan=" . $_GET['id_kelurahan'] . "';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Ubah Kelahiran</h2>
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
                                        <label>Nama</label>
                                        <input type="text" required autocomplete="off" value="<?= $data['nama']; ?>" class="bg-transparent" name="nama" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tempat Lahir</label>
                                        <input type="text" required autocomplete="off" class="bg-transparent" value="<?= $data['tempat_lahir']; ?>" name="tempat_lahir" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" required autocomplete="off" class="bg-transparent" name="tanggal_lahir" value="<?= $data['tanggal_lahir']; ?>" />
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
                                    <div class="select-style-1">
                                        <label>Status Kelahiran</label>
                                        <div class="select-position">
                                            <select name="status_kelahiran">
                                                <option value="" selected disabled>Pilih Status Kelahiran</option>
                                                <option <?= $data['status'] == 'Lahir Hidup' ? 'selected' : ''; ?> value="Lahir Hidup">Lahir Hidup</option>
                                                <option <?= $data['status'] == 'Lahir Mati' ? 'selected' : ''; ?> value="Lahir Mati">Lahir Mati</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kecamatan&sub_page=kelurahan&action=detail_kelahiran&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_kelurahan=<?= $_GET['id_kelurahan']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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