<section class="table-components">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col">
                    <div class="title mb-30">
                        <h3>Laporan Petugas Kelurahan/Desa</h3>
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
                                <div class="col-12">
                                    <?php $kecamatan = $koneksi->query("SELECT DISTINCT UPPER(nama) nama FROM kecamatan ORDER BY nama"); ?>
                                    <div class="select-style-1">
                                        <label>Kecamatan</label>
                                        <div class="select-position">
                                            <select name="kecamatan">
                                                <option value="" selected disabled>Pilih Kecamatan</option>
                                                <?php while ($row = $kecamatan->fetch_assoc()) : ?>
                                                    <option <?= ($_POST['kecamatan'] ?? '') == $row['nama'] ? 'selected' : '' ?> value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <button name="submit" class="main-btn btn-sm primary-btn btn-hover">Filter</button>
                                    <?php
                                    $link = "halaman/laporan/cetak/petugas_kelurahan.php?";
                                    if (isset($_POST['id_periode_sensus']))
                                        $link .= "id_periode_sensus=" . $_POST['id_periode_sensus'];
                                    if (isset($_POST['kecamatan']))
                                        $link .= "&kecamatan=" . $_POST['kecamatan'];
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
                                        <th class="text-center fit">
                                            <h6>No</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Periode Sensus</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Kecamatan</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Kelurahan/Desa</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>NIP</h6>
                                        </th>
                                        <th class="text-center">
                                            <h6>Nama</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        kecamatan.nama nama_kecamatan,
                                        pegawai.*, 
                                        `kelurahan/desa`.nama nama_kelurahan,
                                        `kelurahan/desa`.status status_kelurahan,
                                        periode_sensus.tahun
                                    FROM 
                                        `petugas_kelurahan/desa` 
                                    INNER JOIN 
                                        `kelurahan/desa` 
                                    ON 
                                        `kelurahan/desa`.id=`petugas_kelurahan/desa`.`id_kelurahan/desa`  
                                    INNER JOIN 
                                        kecamatan 
                                    ON 
                                        kecamatan.id=`kelurahan/desa`.id_kecamatan 
                                    INNER JOIN 
                                        petugas 
                                    ON 
                                        petugas.id=`petugas_kelurahan/desa`.id_petugas 
                                    INNER JOIN 
                                        pegawai 
                                    ON 
                                        pegawai.id=petugas.id_pegawai 
                                    INNER JOIN 
                                        periode_sensus 
                                    ON 
                                        periode_sensus.id=kecamatan.id_periode_sensus 
                                    WHERE 
                                        1=1 ";

                                if (isset($_POST['id_periode_sensus']))
                                    $q .= " AND periode_sensus.id=" . $_POST['id_periode_sensus'];

                                if (isset($_POST['kecamatan']))
                                    $q .= " AND kecamatan.nama='" . $_POST['kecamatan'] . "'";

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
                                                    <p><?= $row['nama_kecamatan']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['status_kelurahan']; ?> <?= $row['nama_kelurahan']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['nip']; ?></p>
                                                </td>
                                                <td class="text-center">
                                                    <p><?= $row['nama']; ?></p>
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
            </div>
        </div>
    </div>
</section>
<?php require_once('layout/js.php'); ?>