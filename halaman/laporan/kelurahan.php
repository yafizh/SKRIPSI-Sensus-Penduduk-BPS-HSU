<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Kelurahan/Desa</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card-style mb-30">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                    <div class="select-style-1">
                                        <label>Periode Sensus</label>
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
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/kelurahan.php";
                                    if (isset($_POST['id_periode_sensus']))
                                        $link .= "?id_periode_sensus=" . $_POST['id_periode_sensus'];
                                    ?>
                                    <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card-style mb-30">
                        <div class="table-responsive">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th rowspan="2" class="text-center">
                                            <h6>Periode Sensus</h6>
                                        </th>
                                        <th rowspan="2" class="text-center">
                                            <h6>Nama Kelurahan/Desa</h6>
                                        </th>
                                        <th class="text-center" colspan="4">
                                            Jumlah
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">
                                            <h6>Petugas</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Penduduk</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Kematian</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Kelahiran</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        `kelurahan/desa`.*,
                                        periode_sensus.tahun,
                                        (SELECT IFNULL(COUNT(*), 0) FROM `petugas_kelurahan/desa` WHERE `id_kelurahan/desa`=`kelurahan/desa`.id) jumlah_petugas,
                                        (SELECT IFNULL(COUNT(*), 0) FROM penduduk WHERE `id_kelurahan/desa`=`kelurahan/desa`.id) jumlah_penduduk, 
                                        (SELECT IFNULL(COUNT(*), 0) FROM kelahiran WHERE `id_kelurahan/desa`=`kelurahan/desa`.id) jumlah_kelahiran, 
                                        (SELECT IFNULL(COUNT(*), 0) FROM kematian WHERE `id_kelurahan/desa`=`kelurahan/desa`.id) jumlah_kematian 
                                    FROM 
                                        `kelurahan/desa` 
                                    INNER JOIN 
                                        kecamatan 
                                    ON 
                                        kecamatan.id=`kelurahan/desa`.id_kecamatan 
                                    INNER JOIN 
                                        periode_sensus 
                                    ON 
                                        periode_sensus.id=kecamatan.id_periode_sensus";

                                if (isset($_POST['id_periode_sensus']))
                                    $q .= " WHERE periode_sensus.id=" . $_POST['id_periode_sensus'];

                                $q .= " ORDER BY periode_sensus.tahun DESC";
                                $result = $koneksi->query($q);
                                $no = 1;
                                ?>
                                <tbody>
                                    <?php if ($result->num_rows) : ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td class="text-center fit">
                                                    <p><?= $no++; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['tahun']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['status']; ?> <?= $row['nama']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah_petugas']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah_penduduk']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah_kematian']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['jumlah_kelahiran']; ?></p>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td class="text-center" colspan="8">Data Kosong</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>