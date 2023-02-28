<?php
$kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id=" . $_GET['id_kecamatan'])->fetch_assoc();
$periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE id=" . $_GET['id_periode_sensus'])->fetch_assoc();
if (isset($_POST['tambah'])) {
    $nama = $koneksi->real_escape_string($_POST['nama']);
    $status = $koneksi->real_escape_string($_POST['status']);
    $jumlah_rumah_tangga = $koneksi->real_escape_string($_POST['jumlah_rumah_tangga']);

    if ($koneksi->query("INSERT INTO `kelurahan/desa` (id_kecamatan, nama, status, jumlah_rumah_tangga) VALUES (" . $_GET['id_kecamatan'] . ", '$nama', '$status', '$jumlah_rumah_tangga')"))
        echo "<script>location.href = '?page=kelurahan&action=detail&id_kecamatan=" . $_GET['id_kecamatan'] . "&id_periode_sensus=" . $_GET['id_periode_sensus'] . "';</script>";
    else die($koneksi->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Tambah Kelurahan/Desa (Periode Sensus <?= $periode_sensus['tahun']; ?>)</h2>
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
                                        <label>Nama Kelurahan</label>
                                        <input type="text" class="bg-transparent" name="nama" autocomplete="off" autofocus required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="select-style-1">
                                        <label>Status</label>
                                        <div class="select-position">
                                            <select required name="status">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="Desa">Desa</option>
                                                <option value="Kelurahan">Kelurahan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Jumlah Rumah Tangga</label>
                                        <input type="number" class="bg-transparent" name="jumlah_rumah_tangga" autocomplete="off" min="0" required />
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="?page=kelurahan&action=detail&id_kecamatan=<?= $_GET['id_kecamatan']; ?>&id_periode_sensus=<?= $_GET['id_periode_sensus']; ?>" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
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