<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Kelahiran</h3>
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
                                <div class="col-12 col-md-4">
                                    <?php $periode_sensus = $koneksi->query("SELECT * FROM periode_sensus ORDER BY tahun DESC"); ?>
                                    <div class="select-style-1">
                                        <label>Dari Periode Sensus</label>
                                        <div class="select-position">
                                            <select name="id_periode_sensus" required>
                                                <option value="" selected disabled>Pilih Periode Sensus</option>
                                                <?php while ($row = $periode_sensus->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['id_periode_sensus'] ?? '') == $row['id'] ? 'selected' : '' ?> value="<?= $row['id']; ?>"><?= $row['tahun']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <?php $kecamatan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM kecamatan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kecamatan</label>
                                        <div class="select-position">
                                            <select name="kecamatan" required>
                                                <option value="" selected disabled>Semua Kecamatan</option>
                                                <?php while ($row = $kecamatan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kecamatan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <?php $kelurahan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM `kelurahan/desa` ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kelurahan/Desa</label>
                                        <div class="select-position">
                                            <select name="kelurahan" required>
                                                <option value="" selected disabled>Semua Kelurahan/Desa</option>
                                                <?php while ($row = $kelurahan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kelurahan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php if (isset($_POST['id_periode_sensus'])) : ?>
                                        <?php
                                        $link = "halaman/laporan/cetak/kelahiran.php?id_periode_sensus=" . $_POST['id_periode_sensus'];
                                        if (isset($_POST['kecamatan']))
                                            $link .= "&kecamatan=" . $_POST['kecamatan'];
                                        if (isset($_POST['kelurahan']))
                                            $link .= "&kelurahan=" . $_POST['kelurahan'];
                                        ?>
                                        <a href="<?= $link; ?>" target="_blank" class="main-btn btn-sm success-btn btn-hover">Cetak</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($_POST['id_periode_sensus'])) : ?>
                    <div class="col-12">
                        <div class="card-style mb-30">
                            <div class="table-responsive">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center fit">
                                                <h6>No</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Nama</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Tempat Lahir</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Tanggal Lahir</h6>
                                            </th>
                                            <th class="text-center">
                                                <h6>Jenis Kelamin</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $q = "
                                        SELECT 
                                            penduduk.*
                                        FROM 
                                            kelahiran  
                                        INNER JOIN 
                                            penduduk 
                                        ON 
                                            penduduk.id=kelahiran.id_penduduk 
                                        INNER JOIN 
                                            `kelurahan/desa` 
                                        ON 
                                            `kelurahan/desa`.id=`kelahiran`.`id_kelurahan/desa`  
                                        INNER JOIN 
                                            kecamatan 
                                        ON 
                                            kecamatan.id=`kelurahan/desa`.id_kecamatan 
                                        INNER JOIN 
                                            periode_sensus 
                                        ON 
                                            periode_sensus.id=kelahiran.id_periode_sensus 
                                        WHERE 
                                            periode_sensus.id=" . $_POST['id_periode_sensus'] . " 
                                            AND 
                                            kecamatan.nama='" . $_POST['kecamatan'] . "' 
                                            AND 
                                            `kelurahan/desa`.nama='" . $_POST['kelurahan'] . "'
                                        ";

                                    $q .= " ORDER BY penduduk.nama";
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
                                                    <td>
                                                        <p><?= $row['nama']; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><?= $row['tempat_lahir']; ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><?= indonesiaDate($row['tanggal_lahir']); ?></p>
                                                    </td>
                                                    <td class="text-center">
                                                        <p><?= $row['jenis_kelamin']; ?></p>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td class="text-center" colspan="6">Data Kosong</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>