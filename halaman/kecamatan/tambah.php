<?php
$periode_sensus = $koneksi->query("SELECT * FROM periode_sensus WHERE status='Berjalan'");
if (isset($_POST['tambah'])) {
    $periode_sensus = $periode_sensus->fetch_assoc();
    $nama = $koneksi->real_escape_string($_POST['nama']);

    if ($koneksi->query("INSERT INTO kecamatan (id_periode_sensus, nama) VALUES (" . $periode_sensus['id'] . ", '$nama')"))
        echo "<script>location.href = '?page=kecamatan&action=tampil';</script>";
    else die($mysqli->error);
}
?>
<section class="tab-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="title mb-30">
                        <h2>Tambah Kecamatan</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-layout-wrapper">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card-style mb-30">
                        <?php if ($periode_sensus->num_rows) : ?>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Periode Sensus (Tahun)</label>
                                            <input type="text" value="<?= $periode_sensus->fetch_assoc()['tahun']; ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Nama Kecamatan</label>
                                            <input type="text" class="bg-transparent" name="nama" autocomplete="off" autofocus required />
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <a href="?page=kecamatan&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                                        <button name="tambah" class="main-btn btn-sm primary-btn btn-hover">Tambah</button>
                                    </div>
                                </div>
                            </form>
                        <?php else : ?>
                            <h4 class="text-center py-5">Tidak Ada Periode Sensus Yang Sedang Berjalan</h4>
                            <div class="col-12 d-flex justify-content-center">
                                <a href="?page=kecamatan&action=tampil" class="main-btn btn-sm secondary-btn btn-hover">Kembali</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('layout/js.php'); ?>