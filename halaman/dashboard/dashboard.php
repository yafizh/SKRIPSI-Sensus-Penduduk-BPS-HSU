<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="title mb-30">
                        <h2>Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Sensus Penduduk</h4>
            <hr>
            <p>Sensus penduduk berarti perhitungan jumlah penduduk secara periodik. Data yang dicapai, biasanya tidak hanya meliputi jumlah orang, tetapi juga fakta mengenai misalnya jenis kelamin, usia,bahasa, dan hal-hal lain yang dianggap perlu.</p>
        </div>
        <?php
        $sensus = [
            'jumlah' => $koneksi->query("SELECT * FROM periode_sensus")->num_rows,
            'sedang_berjalan' => $koneksi->query("SELECT * FROM periode_sensus WHERE status='Berjalan'")->num_rows
        ];
        ?>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-cart-full"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Pelaksanaan Sensus</h6>
                        <h3 class="text-bold mb-10"><?= $sensus['jumlah']; ?></h3>
                        <p class="text-sm text-danger">
                            <span class="text-gray"><?= $sensus['sedang_berjalan'] ? 'Sedang Berjalan' : 'Menunggu'; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY status, tahun DESC")->fetch_assoc();
            $penduduk = $koneksi->query("SELECT * FROM penduduk WHERE id_periode_sensus=" . $periode_sensus['id']);
            ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon success">
                        <i class="lni lni-dollar"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Jumlah Penduduk</h6>
                        <h3 class="text-bold mb-10"><?= $penduduk->num_rows; ?></h3>
                        <p class="text-sm text-success">
                            <span class="text-gray">Periode Sensus <?= $periode_sensus['tahun']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <?php $kecamatan = $koneksi->query("SELECT * FROM kecamatan WHERE id_periode_sensus=" . $periode_sensus['id']); ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Jumlah Kecamatan</h6>
                        <h3 class="text-bold mb-10"><?= $kecamatan->num_rows; ?></h3>
                        <p class="text-sm text-danger">
                            <span class="text-gray">Periode Sensus <?= $periode_sensus['tahun']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <?php $kelurahan = $koneksi->query("SELECT * FROM `kelurahan/desa` INNER JOIN kecamatan ON kecamatan.id=`kelurahan/desa`.id_kecamatan WHERE kecamatan.id_periode_sensus=" . $periode_sensus['id']); ?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange">
                        <i class="lni lni-user"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Jumlah Kelurahan/Desa</h6>
                        <h3 class="text-bold mb-10"><?= $kelurahan->num_rows; ?></h3>
                        <p class="text-sm text-danger">
                            <span class="text-gray">Periode Sensus <?= $periode_sensus['tahun']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</section>
<?php include_once('layout/js.php'); ?>