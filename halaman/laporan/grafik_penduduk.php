<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Grafik Penduduk</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                    <div class="select-style-1">
                                        <label>Dari Periode Sensus</label>
                                        <div class="select-position">
                                            <select name="id_periode_sensus">
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['id_periode_sensus'] ?? '') == $row['id'] ? 'selected' : '' ?> value="<?= $row['id']; ?>"><?= $row['tahun']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                    <div class="select-style-1">
                                        <label>Sampai Periode Sensus</label>
                                        <div class="select-position">
                                            <select name="id_periode_sensus">
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['id_periode_sensus'] ?? '') == $row['id'] ? 'selected' : '' ?> value="<?= $row['id']; ?>"><?= $row['tahun']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $kecamatan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM kecamatan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kecamatan</label>
                                        <div class="select-position">
                                            <select name="kecamatan">
                                                <option value="" selected disabled>Semua Kecamatan</option>
                                                <?php while ($row = $kecamatan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kecamatan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <?php $desa = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM `kelurahan/desa` ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kelurahan/Desa</label>
                                        <div class="select-position">
                                            <select name="kecamatan">
                                                <option value="" selected disabled>Semua Kelurahan/Desa</option>
                                                <?php while ($row = $desa->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['desa'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/kecamatan.php";
                                    if (isset($_POST['id_periode_sensus']))
                                        $link .= "?id_periode_sensus=" . $_POST['id_periode_sensus'];
                                    ?>
                                    <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>